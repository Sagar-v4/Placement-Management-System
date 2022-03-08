<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function getAllAdmins()	{

        return $this->db->get('pms_admin_info')->result_array();

	}

    public function getAllCompanies() {

        return $this->db->get('pms_company_info')->result_array();

    }

    public function getAllStudents() {

        return $this->db->get('pms_student_info')->result_array();

    }

}
