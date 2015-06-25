<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Add a new LMS user
	 *
	 * @return void
	 */
	public function add( $account_id )
	{
		// add database record, and redirect to view detail page

		$this->load->model('user_model');
		// insert row
		$new_id = $this->user_model->add_user( $account_id, $this->input->post(NULL, TRUE) );
		// rediret to detail view
		redirect('/accounts/view/'.$account_id, 'refresh');

	}

	/**
	 * Create the user in Elucidat
	 *
	 * @return void
	 */
	public function create_elucidat_account( $account_id, $user_id )
	{

		$this->load->model('account_model');
		$account = $this->account_model->get_single_account( $account_id );
		if (empty($account) || !$account['elucidat_public_key'])
			show_404();

		$this->load->model('user_model');
		// get the user
		$user = $this->user_model->get_single_user( $account_id, $user_id );
		if (empty($user))
			show_404();

		// load config
		$this->load->config('elucidat');
		$endpoint = $this->config->item('elucidat_endpoint');
		// using customer's key - NOT the one in the config file
		$customer_key = $account['elucidat_public_key'];
		$secret = $this->config->item('elucidat_api_secret');
		// 
		$this->load->library('elucidat');
		// get the nonce
		$nonce = $this->elucidat->get_nonce($endpoint.'authors/create', $customer_key, $secret);
		// and form the request
		$headers = $this->elucidat->auth_headers($customer_key, $nonce);
		$fields = array(
		    'first_name'=>$user['first_name'],
		    'last_name'=>$user['last_name'],
		    'email'=>$user['email']
		);

		$result = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'authors/create', $secret);

		// mark the author as having access
		$this->user_model->save_has_elucidat_access ( $account_id, $user_id );

		// redirect to detail view
		redirect('/accounts/view/'.$account_id.'?refresh='.$user['id'], 'refresh');

	}
	/**
	 * Change role in Elucidat
	 *
	 * @return void
	 */
	public function change_elucidat_role( $account_id, $user_id, $new_role )
	{

		$this->load->model('account_model');
		$account = $this->account_model->get_single_account( $account_id );
		if (empty($account) || !$account['elucidat_public_key'])
			show_404();

		$this->load->model('user_model');
		// get the user
		$user = $this->user_model->get_single_user( $account_id, $user_id );
		if (empty($user))
			show_404();

		// load config
		$this->load->config('elucidat');
		$endpoint = $this->config->item('elucidat_endpoint');
		// using customer's key - NOT the one in the config file
		$customer_key = $account['elucidat_public_key'];
		$secret = $this->config->item('elucidat_api_secret');
		// 
		$this->load->library('elucidat');
		// get the nonce
		$nonce = $this->elucidat->get_nonce($endpoint.'authors/change_role', $customer_key, $secret);
		// and form the request
		$headers = $this->elucidat->auth_headers($customer_key, $nonce);
		$fields = array(
		    'email'=>$user['email'],
		    'role'=>$user['new_role']
		);

		$result = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'authors/change_role', $secret);

		// redirect to detail view
		redirect('/accounts/view/'.$account_id.'?refresh='.$user['id'], 'refresh');

	}
	/**
	 * Change role in Elucidat
	 *
	 * @return void
	 */
	public function revoke_elucidat_access( $account_id, $user_id )
	{

		$this->load->model('account_model');
		$account = $this->account_model->get_single_account( $account_id );
		if (empty($account) || !$account['elucidat_public_key'])
			show_404();

		$this->load->model('user_model');
		// get the user
		$user = $this->user_model->get_single_user( $account_id, $user_id );
		if (empty($user))
			show_404();

		// load config
		$this->load->config('elucidat');
		$endpoint = $this->config->item('elucidat_endpoint');
		// using customer's key - NOT the one in the config file
		$customer_key = $account['elucidat_public_key'];
		$secret = $this->config->item('elucidat_api_secret');
		// 
		$this->load->library('elucidat');
		// get the nonce
		$nonce = $this->elucidat->get_nonce($endpoint.'authors/delete', $customer_key, $secret);
		// and form the request
		$headers = $this->elucidat->auth_headers($customer_key, $nonce);
		$fields = array(
		    'email'=>$user['email']
		);

		$result = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'authors/delete', $secret);

		// mark the author as having access
		$this->user_model->save_has_elucidat_access ( $account_id, $user_id, false );

		// redirect to detail view
		redirect('/accounts/view/'.$account_id.'?refresh='.$user['id'], 'refresh');

	}
}
