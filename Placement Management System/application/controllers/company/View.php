<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {

	public function __construct() {

		// Session expire OR try to Login from the URL (Preventing)
		parent::__construct();

		// Session expire OR try to Login from the URL (Preventing)
		$company = $this->session->userdata( 'company' );
		// $companyId = $this->session->userdata['company']['user_id'];

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
		
		$this->db->where('company_id', $userInfo['cid']);
		$requirements = $this->db->get('pms_company_requirements')->result_array();
		
		$i = 0;
		if ( !empty($requirements) ) { 
			foreach ($requirements as $requirement) { 
				$this->db->where('company_id', $requirement['company_id']);
				$pic = $this->db->get('pms_company_media')->row_array();

				$requirements[$i++]['company_requirement_pic'] = $pic['company_profile_pic'] ;
			}
		}
		
		$this->load->model('Notification_fetch_model');
		$quickNotifications = $this->Notification_fetch_model->get_quick_com_Notifications();
		
		$data['userInfo'] = $userInfo;
		$data['requirements'] = $requirements;
		$data['quickNotifications'] = $quickNotifications;

		$this->load->view('company/view', $data);
	}

	public function requirementUpdate($id) {

		$this->load->library('form_validation');
		$this->load->model('Requirement_update_model');
		
        date_default_timezone_set('Asia/Kolkata');
		
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
			
			// Store the requirement in array
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
			$requirementArray['rid'] = $id;

			$this->db->where('company_requirement_id', $id);
			$studReqIds = $this->db->get('pms_student_applied_req')->result_array();

			$this->db->where('company_requirement_id', $id);
			$requirementInfo = $this->db->get('pms_company_requirements')->row_array();
			
			// Store Data In Database
			if ( !empty($requirementArray) ) {

				// company array is not empty - success !
				$this->Requirement_update_model->requirementUpdate($requirementArray);

				if ( !empty($studReqIds) ) {
					$i = 0;
					foreach ($studReqIds as $studReqId) {

						$notiArray['student_id'] = $studReqIds[$i]['student_id'];
						$notiArray['student_notification_class'] = "far fa-edit text-danger";
						$notiArray['student_notification_detail'] = "Requirement Changed for <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
						$notiArray['student_notification_created_at'] = date('Y/m/d H:i:s', time());
						
						$this->db->insert( 'pms_student_notification', $notiArray );

						$i++;

					}
				}

				$notiCArray['company_id'] = $requirementInfo['company_id'];
				$notiCArray['company_notification_class'] = "far fa-edit text-danger";
				$notiCArray['company_notification_detail'] = "Requirement Changed for <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
					$notiCArray['company_notification_created_at'] = date('Y/m/d H:i:s', time());
				$this->db->insert( 'pms_company_notification', $notiCArray );

				$this->session->set_flashdata('updateRSMsg','Requirement has been updated successfully.');
				redirect( base_url().'company/View/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('updateRFMsg','Please insert all required fields to update an Requirement.');
				redirect(base_url().'company/View/index');

			}

		} else {
			
			// Failure !
			$this->session->set_flashdata('updateRFMsg','Please insert all the required fields with proper values to update an Requirement.');
			redirect(base_url().'company/View/index');

		}
		
	}

	public function requirementExamUpdate($id) {

		$this->load->library('form_validation');
		$this->load->model('Requirement_update_model');
		
        date_default_timezone_set('Asia/Kolkata');

		$this->form_validation->set_rules('date_exam', 'Exam date', 'trim|required');
		$this->form_validation->set_rules('date_exam_end', 'Exam Date End', 'trim|required');

		if ( $this->form_validation->run() == TRUE) {
			
			// Store the requirement in array
			$requirementArray['company_requirement_exam_date'] = $this->input->post('date_exam');
			$requirementArray['company_requirement_exam_date_end'] = $this->input->post('date_exam_end');
			$requirementArray['rid'] = $id;
			
			$this->db->where('company_requirement_id', $id);
			$studReqIds = $this->db->get('pms_student_applied_req')->result_array();

			$this->db->where('company_requirement_id', $id);
			$requirementInfo = $this->db->get('pms_company_requirements')->row_array();
			
			// Store Data In Database
			if ( !empty($requirementArray) ) {

				// company array is not empty - success !
				$this->Requirement_update_model->requirementExamUpdate($requirementArray);
				
				if ( !empty($studReqIds) ) {
					$i = 0;
					foreach ($studReqIds as $studReqId) {

						$notiArray['student_id'] = $studReqIds[$i]['student_id'];
						$notiArray['student_notification_class'] = "fas fa-calendar-day text-danger";
						$notiArray['student_notification_created_at'] = date('Y/m/d H:i:s', time());
						$notiArray['student_notification_detail'] = "Exam Dates Changed for <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
						$this->db->insert( 'pms_student_notification', $notiArray );

						$i++;

					}
				}

				$notiCArray['company_id'] = $requirementInfo['company_id'];
				$notiCArray['company_notification_class'] = "fas fa-calendar-day text-danger";
				$notiCArray['company_notification_created_at'] = date('Y/m/d H:i:s', time());
				$notiCArray['company_notification_detail'] = "Exam Dates Changed for <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
				$this->db->insert( 'pms_company_notification', $notiCArray );
				
				$this->session->set_flashdata('updateRSMsg','Requirement has been updated successfully.');
				redirect( base_url().'company/Exams/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('updateRFMsg','Please insert all required fields to update an Requirement.');
				redirect(base_url().'company/Exams/index');

			}

		} else {
			
			// Failure !
			$this->session->set_flashdata('updateRFMsg','Please insert all the required fields with proper values to update an Requirement.');
			redirect(base_url().'company/Exams/index');

		}
		
	}

	public function requirementInterviewUpdate($id) {

		$this->load->library('form_validation');
		$this->load->model('Requirement_update_model');
		
        date_default_timezone_set('Asia/Kolkata');

		$this->form_validation->set_rules('date_interview', 'Interview date', 'trim|required');
		$this->form_validation->set_rules('date_interview_end', 'Interview Date End', 'trim|required');

		if ( $this->form_validation->run() == TRUE) {
			
			// Store the requirement in array
			$requirementArray['company_requirement_interview_date'] = $this->input->post('date_interview');
			$requirementArray['company_requirement_interview_date_end'] = $this->input->post('date_interview_end');
			$requirementArray['rid'] = $id;
			
			$this->db->where('company_requirement_id', $id);
			$studReqIds = $this->db->get('pms_student_applied_req')->result_array();

			$this->db->where('company_requirement_id', $id);
			$requirementInfo = $this->db->get('pms_company_requirements')->row_array();
				
			// Store Data In Database
			if ( !empty($requirementArray) ) {

				// company array is not empty - success !
				$this->Requirement_update_model->requirementInterviewUpdate($requirementArray);
				
				if ( !empty($studReqIds) ) {
					$i = 0;
					foreach ($studReqIds as $studReqId) {

						$notiArray['student_id'] = $studReqIds[$i]['student_id'];
						$notiArray['student_notification_class'] = "fas fa-calendar-day text-danger";
						$notiArray['student_notification_created_at'] = date('Y/m/d H:i:s', time());
						$notiArray['student_notification_detail'] = "Interview Dates Changed for <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
						$this->db->insert( 'pms_student_notification', $notiArray );

						$i++;

					}
				}

				$notiCArray['company_id'] = $requirementInfo['company_id'];
				$notiCArray['company_notification_class'] = "fas fa-calendar-day text-danger";
				$notiCArray['company_notification_created_at'] = date('Y/m/d H:i:s', time());
				$notiCArray['company_notification_detail'] = "Interview Dates Changed for <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
				$this->db->insert( 'pms_company_notification', $notiCArray );

				$this->session->set_flashdata('updateRSMsg','Requirement has been updated successfully.');
				redirect( base_url().'company/Interviews/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('updateRFMsg','Please insert all required fields to update an Requirement.');
				redirect(base_url().'company/Interviews/index');

			}

		} else {
			
			// Failure !
			$this->session->set_flashdata('updateRFMsg','Please insert all the required fields with proper values to update an Requirement.');
			redirect(base_url().'company/Interviews/index');

		}
		
	}

	public function activation( $comReqId ) {

		$this->db->where('company_requirement_id', $comReqId );
		$req = $this->db->get('pms_company_requirements')->row_array();
		
		if ( $req['company_requirement_status'] == 1) {
			
			$update = array(
				'company_requirement_status' => 0
			);

		} else {

			$update = array(
				'company_requirement_status' => 1
			);

		}

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->update('pms_company_requirements', $update );

		redirect(base_url().'company/View/index');

	}

	public function studentApplied( $comReqId, $comId ) {
		
		$this->db->where('company_id', $comId );
		$this->db->where('company_requirement_id', $comReqId );
		$studentApplieds = $this->db->get('pms_student_applied_req')->result_array();
		
		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$totalStud = $this->db->count_all_results('pms_student_applied_req');
		
		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$this->db->where('student_applied_req_status', 1 );
		$totalApplied = $this->db->count_all_results('pms_student_applied_req');
		
		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$this->db->where('student_applied_req_status', 0 );
		$totalRevoked = $this->db->count_all_results('pms_student_applied_req');
		
		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$this->db->where('company_requirement_exam_status', 0 );
		$this->db->where('company_requirement_interview_status', 0 );
		$totalBanned = $this->db->count_all_results('pms_student_applied_req');

		$totalStudentApplied = array();

		$i = 0;
		foreach ( $studentApplieds as $studentApplied ) {
			
			$this->db->where('student_id', $studentApplied['student_id'] );
			$totalStudentApplied[$i] = $this->db->get('pms_student_info')->row_array();
			
			
            $this->db->where('student_id', $studentApplied['student_id'] );
			$this->db->where('company_requirement_id', $comReqId);
			$this->db->where('company_id', $comId);
			$studentAppliedInfo = $this->db->get('pms_student_applied_req')->row_array();

			$totalStudentApplied[$i]['student_high_percentage'] = $studentAppliedInfo['student_percentage'];
			$totalStudentApplied[$i]['student_high_cgpa'] = $studentAppliedInfo['student_cgpa'];
			$totalStudentApplied[$i]['student_percentage_12th'] = $studentAppliedInfo['student_percentage_12'];

			$this->db->where('student_id', $studentApplied['student_id'] );
			array_push( $totalStudentApplied[$i], $this->db->get('pms_student_media')->row_array() );

			$i++;
		}
		
		$this->db->where('company_requirement_id', $comReqId );
		$requirement = $this->db->get('pms_company_requirements')->result_array();

		$data['totalStudentApplied'] = $totalStudentApplied;
		$data['studentApplieds'] = $studentApplieds;
		$data['requirement'] = $requirement;
		$data['totalStud'] = $totalStud;
		$data['totalApplied'] = $totalApplied - $totalBanned;
		$data['totalRevoked'] = $totalRevoked;
		$data['totalBanned'] = $totalBanned;

		
		$this->load->view('company/viewStudentApplied', $data);

	}

	public function cancelExam( $comReqId, $comId ) {

        $this->load->library('form_validation');
        
        date_default_timezone_set('Asia/Kolkata');

		$this->db->where('company_id', $comId);
		$this->db->where('company_requirement_id', $comReqId);
		$allStudents = $this->db->get('pms_student_applied_req')->result_array();
		
		$this->db->where('company_requirement_id', $comReqId);
		$requirementInfo = $this->db->get('pms_company_requirements')->row_array();
		
		$this->db->where('company_id', $comId);
		$comInfo = $this->db->get('pms_company_info')->row_array();

		if( !empty($allStudents) ) {
			foreach ($allStudents as $student) {

				$result = $this->input->post($student['student_applied_req_id'],TRUE)==null ? 1 : 0;

				if ( $student['company_requirement_exam_status'] != $result ) {

					$update = array(
						'company_requirement_exam_status' => $result,
						'company_requirement_interview_status' => $result
					);

					$this->db->where('student_id', $student['student_id'] );
					$this->db->where('company_requirement_id', $comReqId);
					$this->db->where('company_id', $comId);
					$this->db->update('pms_student_applied_req', $update);
					
					if ( $result == 0 ) {
						
						$notiEArray['student_id'] = $student['student_id'];
						$notiEArray['student_notification_class'] = "fas fa-thumbtack text-danger";
						$notiEArray['student_notification_created_at'] = date('Y/m/d H:i:s', time());
						$notiEArray['student_notification_detail'] = "You are banned from <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']." </i>\nSend Your Resume to ".$comInfo['company_email']." before interview starts.";
						$this->db->insert( 'pms_student_notification', $notiEArray );

					} else if ( $result == 1 ) {
						
						$notiEArray['student_id'] = $student['student_id'];
						$notiEArray['student_notification_class'] = "fas fa-thumbtack text-info";
						$notiEArray['student_notification_created_at'] = date('Y/m/d H:i:s', time());
						$notiEArray['student_notification_detail'] = "You are unbanned from <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']." </i>\nSend Your Resume to ".$comInfo['company_email']." before interview starts.";
						$this->db->insert( 'pms_student_notification', $notiEArray );

					}

				}

				
			}
		}
		
		redirect( base_url().'company/View/studentApplied/'.$comReqId.'/'.$comId );

	}
}
