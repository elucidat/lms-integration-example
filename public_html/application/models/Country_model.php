<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Country list from for account details dropdown. Sourced from http://peric.github.io/GetCountries/
 *
 * @package Elucidat
 * @author		Ian Budden (http://ianbudden.com)
 * @version		1.0.0
 */
class Country_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();
	}

 
    /**
     * Get all of the countries
     *
     * @return  array
     */
    public function get_countries () {

        $query = $this->db->query('select * from country order by prioritise desc, countryCode asc' );
        
        $order = array();
        $last_p = 1;

        foreach ($query->result_array() as $c) {
            
            if ($last_p != $c['prioritise'])
                $order[ '-----' ] = '-------------';  

            $order[ $c['countryCode'] ] = $c['countryName'];            
 

            $last_p = $c['prioritise'];

        }

        return $order;
    }

}
/* End of file User_profile_model.php */
/* Location: ./application/models/User_profile_model.php */