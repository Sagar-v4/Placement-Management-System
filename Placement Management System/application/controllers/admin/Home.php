<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// Session expire OR try to Login from the URL (Preventing)
		$admin = $this->session->userdata( 'admin' );

		if ( empty($admin) ) {
			$this->session->set_flashdata('msg', 'Your Session has been expired. Please try again.');
			redirect(base_url().'login/login/index');
		}

		// Acount Active / Deactive
		$this->load->model('Check_status_model');
		$adminStatus = $this->Check_status_model->checkStatus( $this->session->userdata['admin']['email'] );

		if ( $adminStatus != 1 ) {

			// Destroy session
			$this->session->set_flashdata('msg', 'Your account has been deactivated. Please contact administrator.');
			$this->session->unset_userdata( 'admin' );
			redirect(base_url().'login/login/index');
		}

	}

	public function index()	{
        
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['admin']['email'] );

		$requirements = $this->db->get('pms_company_requirements')->result_array();

		$i = 0;
		if ( !empty($requirements) ) { 
			foreach ($requirements as $requirement) { 
				$this->db->where('company_id', $requirement['company_id']);
				$pic = $this->db->get('pms_company_media')->row_array();
			}
		}

		$data['userInfo'] = $userInfo;
		$data['requirements'] = $requirements;

		$this->load->view('admin/dashboard', $data);
	}



	public function updateRequirement( $comReqId ) {

		$update = array(

			'company_requirement_name' => $this->input->post('requirement_name'),
			'company_requirement_post' => $this->input->post('post'),
			'company_requirement_description' => $this->input->post('description'),
			'company_requirement_min_percentage' => $this->input->post('percentage'),
			'company_requirement_min_cgpa' => $this->input->post('cgpa'),
			'company_requirement_min_percentage_12th' => $this->input->post('percentage_12'),
			'company_requirement_min_salary' => $this->input->post('salary'),
			'company_requirement_vacancy' => $this->input->post('vacancy'),
			'company_requirement_last_date' => $this->input->post('date_last'),
			'company_requirement_exam_date' => $this->input->post('date_exam'),
			'company_requirement_exam_date_end' => $this->input->post('date_exam_end'),
			'company_requirement_interview_date' => $this->input->post('date_interview'),
			'company_requirement_interview_date_end' => $this->input->post('date_interview_end')

		);

		$this->db->where('company_requirement_id', $comReqId );
		if ( $this->db->update('pms_company_requirements', $update ) ) {
			$this->session->set_flashdata('updateRSMsg','Requirement has been updated successfully.');
		} else {
			$this->session->set_flashdata('updateRFMsg','Requirement Updation Failed.');
		}

		redirect( base_url().'admin/home/index' );

	}

	public function updateRequirementStatus( $comReqId, $status ) {

		$this->db->where('company_requirement_id', $comReqId );
		$requirement = $this->db->get('pms_company_requirements')->row_array();

		if ( $requirement[$status] == 1 ) {
			$update = array( $status => 0);
		} else {
			$update = array( $status => 1);
		}

		$this->db->where('company_requirement_id', $comReqId );
		if ( $this->db->update('pms_company_requirements', $update ) ) {
			$this->session->set_flashdata('updateRSMsg','Requirement Status has been updated successfully.');
		} else {
			$this->session->set_flashdata('updateRFMsg','Requirement Status Updation Failed.');
		}

		redirect( base_url().'admin/home/index' );

	}
}

?>
