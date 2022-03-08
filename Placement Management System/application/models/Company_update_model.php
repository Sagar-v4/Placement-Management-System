<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_update_model extends CI_Model {

	public function personal($companyArray) {
        
        $update = array(
            'company_name' => $companyArray['company_name'],
            'company_link' => $companyArray['company_link']
        );

		$this->db->where('company_email', $this->session->userdata['company']['email'] );
        $this->db->update('pms_company_info', $update);

	}

	public function description($companyDescription) {
        
        $update = array(
            'company_description' => $companyDescription
        );

		$this->db->where('company_email', $this->session->userdata['company']['email'] );
        $this->db->update('pms_company_info', $update);

	}

	public function address($studentArray) {
        
        $update = array(
			'student_address' => $studentArray['address'],
			'student_locality' => $studentArray['locality'],
			'student_city' => $studentArray['city'],
			'student_district' => $studentArray['district'],
			'student_pincode' => $studentArray['pincode'],
			'student_state' => $studentArray['state'],
			'student_country' => $studentArray['country']
        );

		$this->db->where('student_email', $this->session->userdata['student']['email'] );
        $this->db->update('pms_student_info', $update);

	}

	public function percentage($studentArray) {
        
        $update = array(
            'student_percentage_10th' => $studentArray['tenth_percentage'],
            'student_percentage_12th' => $studentArray['twelfth_percentage']
        );

		$this->db->where('student_email', $this->session->userdata['student']['email'] );
        $this->db->update('pms_student_info', $update);

	}

	public function highDegree($studentArray) {
        
        $update = array(
			'student_high_degree' => $studentArray['high_degree'],
			'student_high_discipline' => $studentArray['high_discipline'],
			'student_high_university' => $studentArray['high_university'],
			'student_high_city' => $studentArray['high_city'],
			'student_high_state' => $studentArray['high_state'],
			'student_high_passing' => $studentArray['high_mm_yyyy'],
            'student_high_percentage' => $studentArray['high_percentage'],
            'student_high_cgpa' => $studentArray['high_cgpa']
        );

		$this->db->where('student_email', $this->session->userdata['student']['email'] );
        $this->db->update('pms_student_info', $update);

	}

	public function adDegree($studentArray) {
        
	}

	public function proUpload($profile, $thumb) {
        
        $update = array(
            'company_profile_pic' => $profile,
            'company_profile_pic_thumb' => $thumb
        );

		$this->db->where('company_email', $this->session->userdata['company']['email'] );
        $company = $this->db->get('pms_company_info')->row_array();

        $this->db->where('company_id', $company['company_id']);
        $this->db->update('pms_company_media', $update);

	}

	public function covUpload($cover) {
        
        $update = array(
            'company_cover_pic' => $cover
        );

		$this->db->where('company_email', $this->session->userdata['company']['email'] );
        $company = $this->db->get('pms_company_info')->row_array();

        $this->db->where('company_id', $company['company_id']);
        $this->db->update('pms_company_media', $update);

	}
}
