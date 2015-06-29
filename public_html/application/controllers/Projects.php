<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

	/**
	 * Default page - lists accounts in the LMS
	 *
	 * @return void
	 */
	public function index ( $account_id )
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
		$nonce = $this->elucidat->get_nonce($endpoint.'projects', $customer_key, $secret);
		// headers
		$headers = $this->elucidat->auth_headers($customer_key, $nonce);
		// create the account
		$fields = array();
		$response = $this->elucidat->call_elucidat($headers, $fields, 'GET', $endpoint.'projects', $secret);

		$data['projects'] = $response['response'];
		$data['add_project_link'] = $this->config->item('elucidat_author_app_url');

		// and load the view
		$data['page_content'] = $this->load->view('pages/projects_all', $data, TRUE);
		$this->load->view('wrapper', $data);


	}

}
