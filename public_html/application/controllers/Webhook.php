<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {



	/**
	 * Register for subscription creation notifications
	 *
	 * @return void
	*/
	public function subscribe_to_new_trials ()
	{

		$data = array();

		// get config
		$this->load->config('elucidat');
		$endpoint = $this->config->item('elucidat_endpoint');
		$key = $this->config->item('elucidat_api_key');
		$secret = $this->config->item('elucidat_api_secret');
		$this->load->library('elucidat');

		// get the nonce
		$nonce = $this->elucidat->get_nonce($endpoint.'event/subscribe', $key, $secret);
		// headers
		$headers = $this->elucidat->auth_headers($key, $nonce);
		// create the event subscription
		$fields = array(
	        'event'=>'reseller_trial_signup',
	        'callback_url'=>base_url('webhook/reseller_trial_signup'),
		);
		$result = $this->elucidat->call_elucidat($headers, $fields, 'POST', $endpoint.'event/subscribe', $secret);
	
		// save the feedback
		$this->session->set_flashdata('message', 'Subscribed to trial sign-up notifications.');
		// back to home
		redirect('/', 'refresh');
	}

	/**
	 * catches release callbacks
	 *
	 * @return void
	*/
	public function release()
	{
		// save the params
		file_put_contents( BASEPATH .'../../release_log.txt', $_POST );

		/*
			Example workflow - 
				- on release - 
				- download zip file
				- add into LMS
				- notify subscribers
		*/

	}
	/**
	 * catches new reseller signups from elucidat
	 *
	 * @return void
	*/
	public function reseller_trial_signup()
	{
		// save the params
		file_put_contents( BASEPATH .'../../trial_signups_log.txt', $_POST );

		/*
			Example workflow - 
				- on trial sign-up - 
				- add API key
				- subscribe to release events
				- create linked account in LMS
				- add to sales CRM system and send welcome email
		*/
	}

}
