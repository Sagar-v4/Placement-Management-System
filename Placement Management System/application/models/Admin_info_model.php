<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_info_model extends CI_Model {

        public function check_email($email) {

                $this->db->where('email', $email);
                return $this->db->get('users')->row('email');

        }

	public function store_admin_data($adminArray) {
        
        date_default_timezone_set('Asia/Kolkata');
        $adminArray['admin_created_at'] = date('Y/m/d H:i:s', time());
                
        // Insert in pms_admin_info Table
        $this->db->insert('pms_admin_info', $adminArray);

	    $this->db->where('admin_email', $adminArray['admin_email']);
        $admin =  $this->db->get('pms_admin_info')->row_array();

        $user['admin_id'] = $admin['admin_id'];
        $user['user_email'] = $admin['admin_email'];
        $user['user_password'] = $admin['admin_password'];
        $user['user_role'] = "admin";
        $user['user_created_at'] = $admin['admin_created_at'];

        $userMedia['admin_id'] = $user['admin_id'];
        if ( $admin['admin_gender'] == "male") {

                $userMedia['admin_profile_pic'] = './uploads/system/profile/male.png';
                $userMedia['admin_profile_pic_thumb'] = './uploads/system/profile/male_thumb.png';

        } elseif ( $admin['admin_gender'] == "female") {

                $userMedia['admin_profile_pic'] = './uploads/system/profile/female.png';
                $userMedia['admin_profile_pic_thumb'] = './uploads/system/profile/female_thumb.png';

        } elseif ( $admin['admin_gender'] == "other" ) {

                $userMedia['admin_profile_pic'] = './uploads/system/profile/other.png';
                $userMedia['admin_profile_pic_thumb'] = './uploads/system/profile/other_thumb.png';

        }
        $userMedia['admin_cover_pic'] = './uploads/system/cover.jfif';

        // Insert in pms_users & pms_admin_media Table
        $this->db->insert('pms_users', $user);
        $this->db->insert('pms_admin_media', $userMedia);

	}
}
