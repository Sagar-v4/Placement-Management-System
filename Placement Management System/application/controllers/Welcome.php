<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
	    $this->load->helper('url');
		$requirements = array();

		$this->db->where('company_requirement_status', 1);
		$requirements = $this->db->get('pms_company_requirements')->result_array();
		
		$i = 0;
		if ( !empty($requirements) ) { 
			foreach ($requirements as $requirement) { 
				$this->db->where('company_id', $requirement['company_id']);
				$pic = $this->db->get('pms_company_media')->row_array();

				$requirements[$i++]['company_requirement_pic'] = $pic['company_profile_pic'] ;
			}
		}

		$requirements['requirements'] = $requirements;

		$this->load->view('home/home', $requirements);
	}
}
