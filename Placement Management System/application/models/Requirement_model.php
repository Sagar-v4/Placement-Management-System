<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requirement_model extends CI_Model {

	public function store_new_requirement($requirementArray) {
        
        // Insert in pms_company_requirements Table
        
		$this->db->where('company_email', $this->session->userdata['company']['email']);
        $company = $this->db->get('pms_company_info')->row_array();

        $requirementArray['company_id'] = $company['company_id'];
        $requirementArray['company_name'] = $company['company_name'];

        $this->db->insert('pms_company_requirements', $requirementArray);

    }
}
