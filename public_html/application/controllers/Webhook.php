<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {

	/**
	 * Default page- redirects to login or shows message
	 *
	 * @return void
	*/
	public function release()
	{
		// save the params - or email them or something

		file_put_contents( BASEPATH .'/../log.txt', json_encode( $_POST ));
	}

}
