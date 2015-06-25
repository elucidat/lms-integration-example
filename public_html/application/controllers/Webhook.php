<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {

	/**
	 * Default page- redirects to login or shows message
	 *
	 * @return void
	public function add( $account_id )
	{
		// add database record, and redirect to view detail page

		$this->load->model('user_model');
		// insert row
		$new_id = $this->user_model->add_user( $account_id, $this->input->post(NULL, TRUE) );
		// rediret to detail view
		$this->load->helper('url');
		redirect('/accounts/view/'.$account_id, 'refresh');

	}
	 */

}
