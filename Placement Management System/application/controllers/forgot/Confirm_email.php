<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confirm_email extends CI_Controller {

	public function index()	{
        
		// echo password_hash('company', PASSWORD_DEFAULT);
		$this->load->library('form_validation');

		$this->load->view('forgot/confirm_email');
		
	}
	
	public function send_otp() {
		
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Kolkata');

		$this->form_validation->set_rules('email', 'Email', 'trim|required');

		if ( $this->form_validation->run() == TRUE) {

			// Success - Not Empty !
			$email = $this->input->post('email');

			if ( !empty($email) ) {

				$this->db->where('user_email', $email);
				$userInfo = $this->db->get('pms_users')->row_array();

				if ( !empty($userInfo) ) {

					// User Found
					do {
						// check OTP duplication
						$token = rand(100000, 999999); 

						$data['user_id'] = $userInfo['user_id'];
						$data['user_email'] = $email;
						$data['token'] = $token;
						$data['created_at'] = date('Y/m/d H:i:s', time());

						$this->db->where('token', $data['token']);
						$this->db->where('token_status', 1);
						$tokenInfo = $this->db->get('pms_forgot_password')->row_array();

					} while ( !empty($tokenInfo) );
					
					$update = array(
						'token_status' => 0
					);
					
					$this->db->where('user_id', $data['user_id']);
					
					$this->db->update('pms_forgot_password', $update);

					$this->db->insert('pms_forgot_password', $data);

					$emailArray['to'] = $userInfo['user_email'];
					$emailArray['subject'] = "Forgot Password";
					$emailArray['from'] = "<-no-reply->@gmail.com";
					$emailArray['msg'] = "<!DOCTYPE><html><head></head><body>10 Minute validated OTP is <h1>".$token."</h1></body></html>";

					$this->load->model('Email_model');

					if ($this->Email_model->sendEmail($emailArray) ) {
						
						$this->session->unset_userdata( 'forgot' );
						$this->session->set_flashdata('msgS', 'OTP is Sended To '.$email.'.');
						redirect( base_url().'forgot/confirm_otp/index/'.$userInfo['user_id'] );

					} else {

						$this->session->set_flashdata('msgF', 'OTP is Sending Problem. Try after some time.');
						redirect( base_url().'forgot/confirm_email/index' );

					}
				
				} else {

					// User Not Found
					$this->session->set_flashdata('msgF', 'This Email is not registered.');
					redirect( base_url().'forgot/confirm_email/index' );
				}

			}

		} else {

			// Failure - Empty Email & Password
			$this->load->view('forgot/confirm_email');

		}

	}

}
