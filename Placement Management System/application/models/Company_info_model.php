<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_info_model extends CI_Model {

    public function check_email($email) {

        $this->db->where('email', $email);
        return $this->db->get('users')->row('email');

    }

	public function store_company_data($companyArray) {
        
        date_default_timezone_set('Asia/Kolkata');
        $companyArray['company_created_at'] = date('Y/m/d H:i:s', time());
                
        // Insert in pms_company_info Table
        $this->db->insert('pms_company_info', $companyArray);

		$this->db->where('company_email', $companyArray['company_email']);
        $company = $this->db->get('pms_company_info')->row_array();

        $user['company_id'] = $company['company_id'];
        $user['user_email'] = $company['company_email'];
        $user['user_password'] = $company['company_password'];
        $user['user_role'] = "company";
        $user['user_created_at'] = $company['company_created_at'];

        $userMedia['company_id'] = $user['company_id'];
        $userMedia['company_profile_pic'] = './uploads/system/profile/other.png';
        $userMedia['company_profile_pic_thumb'] = './uploads/system/profile/other_thumb.png';
        $userMedia['company_cover_pic'] = './uploads/system/cover.jfif';

        // Insert in pms_users Table
        $this->db->insert('pms_users', $user);
        $this->db->insert('pms_company_media', $userMedia);

	}
}
