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

		// get config
		$this->load->config('elucidat');
		$endpoint = $this->config->item('elucidat_endpoint');
		$key = $this->config->item('elucidat_api_key');
		$secret = $this->config->item('elucidat_api_secret');

		$this->load->library('elucidat');

		// get the nonce
		$nonce = $this->elucidat->get_nonce($endpoint.'projects', $key, $secret);
		// headers
		$headers = $this->elucidat->auth_headers($key, $nonce);
		// create the account
		$fields = array();
		$data['projects'] = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'projects', $secret);

		print_r($data['projects']);


		// and load the view
		$data['page_content'] = $this->load->view('pages/projects_all', $data, TRUE);
		$this->load->view('wrapper', $data);


	}

	/**
	 * Default page - lists accounts in the LMS
	 *
	 * @return void
	 */
	public function view ( $account_id, $project_code )
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
		$key = $this->config->item('elucidat_api_key');
		$secret = $this->config->item('elucidat_api_secret');

		$this->load->library('elucidat');

		// get the nonce
		$nonce = $this->elucidat->get_nonce($endpoint.'projects', $key, $secret);
		// headers
		$headers = $this->elucidat->auth_headers($key, $nonce);
		// create the account
		$fields = array();
		$data['projects'] = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'projects', $secret);

		print_r($data['projects']);
		
		
		// and load the view
		$data['page_content'] = $this->load->view('pages/projects_all', $data, TRUE);
		$this->load->view('wrapper', $data);

	}



}
