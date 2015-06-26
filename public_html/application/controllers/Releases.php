<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Releases extends CI_Controller {

	/**
	 * Default page - lists accounts in the LMS
	 *
	 * @return void
	 */
	public function index ( $account_id, $project_code )
	{
		// add database record, and redirect to view detail page

		$data = array();
		// get the account data
		$this->load->model('account_model');
		$data['account'] = $this->account_model->get_single_account( $account_id );
		
		if (empty($data['account']))
			show_404();

		// get all of the users too - for editing deeplinks
		$this->load->model('user_model');
		$data['users'] = $this->user_model->get_all_users( $account_id );

		// get config
		$this->load->config('elucidat');
		$endpoint = $this->config->item('elucidat_endpoint');
		$customer_key = $data['account']['elucidat_public_key'];
		$secret = $this->config->item('elucidat_api_secret');

		$this->load->library('elucidat');

		// get the nonce
		$nonce = $this->elucidat->get_nonce($endpoint.'releases', $customer_key, $secret);
		// headers
		$headers = $this->elucidat->auth_headers($customer_key, $nonce);
		// create the account
		$fields = array(
			'project_code' => $project_code
		);
		$response = $this->elucidat->call_elucidat($headers, $fields, 'GET', $endpoint.'releases', $secret);

		$data['releases'] = $response['response'];
		$data['project_code'] = $project_code;
		
		// and load the view
		$data['page_content'] = $this->load->view('pages/releases_all', $data, TRUE);
		$this->load->view('wrapper', $data);

	}


	/**
	 * Create a new release for a Project
	 *
	 * @return void
	 */
	public function add ( $account_id, $project_code )
	{
		// add database record, and redirect to view detail page
		$data = array();
		// get the account data
		$this->load->model('account_model');
		$data['account'] = $this->account_model->get_single_account( $account_id );
		
		if (empty($data['account']))
			show_404();

		// get config
		$this->load->config('elucidat');
		$endpoint = $this->config->item('elucidat_endpoint');
		$customer_key = $data['account']['elucidat_public_key'];
		$secret = $this->config->item('elucidat_api_secret');

		$this->load->library('elucidat');

		// get the nonce
		$nonce = $this->elucidat->get_nonce($endpoint.'releases/create', $customer_key, $secret);
		// headers
		$headers = $this->elucidat->auth_headers($customer_key, $nonce);
		// construct the query
		$fields = array(
			'project_code' => $project_code,
			'release_mode' => 'scorm' // can be scorm, online-public, online-private, or offline-backup
		);
		$response = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'releases/create', $secret);

		// save the feedback
		$this->session->set_flashdata('message', 'Release queued (note - it will not show in this list until publishing has completed.');
		// redirect to detail view
		redirect('/releases/index/'.$account_id.'/'.$project_code.'?refresh='.$project_code, 'refresh');

	}

	/**
	 * Get the download zip for a course
	 *
	 * @return void
	 */
	public function download ( $account_id, $release_code )
	{
		// add database record, and redirect to view detail page
		$data = array();
		// get the account data
		$this->load->model('account_model');
		$data['account'] = $this->account_model->get_single_account( $account_id );
		
		if (empty($data['account']))
			show_404();

		// get config
		$this->load->config('elucidat');
		$endpoint = $this->config->item('elucidat_endpoint');
		$customer_key = $data['account']['elucidat_public_key'];
		$secret = $this->config->item('elucidat_api_secret');

		$this->load->library('elucidat');

		// get the nonce
		$nonce = $this->elucidat->get_nonce($endpoint.'releases/details', $customer_key, $secret);
		// headers
		$headers = $this->elucidat->auth_headers($customer_key, $nonce);
		// construct the query
		$fields = array(
			'release_code' => $release_code,
			'release_mode' => 'scorm' // can be scorm, online-public, online-private, or offline-backup
		);
		$response = $this->elucidat->call_elucidat($headers, $fields, 'GET', $endpoint.'releases/details', $secret);

		print_r($response);

		// save the feedback
		//redirect('/releases/index/'.$account_id.'/'.$project_code.'?refresh='.$project_code, 'refresh');

	}

	/**
	 * Get the download zip for a course
	 *
	 * @return void
	 */
	public function launch ( $account_id, $release_code, $user_id )
	{
		// add database record, and redirect to view detail page
		$data = array();
		// get the account data
		$this->load->model('account_model');
		$data['account'] = $this->account_model->get_single_account( $account_id );
		
		if (empty($data['account']))
			show_404();

		$this->load->model('user_model');
		// get the user
		$user = $this->user_model->get_single_user( $account_id, $user_id );
		if (empty($user))
			show_404();

		// get config
		$this->load->config('elucidat');
		$endpoint = $this->config->item('elucidat_endpoint');
		$customer_key = $data['account']['elucidat_public_key'];
		$secret = $this->config->item('elucidat_api_secret');

		$this->load->library('elucidat');

		// get the nonce
		$nonce = $this->elucidat->get_nonce($endpoint.'releases/launch', $customer_key, $secret);
		// headers
		$headers = $this->elucidat->auth_headers($customer_key, $nonce);
		// construct the query
		$fields = array(
			'release_code' => $release_code,
			'name' => implode(' ', array($user['first_name'],$user['first_name'])),
			'email' => $user['email']
		);
		$response = $this->elucidat->call_elucidat($headers, $fields, 'GET', $endpoint.'releases/launch', $secret);

		print_r($response);

		// now make launch link to course


		// save the feedback
		//redirect('/releases/index/'.$account_id.'/'.$project_code.'?refresh='.$project_code, 'refresh');

	}
}
