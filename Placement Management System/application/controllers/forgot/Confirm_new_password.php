<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confirm_new_password extends CI_Controller {

	public function index( $id )	{
        
		$this->load->library('form_validation');
		
		if ( empty($this->session->userdata( 'forgot' )) or ($this->session->userdata['forgot']['id'] != $id) ) {
		    
    		$this->session->set_flashdata('msg', 'Forgot Password session Expired');
    		redirect( base_url().'login/login/index' );
	        
		}
		
        		$data['id'] = $id;
        		$this->load->view('forgot/confirm_new_password', $data);
		
	}
	
	public function pass_confirm( $id ) {
	    
		if ( empty($this->session->userdata( 'forgot' )) or ($this->session->userdata['forgot']['id'] != $id) ) {
		    
    		$this->session->set_flashdata('msg', 'Forgot Password session Expired');
    		redirect( base_url().'login/login/index' );
	        
		} 
		
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Kolkata');

		$this->form_validation->set_rules('newPass', 'New Password', 'trim|required');
		$this->form_validation->set_rules('conPass', 'Confirm Password', 'trim|required|matches[newPass]');
		$this->form_validation->set_message('matches', '<p class="text-danger">Password and Confirm Password Doesn\'t Matches.</p>');

		if ( $this->form_validation->run() == TRUE) {

			// Success - Not Empty !
			$userArray = $this->input->post('newPass');

			if ( !empty($userArray) ) {

				$pass = $this->input->post('newPass');
				$cpass = $this->input->post('conPass');

				if ( $pass === $cpass ) {
					
					// Password Matches - success !
					$this->db->where('user_id', $id);
					$user = $this->db->get('pms_users')->row_array();

					$this->load->model('Change_password_model');
					$this->Change_password_model->changePassword( $user['user_email'], $pass );

					$emailArray['to'] = $user['user_email'];
					$emailArray['subject'] = "Change Password";
					$emailArray['from'] = "<-no-reply->@gmail.com";
					$emailArray['msg'] = "<!DOCTYPE><html><head></head><body>Password has been changed for ". $user['user_email']."</body></html>";

					$this->load->model('Email_model');
					$this->Email_model->sendEmail($emailArray);

					if ( $user['user_role'] == 'student' ) {
						$notiArray['student_id'] = $user['student_id'];
						$notiArray['student_notification_class'] = "fab fa-expeditedssl text-warning";
						$notiArray['student_notification_detail'] = "You Changed Account Password by forgetting.";
						$notiArray['student_notification_created_at'] =  date('Y/m/d H:i:s', time());
						$this->db->insert( 'pms_student_notification', $notiArray );
					}
					if ( $user['user_role'] == 'company' ) {
						$notiArray['company_id'] = $user['company_id'];
						$notiArray['company_notification_class'] = "fab fa-expeditedssl text-warning";
						$notiArray['company_notification_detail'] = "You Changed Account Password by forgetting.";
						$notiArray['company_notification_created_at'] =  date('Y/m/d H:i:s', time());
						$this->db->insert( 'pms_company_notification', $notiArray );
					}

					$this->session->set_flashdata('signuplogMsg', 'Password has been changed Succesfully.');
					$this->load->view( 'login/login' );


				} else {
					// Password Matches - success !
					
					$this->session->set_flashdata('msgsF', 'Passwords are not the same.');
					redirect( base_url().'forgot/confirm_new_password/pass_confirm/'.$id );
				}

			} else {

				
				$this->session->set_flashdata('msgsF', 'Please Enter Password.');
				redirect( base_url().'forgot/confirm_new_password/pass_confirm/'.$id );
			}

		} else {

			// Failure - Empty Email & Password
			$data['id'] = $id;
			$this->load->view('forgot/confirm_new_password', $data);

		}

	}

}
