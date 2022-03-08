<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_user_info_model extends CI_Model {

    public function get_user_info($userEmail) {

		$this->db->where('user_email', $userEmail);
        $user =  $this->db->get('pms_users')->row_array();

        if ( $user['user_role'] == 'admin' ) {
		    
            $this->db->where('admin_email', $userEmail);
            $admin = $this->db->get('pms_admin_info')->row_array();
            
            $userInfo['aid'] = $admin['admin_id'];
            $userInfo['fname'] = $admin['admin_first_name'];
            $userInfo['mname'] = $admin['admin_middle_name'];
            $userInfo['lname'] = $admin['admin_last_name'];
            $userInfo['power'] = $admin['admin_power'];
            $userInfo['gender'] = $admin['admin_gender'];
            $userInfo['email'] = $admin['admin_email'];
            $userInfo['password'] = $admin['admin_password'];
            $userInfo['dob'] = $admin['admin_dob'];

            $this->db->where('admin_id', $userInfo['aid']);
            $adminmedia = $this->db->get('pms_admin_media')->row_array(); 

            $userInfo['profile'] = $adminmedia['admin_profile_pic'];
            $userInfo['profile_thumb'] = $adminmedia['admin_profile_pic_thumb'];
            $userInfo['cover'] = $adminmedia['admin_cover_pic'];


        } else if ( $user['user_role'] == 'company' ) {
		    
            $this->db->where('company_email', $userEmail);
            $company = $this->db->get('pms_company_info')->row_array();

            $userInfo['cid'] = $company['company_id'];
            $userInfo['name'] = $company['company_name'];
            $userInfo['email'] = $company['company_email'];
            $userInfo['password'] = $company['company_password'];
            $userInfo['link'] = $company['company_link'];
            $userInfo['description'] = $company['company_description'];

            $this->db->where('company_id', $userInfo['cid']);
            $companymedia = $this->db->get('pms_company_media')->row_array(); 

            $userInfo['profile'] = $companymedia['company_profile_pic'];
            $userInfo['profile_thumb'] = $companymedia['company_profile_pic_thumb'];
            $userInfo['cover'] = $companymedia['company_cover_pic'];


        } else if ( $user['user_role'] == 'student' ) {
		    
            $this->db->where('student_email', $userEmail);
            $student = $this->db->get('pms_student_info')->row_array();          

            $userInfo['sid'] = $student['student_id'];
            $userInfo['fname'] = $student['student_first_name'];
            $userInfo['mname'] = $student['student_middle_name'];
            $userInfo['lname'] = $student['student_last_name'];
            $userInfo['gender'] = $student['student_gender'];
            $userInfo['email'] = $student['student_email'];
            $userInfo['password'] = $student['student_password'];
            $userInfo['dob'] = $student['student_dob'];

            $userInfo['address'] = $student['student_address'];
            $userInfo['locality'] = $student['student_locality'];
            $userInfo['city'] = $student['student_city'];
            $userInfo['district'] = $student['student_district'];
            $userInfo['pincode'] = $student['student_pincode'];
            $userInfo['state'] = $student['student_state'];
            $userInfo['country'] = $student['student_country'];

            $userInfo['mobile'] = $student['student_phone_number'];
            $userInfo['std'] = $student['student_std_code'];
            $userInfo['telephone'] = $student['student_telephone_number'];

            $userInfo['r10'] = $student['student_percentage_10th'];
            $userInfo['r12'] = $student['student_percentage_12th'];

            $userInfo['degree_h'] = $student['student_high_degree'];
            $userInfo['discipline_h'] = $student['student_high_discipline'];
            $userInfo['university_h'] = $student['student_high_university'];
            $userInfo['city_h'] = $student['student_high_city'];
            $userInfo['state_h'] = $student['student_high_state'];
            $userInfo['month_h'] = $student['student_high_passing'];
            $userInfo['percentage_h'] = $student['student_high_percentage'];
            $userInfo['cgpa_h'] = $student['student_high_cgpa'];
            
            $userInfo['degree_1'] = $student['student_ad1_degree'];
            $userInfo['discipline_1'] = $student['student_ad1_discipline'];
            $userInfo['university_1'] = $student['student_ad1_university'];
            $userInfo['month_1'] = $student['student_ad1_passing'];
            $userInfo['percentage_1'] = $student['student_ad1_percentage'];
            $userInfo['cgpa_1'] = $student['student_ad1_cgpa'];
            
            $userInfo['degree_2'] = $student['student_ad2_degree'];
            $userInfo['discipline_2'] = $student['student_ad2_discipline'];
            $userInfo['university_2'] = $student['student_ad2_university'];
            $userInfo['month_2'] = $student['student_ad2_passing'];
            $userInfo['percentage_2'] = $student['student_ad2_percentage'];
            $userInfo['cgpa_2'] = $student['student_ad2_cgpa'];
            
            $this->db->where('student_id', $userInfo['sid']);
            $studentmedia = $this->db->get('pms_student_media')->row_array(); 

            $userInfo['profile'] = $studentmedia['student_profile_pic'];
            $userInfo['profile_thumb'] = $studentmedia['student_profile_pic_thumb'];
            $userInfo['cover'] = $studentmedia['student_cover_pic'];
            $userInfo['m_sheet_10'] = $studentmedia['student_10th_marksheet'];
            $userInfo['m_sheet_12'] = $studentmedia['student_12th_marksheet'];
            $userInfo['m_sheet_h'] = $studentmedia['student_high_marksheet'];
            $userInfo['m_sheet_ad1'] = $studentmedia['student_ad1_marksheet'];
            $userInfo['m_sheet_ad2'] = $studentmedia['student_ad2_marksheet'];

        }

        return $userInfo;

    }

}
