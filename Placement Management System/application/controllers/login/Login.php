<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()	{
        
		if ( $this->session->userdata( 'admin' ) ) {
			redirect( base_url().'admin/home/index' );

		} else if ( $this->session->userdata( 'student' ) ) {
			redirect( base_url().'student/home/index' );

		} else if ( $this->session->userdata( 'company' ) ) {
			redirect( base_url().'company/home/index' );

		} else {
			$this->load->view('login/login');
			
		}
		
	}
	
	public function authenticate() {
		
		$this->load->model('Login_model');

		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ( $this->form_validation->run() == TRUE) {

			// Success - Not Empty !
			$email = $this->input->post('email');
			$user = $this->Login_model->getByUser($email);

			if ( !empty($user) ) {

				// Success - Email Foundered !
				$password = $this->input->post('password');

				if ( password_verify($password, $user['user_password']) === TRUE ) {

					// Success - Password matches !
					
					// Generating Session
					$userArray['user_id'] = $user['user_id'];
					$userArray['email'] = $user['user_email'];
					$userArray['role'] = $user['user_role'];
					$userArray['status'] = $user['user_status'];

					if ( $userArray['status'] == 1) {

						// Set Cookie
						if ( $this->input->post('rememberMe') ) {

							// Day * Seconds * Minutes * Hours
							$setCookieTime = 1 * 60 * 60 * 24;
							set_cookie("email", $this->input->post('email'), $setCookieTime);
							set_cookie("password", $this->input->post('password'), $setCookieTime);
						}

						$emailArray['to'] = $this->input->post('email');
						$emailArray['subject'] = "Alert - Login";
						$emailArray['from'] = "pms.bussiness@gmail.com";
						$emailArray['msg'] = "Login to PMS if its not You then kindly Change your password";

						$this->load->model('Email_model');
						$this->Email_model->sendEmail($emailArray);

						// Success - Session create - Account active !						
						if ( $userArray['role'] == 'admin' ) {						// for admin login
							$this->session->set_userdata( 'admin', $userArray);		// creating admin session
							redirect( base_url().'admin/home/index' );

						} else if ( $userArray['role'] == 'company' ) {				// for company login
							$this->session->set_userdata( 'company', $userArray);	// creating company session
							redirect( base_url().'company/home/index' );

						} else if ( $userArray['role'] == 'student' ) {				// for student login
							$this->session->set_userdata( 'student', $userArray);	// creating student session
							redirect( base_url().'student/home/index' );
						}

					} else {
					
						// Failure - Status deactivated
						$this->session->set_flashdata('msg', 'Your account has been deactivated. Please contact administrator.');
						redirect( base_url().'login/login/index' );
	
					}
					
				} else {
					
					// Failure - Password incorrect
					$this->session->set_flashdata('msg', 'Invalid Email or Password.');
					redirect( base_url().'login/login/index' );

				}
			} else {

				// Failure - Email incorrect
				$this->session->set_flashdata('msg', 'Invalid Email or Password.');
				redirect( base_url().'login/login/index' );

			}
			 
		} else {

			// Failure - Empty Email & Password
			$this->load->view('login/login');

		}

	}

	function logout( $role ) {
		
		// Destroy session
		$this->session->unset_userdata( $role );
		
		redirect( base_url().'login/login/index' );
		
	}
}
