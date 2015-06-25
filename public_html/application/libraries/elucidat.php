
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Library to manage communication with Elucidat.
 *
 * @package Elucidat
 * @author  Ioan Morgan
 */

class Elucidat
{

    function __construct()
    {
        $this->ci =& get_instance();
    }

    /**
     * Makes an API request to elucidat
     * @param $headers
     * @param $fields
     * @param $url
     * @param $consumer_secret
     * @return mixed
     */
    public function call_elucidat($headers, $fields, $method, $url, $consumer_secret){
        //Build a signature
        $headers['oauth_signature'] = $this->build_signature($consumer_secret, array_merge($headers, $fields), $method, $url);
        //Build OAuth headers
        $auth_headers = 'Authorization:';
        $auth_headers .= $this->build_base_string($headers, ',');
        //Build the request string
        $fields_string = $this->build_base_string($fields, '&');

        //Set the headers
        $header = array($auth_headers, 'Expect:');
        // Create curl options
        if(strcasecmp($method, "GET") == 0){
            $url .= '?'.$fields_string;
            $options = array(
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_HEADER => false,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false);
        } else {
            $options = array(
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_HEADER => false,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POST => count($fields),
                CURLOPT_POSTFIELDS => $fields_string);
        }
        //Init the request and set its params
        $request = curl_init();
        curl_setopt_array($request, $options);
         //Make the request
        $response = curl_exec($request);
        $status = curl_getinfo($request, CURLINFO_HTTP_CODE);

        curl_close($request);
        return array(
            'status' => $status,
            'response' => json_decode($response, true)
        );
    }

    /**
     * Each request to the elucidat API must be accompanied by a unique key known as a nonce.
     * This key adds an additional level of security to the API.
     * A new key must be requested for each API call.
     * @param $api_url
     * @param $consumer_key
     * @param $consumer_secret
     * @return bool
     */
    public function get_nonce($api_url, $consumer_key, $consumer_secret){
        // Start with some standard headers, unsetting the oauth_nonce. without the nonce header the API will automatically issue us one.
        $auth_headers = $this->auth_headers($consumer_key);
        unset($auth_headers['oauth_nonce']);

        //Make a request to elucidat for a nonce...any url is fine providing it doesnt already have a nonce
        $json = $this->call_elucidat($auth_headers, array(), 'GET', $api_url, $consumer_secret);

        if(isset($json['response']['nonce'])){
            return $json['response']['nonce'];
        }
        return false;
    }

    /**
     * Computes and returns a signature for the request.
     * @param $secret
     * @param $fields
     * @param $request_type
     * @param $url
     * @return string
     */
    public function build_signature($secret, $fields, $request_type, $url){
        ksort($fields);
        //Build base string to be used as a signature
        $base_info = $request_type.'&'.$url.'&'.$this->build_base_string($fields, '&'); //return complete base string
        //Create the signature from the secret and base string
        $composite_key = rawurlencode($secret);
        return base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));

    }

    /**
     * Builds a segment from an array of fields.  Its used to create string representations of headers and URIs
     * @param $fields
     * @param $delim
     * @return string
     */
    public function build_base_string($fields, $delim){
        $r = array();
        foreach($fields as $key=>$value){
            $r[] = rawurlencode($key) . "=" . rawurlencode($value);
        }
        return implode($delim, $r); //return complete base string

    }

    /**
     * Returns typical headers needed for a request
     * @param $consumer_key
     * @param $nonce
     */
    public function auth_headers($consumer_key, $nonce = ''){
        return array('oauth_consumer_key' => $consumer_key,
            'oauth_nonce' => $nonce,
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0');
    }
}