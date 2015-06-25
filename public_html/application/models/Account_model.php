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
           'company_name' => isset( $postVars['company_name'] ) ? $postVars['company_name'] : 'Acme Ltd'
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
    

}