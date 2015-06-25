<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	/**
	 * Default page - lists accounts in the LMS
	 *
	 * @return void
	 */
	public function index()
	{

		$data = array();
		// get the account data
		$this->load->model('account_model');
		$data['accounts'] = $this->account_model->get_all_accounts();
		// and get the countries for adding accounts
		$this->load->model('country_model');
		$data['countries'] = $this->country_model->get_countries();

		// and load the view
		$data['page_content'] = $this->load->view('pages/account_all', $data, TRUE);
		$this->load->view('wrapper', $data);
	}

	/**
	 * Add an LMS account
	 *
	 * @return void
	 */
	public function add()
	{
		// add database record, and redirect to view detail page

		$this->load->model('account_model');
		// insert row
		$new_id = $this->account_model->add_account( $this->input->post(NULL, TRUE) );
		// rediret to detail view
		redirect('/accounts/view/'.$new_id, 'refresh');
	}

	/**
	 * View a single LMS account
	 *
	 * @return void
	 */
	public function view( $account_id )
	{
		$data = array();
		// get the account data
		$this->load->model('account_model');
		$data['account'] = $this->account_model->get_single_account( $account_id );
		
		if (empty($data['account']))
			show_404();

		// now get LMS users
		$this->load->model('user_model');
		$data['users'] = $this->user_model->get_all_users( $account_id );

		// and load the view
		$data['page_content'] = $this->load->view('pages/account_single', $data, TRUE);
		$this->load->view('wrapper', $data);

	}

	/**
	 * Create an elucidat account for this account
	 *
	 * @return void
	 */
	public function create_elucidat_account( $account_id )
	{

		$data = array();
		// get the account data
		$this->load->model('account_model');
		$data['account'] = $this->account_model->get_single_account( $account_id );
		
		if (empty($data['account']))
			show_404();

		// get config
		$this->load->config('elucidat');
		$endpoint = $this->config->item('elucidat_endpoint');
		$key = $this->config->item('elucidat_api_key');
		$secret = $this->config->item('elucidat_api_secret');

		$this->load->library('elucidat');

		// create the Elucidat account
		// create the Elucidat account
		// create the Elucidat account
		// create the Elucidat account
		// create the Elucidat account

		// get the nonce
		$nonce = $this->elucidat->get_nonce($endpoint.'reseller/create_new_account', $key, $secret);
		// headers
		$headers = $this->elucidat->auth_headers($key, $nonce);
		//print_r($headers);
		// create the account
		$fields = array(
		    'company_name'=>$data['account']['company_name'],
		    'company_email'=>$data['account']['company_email'],
		    'first_name'=>$data['account']['first_name'],
		    'last_name'=>$data['account']['last_name'],
		    'telephone'=>$data['account']['telephone'],
		    'address1'=>$data['account']['address1'],
		    'address2'=>$data['account']['address2'],
		    'postcode'=>$data['account']['postcode'],
		    'country'=>$data['account']['country']
		);
		$result = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'reseller/create_new_account', $secret);
		
		if (!isset($result['response']['customer_code']))
			exit("There was a problem creating the account: HTTP status code: " . $result['status'] );

		// save the customer_code to the database
		$customer_code = $result['response']['customer_code'];
		$this->account_model->save_customer_code_to_account( $account_id, $customer_code );


		// then create an API key
		// then create an API key
		// then create an API key
		// then create an API key
		$nonce = $this->elucidat->get_nonce($endpoint.'reseller/create_new_key', $key, $secret);
		$headers = $this->elucidat->auth_headers($key, $nonce);
		$fields = array(
    		'customer_code'=>$customer_code,
    		'name'=>'LMS example'
    	);
		$result = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'reseller/create_new_key', $secret);
		
		if (!isset($result['response']['public_key']))
			exit("There was a problem creating the API key: HTTP status code: " . $result['status'] );

		// save the API key to the account record
		$account_api_key = $result['response']['public_key'];
		$this->account_model->save_public_key_to_account( $account_id, $account_api_key );

		// then subscribe to webhooks
		// then subscribe to webhooks
		// then subscribe to webhooks
		// then subscribe to webhooks
		// then subscribe to webhooks
		$nonce = $this->elucidat->get_nonce($endpoint.'event/subscribe', $account_api_key, $secret);
		$headers = $this->elucidat->auth_headers($account_api_key, $nonce);
		$fields = array(
            'event'=>'release_course',
            'callback_url'=> base_url('webhook/release')
        );
		$results = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'event/subscribe', $secret);
		// echo ("HTTP status code: " . $result['status'] . "\n");
		// print_r($result['response']);


		// redirect to index
		redirect('/accounts/view/'.$account_id, 'refresh');

	}

}
