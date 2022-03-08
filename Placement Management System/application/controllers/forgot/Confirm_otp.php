<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confirm_otp extends CI_Controller {

	public function index( $id )	{
        
		$this->db->where('user_id', $id);
		$forgotInfo = $this->db->order_by('created_at', 'DESC')->get('pms_forgot_password')->row_array();

		$data['id'] = $id;
		$data['time'] = $forgotInfo['created_at'];
		$data['status'] = $forgotInfo['token_status'];
		$this->load->view('forgot/confirm_otp', $data);
		
	}

	public function otp_resend( $id ) {

		date_default_timezone_set('Asia/Kolkata');
					
		$this->db->select('user_email');
		$this->db->where('user_id', $id);
		$userInfo = $this->db->get('pms_users')->row_array();

		do {
			// check OTP duplication
			$token = rand(100000, 999999); 

			$data['user_id'] = $id;
			$data['user_email'] = $userInfo['user_email'];
			$data['token'] = $token;
			$data['created_at'] =  date('Y/m/d H:i:s', time());

			$this->db->where('token', $data['token']);
			$this->db->where('token_status', 1);
			$tokenInfo = $this->db->get('pms_forgot_password')->row_array();

		} while ( !empty($tokenInfo) );

		$emailArray['to'] = $userInfo['user_email'];
		$emailArray['subject'] = "Forgot Password";
		$emailArray['from'] = "<-no-reply->@gmail.com";
		$emailArray['msg'] = "<!DOCTYPE><html><head></head><body>10 Minute validated OTP is <h1>".$token."</h1></body></html>";

		$this->load->model('Email_model');

		if ( $this->Email_model->sendEmail($emailArray) ) {

			$update = array(
				'token_status' => 0,
				'token_submitted_at' =>  date('Y/m/d H:i:s', time())
			);
			
			$this->db->where('user_id', $id);
			$this->db->update('pms_forgot_password', $update);

			$this->db->insert('pms_forgot_password', $data);

			$this->session->set_flashdata('msgS', 'OTP is Sended To '.$userInfo['user_email'].'.');
			redirect( base_url().'forgot/confirm_otp/index/'.$id );

		} else {

			$this->session->set_flashdata('msgF', 'OTP is Sending Problem. Try after some time.');
			redirect( base_url().'forgot/confirm_email/index' );

		}
		

	}
	
	public function otp_confirm( $id ) {
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('token', 'Token', 'trim|required');

		if ( $this->form_validation->run() == TRUE) {

			// Success - Not Empty !
			$inputToken = $this->input->post('token');

			$this->db->where('user_id', $id);
			$this->db->where('token', $inputToken);
			$this->db->where('token_status', 1);
			$forgotInfo = $this->db->order_by('created_at')->get('pms_forgot_password')->row_array();

			if ( !empty($forgotInfo) ) {

				date_default_timezone_set("Asia/Kolkata");

				$now = date('Y-m-d H:i:s');
				$created = date('Y-m-d H:i:s',strtotime($forgotInfo['created_at']));

				$now = strtotime($now);
				$created = strtotime($created);
				$now = $now - (10 * 60); // minute * seconds = 10 Minutes


				if ( $now <= $created ) {
					// Success - No Time

					if ( $inputToken === $forgotInfo['token'] ) {
						// Success - Token Correct
						$updateToken = array(
							'token_status' => 0,
							'token_submitted_at' => date('Y-m-d H:i:s')
						);

						$this->db->where('forgot_password_id', $forgotInfo['forgot_password_id'] );
						$this->db->update('pms_forgot_password', $updateToken);

						$this->db->where('user_id', $id);
						$this->db->update('pms_forgot_password', array('token_status' => 0));
						
						// create Temporary session
						$fId['id'] = $forgotInfo['user_id'];
						$this->session->set_tempdata( 'forgot', $fId , 2*60); // expires in 2 min
						
						redirect( base_url().'forgot/Confirm_new_password/index/'.$id );
						
					} else {
						// Failure - Token Invalid
												
						$this->session->set_flashdata('msgF', 'Invalid OTP.');
						redirect( base_url().'forgot/confirm_otp/index/'.$id );
					}
					
				} else {
					// Failure - Out of Time
					
					$updateToken = array(
						'token_status' => 0,
						'token_submitted_at' =>  date('Y/m/d H:i:s', time())
					);

					$this->db->where('forgot_password_id', $forgotInfo['forgot_password_id'] );
					$this->db->update('pms_forgot_password', $updateToken);
					
					$this->session->set_flashdata('msgF', 'OTP Time Expired.');
					redirect( base_url().'forgot/confirm_otp/index/'.$id );

				}
				
			} else {
				// Failure - Out of Time
				
				$this->session->set_flashdata('msgF', 'Invalid OTP.');
				redirect( base_url().'forgot/confirm_otp/index/'.$id );

			}

		} else {

			// Failure - Empty Email & Password
			$this->db->where('user_id', $id);
			$forgotInfo = $this->db->order_by('created_at', 'DESC')->get('pms_forgot_password')->row_array();

			$data['id'] = $id;
			$data['time'] = $forgotInfo['created_at'];
			$data['status'] = $forgotInfo['token_status'];
			$this->load->view('forgot/confirm_otp', $data);

		}

	}

}
