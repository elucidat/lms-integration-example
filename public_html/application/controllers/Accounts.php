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
		$this->load->helper('url');
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

		// now get LMS user that will be the owner
		$this->load->model('user_model');
		$data['account_owner'] = $this->user_model->get_single_user( $account_id, $this->input->post('account_owner') );

		if (empty($data['account_owner']))
			show_404();

		print_r($data);
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
		print_r($headers);
		// create the account
		$fields = array(
		    'company_name'=>$data['account']['company_name'],
		    'first_name'=>$data['account_owner']['first_name'],
		    'last_name'=>$data['account_owner']['last_name'],
		    'email'=>$data['account_owner']['email'],
		    'telephone'=>'1234',
		    'num_editors'=> $this->input->post('num_authors') ? $this->input->post('num_authors') : 5,
		    'subscription_level'=> $this->input->post('subscription_level') ? $this->input->post('subscription_level') : 'enterprise',
		//    'simulation_mode'=>'simulation'
		);
		$result = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'reseller/create_new_account', $secret);
		echo ("HTTP status code: " . $result['status'] . "\n");
		print_r($result['response']);

		/*
			
			@ioan - nonce is failing here

			Creating the user does feel a little awkward for me here - I know we chatted about this yesterday - but perhaps we can have another chat through?


		*/

		exit;

		// save the customer_code to the database



		// mark the owner account as having Elucidat access (type owner)



		// then create an API key
		#code as above, then...
		$nonce = $this->elucidat->get_nonce($endpoint.'reseller/create_new_key', $key, $secret);
		$headers = $this->elucidat->auth_headers($key, $nonce);
		$fields = array(
    		'customer_code'=>$arg1,
    		'name'=>$arg2
    	);
		$result = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'reseller/create_new_key', $secret);
		echo ("HTTP status code: " . $result['status'] . "\n");
		print_r($result['response']);

		// save the API key to the account record



		// then subscribe to webhooks
		$nonce = $this->elucidat->get_nonce($endpoint.'event/subscribe', $key, $secret);
		$headers = $this->elucidat->auth_headers($key, $nonce);
		$fields = array(
            'event'=>$arg1,
            'callback_url'=> base_url('webhook/release')
        );
		$results = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'event/subscribe', $secret);
		echo ("HTTP status code: " . $result['status'] . "\n");
		print_r($result['response']);


		// redirect to index

	}

}
