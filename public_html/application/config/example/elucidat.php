<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Elucidat.com API credentials
|--------------------------------------------------------------------------
*/
$config['elucidat_endpoint'] = 'https://api.elucidat.com/v2/';
$config['elucidat_author_app_url'] = 'https://author.elucidat.com/';
$config['elucidat_api_key'] = '';
$config['elucidat_api_secret'] = '';

// Configure Webhooks. Format - 'event' => 'callback_url'.  See API docs for more information on available hooks.
$config['webhooks']['release_course'] = 'http://www.example.com/webhook/release';
$config['webhooks']['reseller_trial_signup'] = 'http://www.example.com/webhook/reseller_trial_signup';