<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {



	/**
	 * Register webhooks
	 *
	 * @return void
	*/
	public function register($account_id)
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
		$secret = $this->config->item('elucidat_api_secret');
		$webhooks = $this->config->item('webhooks');
		$this->load->library('elucidat');

		// Register each webhook in the config
		foreach($webhooks as $event => $callback){
			$customer_key = $data['account']['elucidat_public_key'];
			// get the nonce
			$nonce = $this->elucidat->get_nonce($endpoint.'reseller/create_new_account', $customer_key, $secret);
			// headers
			$headers = $this->elucidat->auth_headers($customer_key, $nonce);
			// create the event subscription
		    $fields = array(
		        'event'=>$event,
		        'callback_url'=>$callback,
		    );
			$result = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'event/subscribe', $secret);
		}
		redirect('/accounts/view/'.$account_id, 'refresh');
	}

	/**
	 * catches release callbacks
	 *
	 * @return void
	*/
	public function release()
	{
		// save the params - or email them or something
		file_put_contents( BASEPATH .'../../release_log.txt', $_POST );
	}
	/**
	 * catches new reseller signups from elucidat
	 *
	 * @return void
	*/
	public function reseller_trial_signup()
	{
		// save the params - or email them or something
		file_put_contents( BASEPATH .'../../trial_signups_log.txt', $_POST );
	}

}
