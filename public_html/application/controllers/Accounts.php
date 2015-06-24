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
		$data['page_content'] = $this->load->view('pages/accounts', $data, TRUE);
		$this->load->view('wrapper', $data);
	}


	/**
	 * Default page- redirects to login or shows message
	 *
	 * @return void
	 */
	public function add()
	{

		$data = array();
		$data['page_content'] = $this->load->view('pages/accounts', $data, TRUE);
		$this->load->view('wrapper', $data);
	}



}
