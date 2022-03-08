<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password_model extends CI_Model {

	public function changePassword( $email, $password )	{
	    
	    
		date_default_timezone_set('Asia/Kolkata');
					
        $newPassword = password_hash( $password, PASSWORD_DEFAULT);
        $update = array(
            'user_password' => $newPassword
        );

        $this->db->where('user_email', $email);
        $this->db->update('pms_users', $update);
        
        $this->db->where('user_email', $email);
        $user = $this->db->get('pms_users')->row_array();

        if ( $user['user_role'] == 'admin' ) {

            $update = array(
                'admin_password' => $newPassword
            );

            $this->db->where('admin_email', $email);
            $this->db->update('pms_admin_info', $update);

            return true;

        } 
        
        if ( $user['user_role'] == 'company' ) {

            $update = array(
                'company_password' => $newPassword
            );

            $this->db->where('company_email', $email);
            $this->db->update('pms_company_info', $update);
            
            return true;

        }
        
        if ( $user['user_role'] == 'student' ) {

            $update = array(
                'student_password' => $newPassword
            );

            $this->db->where('student_email', $email);
            $this->db->update('pms_student_info', $update);

            return true;

        }

        return false;

	}

}
