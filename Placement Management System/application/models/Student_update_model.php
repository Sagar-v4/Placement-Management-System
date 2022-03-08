<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_update_model extends CI_Model {

	public function personal($studentArray) {
        
        $update = array(
            'student_first_name' => $studentArray['first_name'],
            'student_middle_name' => $studentArray['middle_name'],
            'student_last_name' => $studentArray['last_name'],
            'student_gender' => $studentArray['gender'],
            'student_dob' => $studentArray['dob']
        );

		$this->db->where('student_email', $this->session->userdata['student']['email'] );
        $this->db->update('pms_student_info', $update);

	}

	public function contact($studentArray) {
        
        $update = array(
            'student_phone_number' => $studentArray['mobile_number']
        );
        
        $update['student_std_code'] = (!empty($studentArray['std_code'])) ? $studentArray['std_code'] : NULL;
        
        $update['student_telephone_number'] = (!empty($studentArray['telephone_number'])) ? $studentArray['telephone_number'] : NULL;

		$this->db->where('student_email', $this->session->userdata['student']['email'] );
        $this->db->update('pms_student_info', $update);

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
            
        );
        
        $update['student_high_percentage'] = (!empty($studentArray['high_percentage'])) ? $studentArray['high_percentage'] : NULL;
        
        $update['student_high_cgpa'] = (!empty($studentArray['high_cgpa'])) ? $studentArray['high_cgpa'] : NULL;
        
		$this->db->where('student_email', $this->session->userdata['student']['email'] );
        $this->db->update('pms_student_info', $update);

	}

	public function adDegree($studentArray) {
        
	}

	public function proUpload($profile, $thumb) {
        
        $update = array(
            'student_profile_pic' => $profile,
            'student_profile_pic_thumb' => $thumb
        );

		$this->db->where('student_email', $this->session->userdata['student']['email'] );
        $student = $this->db->get('pms_student_info')->row_array();

        $this->db->where('student_id', $student['student_id']);
        $this->db->update('pms_student_media', $update);

	}

	public function covUpload($cover) {
        
        $update = array(
            'student_cover_pic' => $cover
        );

		$this->db->where('student_email', $this->session->userdata['student']['email'] );
        $student = $this->db->get('pms_student_info')->row_array();

        $this->db->where('student_id', $student['student_id']);
        $this->db->update('pms_student_media', $update);

	}
}
