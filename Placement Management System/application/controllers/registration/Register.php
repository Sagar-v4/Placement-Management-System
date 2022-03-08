<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()	{
        
		$this->load->view('registration/register');
		
	}
	
	public function authenticate() {
		
		// Load Libraries & Models
		$this->load->library('form_validation');
		$this->load->model('Student_info_model');

		// Personal Details
		$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
		$this->form_validation->set_rules('middle_name', 'Middle name', 'trim');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('dob', 'Dob', 'trim|required');

		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('std', 'Std', 'trim');
		$this->form_validation->set_rules('telephone', 'Telephone', 'trim');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[pms_users.user_email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

		$this->form_validation->set_message('is_unique', '<p class="text-danger">This email address is already taken. Please choose another.</p>');
		$this->form_validation->set_message('matches', '<p class="text-danger">Password and Confirm Password Doesn\'t Matches.</p>');

		if ( $this->form_validation->run() == TRUE) {
			
			// Success !
			$studentArray = array();

			// Personal Details
			$studentArray['student_first_name'] = $this->input->post('first_name');
			$studentArray['student_middle_name'] = $this->input->post('middle_name');
			$studentArray['student_last_name'] = $this->input->post('last_name');
			$studentArray['student_gender'] = $this->input->post('gender');
			$studentArray['student_dob'] = $this->input->post('dob');

			// Contact information
			$studentArray['student_phone_number'] = $this->input->post('phone');
			$studentArray['student_std_code'] = (empty($this->input->post('std'))) ? NULL : $this->input->post('std') ;
			$studentArray['student_telephone_number'] = (empty($this->input->post('telephone'))) ? NULL : $this->input->post('telephone') ;
			$studentArray['student_email'] = $this->input->post('email');
			$studentArray['student_password'] = password_hash( $this->input->post('password'), PASSWORD_DEFAULT);

			// Store Data In Database
			if ( !empty($studentArray) ) {

				// student array is not empty - success !
				$pass = $this->input->post('password');
				$cpass = $this->input->post('cpassword');

				if ( $pass === $cpass ) {

					// Password Matches - success !
					$this->Student_info_model->store_student_data($studentArray);

					$emailArray['to'] = $this->input->post('email');
					$emailArray['subject'] = "Welcome";
					$emailArray['from'] = "pms.bussiness@gmail.com";
					$emailArray['msg'] = "Hello,".$studentArray['student_first_name']." Thanks for Sign Up !!!";
					
					$this->load->model('Email_model');
					$this->Email_model->sendEmail($emailArray);

					$this->session->set_flashdata('signuplogMsg','Your account has been created successfully. Now, you can Sign in');
					redirect( base_url().'login/login' );

				} else {
					
					// Passwords Doesn't Matches - Failure !
					$this->session->set_flashdata('signupMsg','Password and Confirm Password does not match.');
					$this->load->view('registration/register');

				}
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('signupMsg','Please insert data to create an accout.');
				$this->load->view('registration/register');

			}
		} else {

			// Failure !
			$this->session->set_flashdata('signupMsg','Please insert all the required fields with proper values to create an accout.');
			$this->load->view('registration/register');
		}

	}

}
