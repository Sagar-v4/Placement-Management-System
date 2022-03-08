<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_requirement extends CI_Controller {

	public function __construct() {

		// Session expire OR try to Login from the URL (Preventing)
		parent::__construct();

		// Session expire OR try to Login from the URL (Preventing)
		$company = $this->session->userdata( 'company' );

		if ( empty($company) ) {
			$this->session->set_flashdata('msg', 'Your Session has been expired. Please try again.');
			redirect(base_url().'login/login/index');
		}

		// Acount Active / Deactive
		$this->load->model('Check_status_model');
		$companyStatus = $this->Check_status_model->checkStatus( $this->session->userdata['company']['email'] );

		if ( $companyStatus != 1 ) {

			// Destroy session
			$this->session->set_flashdata('msg', 'Your account has been deactivated. Please contact administrator.');
			$this->session->unset_userdata( 'company' );
			redirect(base_url().'login/login/index');
		}
	}

	public function index()	{
        
		$this->load->library('form_validation');
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['company']['email'] );

		$this->load->model('Notification_fetch_model');
		$quickNotifications = $this->Notification_fetch_model->get_quick_com_Notifications();
		
		$data['userInfo'] = $userInfo;
		$data['quickNotifications'] = $quickNotifications;

		$this->load->view('company/new_requirement', $data);
	}

	public function new_requirement() {

		// Load Libraries & Models
		$this->load->library('form_validation');
		$this->load->model('Requirement_model');
		
        date_default_timezone_set('Asia/Kolkata');

		// Validation
		$this->form_validation->set_rules('name', 'Name', 'trim');
		$this->form_validation->set_rules('requirement_name', 'Requirement name', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('post', 'Post', 'trim|required');
		$this->form_validation->set_rules('percentage', 'Percentage', 'trim|required|greater_than[32.99]|less_than[100.01]');
		$this->form_validation->set_rules('cgpa', 'Cgpa', 'trim|required|greater_than[2.9]|less_than[10.01]');
		$this->form_validation->set_rules('percentage_12', 'Percentage 12th', 'trim|required|greater_than[32.99]|less_than[100.01]');
		$this->form_validation->set_rules('salary', 'Salary', 'trim|required');
		$this->form_validation->set_rules('vacancy', 'Vacancy', 'trim|required');
		$this->form_validation->set_rules('date_last', 'Last Date', 'trim|required');
		$this->form_validation->set_rules('date_exam', 'Exam date', 'trim|required');
		$this->form_validation->set_rules('date_exam_end', 'Exam End', 'trim|required');
		$this->form_validation->set_rules('date_interview', 'interview date', 'trim|required');
		$this->form_validation->set_rules('date_interview_end', 'interview End', 'trim|required');

		if ( $this->form_validation->run() == TRUE) {

			$requirementArray = array();

			// Store the requirement in array
			$requirementArray['company_name'] = $this->input->post('name');
			$requirementArray['company_requirement_name'] = $this->input->post('requirement_name');
			$requirementArray['company_requirement_description'] = $this->input->post('description');
			$requirementArray['company_requirement_post'] = $this->input->post('post');
			$requirementArray['company_requirement_min_percentage'] = $this->input->post('percentage');
			$requirementArray['company_requirement_min_cgpa'] = $this->input->post('cgpa');
			$requirementArray['company_requirement_min_percentage_12th'] = $this->input->post('percentage_12');
			$requirementArray['company_requirement_min_salary'] = $this->input->post('salary');
			$requirementArray['company_requirement_vacancy'] = $this->input->post('vacancy');
			$requirementArray['company_requirement_last_date'] = $this->input->post('date_last');
			$requirementArray['company_requirement_exam_date'] = $this->input->post('date_exam');
			$requirementArray['company_requirement_exam_date_end'] = $this->input->post('date_exam_end');
			$requirementArray['company_requirement_interview_date'] = $this->input->post('date_interview');
			$requirementArray['company_requirement_interview_date_end'] = $this->input->post('date_interview_end');
            $requirementArray['company_requirement_created_at'] = date('Y/m/d H:i:s', time());

			if ( ! empty($requirementArray) ) {

				$this->Requirement_model->store_new_requirement($requirementArray);
				$this->session->set_flashdata('newReqSMsg','New Requirement has been created successfully.');
				redirect( base_url().'company/new_requirement' );

			} else {

				$this->session->set_flashdata('newReqFMsg','Fill All Requirements to Create a new requirement.');
				$this->load->view('company/new_requirement');

			}

		} else {

			// Failure !
			$this->index();

		}
	}
}
