<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Gets LMS account
 *
 * @package Elucidat
 * @version		1.0.0
 */
class Account_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();
	}

    /**
     * Get all accounts for the LMS
     *
     * @return  array
     */
    public function get_all_accounts () {

        $query = $this->db->query('select * from account order by id');
        return $query->result_array();

    }
    /**
     * Adds a new account for the LMS
     *
     * @param array
     * @return  array
     */
    public function add_account ( $postVars ) {

        $data = array(
           'company_name' => isset( $postVars['company_name'] ) ? $postVars['company_name'] : 'Acme Ltd',
           'company_email' => isset( $postVars['company_email'] ) ? $postVars['company_email'] : 'support+test@elucidat.com',
           'first_name' => isset( $postVars['first_name'] ) ? $postVars['first_name'] : 'Jane',
           'last_name' => isset( $postVars['last_name'] ) ? $postVars['last_name'] : 'Doe',
           'telephone' => isset( $postVars['telephone'] ) ? $postVars['telephone'] : '1234',
           'address1' => isset( $postVars['address1'] ) ? $postVars['address1'] : 'Number 10 Downing Street',
           'address2' => isset( $postVars['address2'] ) ? $postVars['address2'] : 'Westminster',
           'postcode' => isset( $postVars['postcode'] ) ? $postVars['postcode'] : 'SW1A 2AA',
           'country' => isset( $postVars['country'] ) ? $postVars['country'] : 'GB',
        );

        $this->db->insert('account', $data); 

        return $this->db->insert_id();

    }


    /**
     * Get all accounts for the LMS
     *
     * @param int
     * @return  array
     */
    public function get_single_account ( $account_id ) {

        $query = $this->db->query('select * from account where id = ?', array($account_id));
        return $query->first_row('array');

    }


    /**
     * Save the customer code to the account record
     *
     * @param int
     * @param int
     */
    public function save_customer_code_to_account ( $account_id, $customer_code ) {
        $query = $this->db->query('update account set elucidat_customer_code = ? where id = ?', array($customer_code, $account_id));
        
    }
    
    /**
     * Save the customer code to the account record
     *
     * @param int
     * @param int
     */
    public function save_public_key_to_account ( $account_id, $key ) {
        $query = $this->db->query('update account set elucidat_public_key = ? where id = ?', array($key, $account_id));
        
    }
    

}