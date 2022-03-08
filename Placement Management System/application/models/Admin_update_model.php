<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_update_model extends CI_Model {

	public function personal($adminArray) {
        
        $update = array(
            'admin_first_name' => $adminArray['first_name'],
            'admin_middle_name' => $adminArray['middle_name'],
            'admin_last_name' => $adminArray['last_name'],
            'admin_gender' => $adminArray['gender'],
            'admin_dob' => $adminArray['dob']

        );

		$this->db->where('admin_email', $this->session->userdata['admin']['email'] );
        $this->db->update('pms_admin_info', $update);

	}

    public function description($adminDescription) {
        
        $update = array(
            'admin_description' => $adminDescription
        );

        $this->db->where('admin_email', $this->session->userdata['admin']['email'] );
        $this->db->update('pms_admin_info', $update);

    }

    public function proUpload($profile, $thumb) {
        
        $update = array(
            'admin_profile_pic' => $profile,
            'admin_profile_pic_thumb' => $thumb
        );

        $this->db->where('admin_email', $this->session->userdata['admin']['email'] );
        $admin = $this->db->get('pms_admin_info')->row_array();

        $this->db->where('admin_id', $admin['admin_id']);
        $this->db->update('pms_admin_media', $update);

    }

    public function covUpload($cover) {
        
        $update = array(
            'admin_cover_pic' => $cover
        );

		$this->db->where('admin_email', $this->session->userdata['admin']['email'] );
        $admin = $this->db->get('pms_admin_info')->row_array();

        $this->db->where('admin_id', $admin['admin_id']);
        $this->db->update('pms_admin_media', $update);

	}

}