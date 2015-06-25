<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Gets LMS account
 *
 * @package Elucidat
 * @version		1.0.0
 */
class User_model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}
    /**
     * Get all accounts for the LMS
     *
     * @param int
     * @return  array
     */

    public function get_all_users ( $account_id) {
        $query = $this->db->query('select * from user where account_id = ? order by id', array($account_id) );
        return $query->result_array();
    }

    /**
     * Adds a new author into the LMS
     *
     * @param array
     * @return  array
     */
    public function add_user ( $account_id, $postVars ) {

        $data = array(
           'account_id' => $account_id,
           'email' => isset( $postVars['email'] ) ? $postVars['email'] : 'support@elucidat.com',
           'first_name' => isset( $postVars['first_name'] ) ? $postVars['first_name'] : 'First',
           'last_name' => isset( $postVars['last_name'] ) ? $postVars['last_name'] : 'Last'
        );

        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    /**
     * Get all users for the LMS
     *
     * @param int
     * @return  array
     */
    public function get_single_user ( $account_id, $user_id ) {

        $query = $this->db->query('select * from user where account_id = ? AND id = ?', array($account_id, $user_id));
        return $query->first_row('array');

    }


}