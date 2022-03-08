<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// Session expire OR try to Login from the URL (Preventing)
		$student = $this->session->userdata( 'student' );

		if ( empty($student) ) {
			$this->session->set_flashdata('msg', 'Your Session has been expired. Please try again.');
			redirect(base_url().'login/login/index');
		}

		// Acount Active / Deactive
		$this->load->model('Check_status_model');
		$studentStatus = $this->Check_status_model->checkStatus( $this->session->userdata['student']['email'] );

		if ( $studentStatus != 1 ) {

			// Destroy session
			$this->session->set_flashdata('msg', 'Your account has been deactivated. Please contact administrator.');
			$this->session->unset_userdata( 'student' );
			redirect(base_url().'login/login/index');
		}
	}

	public function index()	{
        
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['student']['email'] );

		$this->db->where('company_requirement_status', 1);
		$requirements = $this->db->get('pms_company_requirements')->result_array();
		
		$i = 0;
		if ( !empty($requirements) ) { 
			foreach ($requirements as $requirement) { 
				$this->db->where('company_id', $requirement['company_id']);
				$pic = $this->db->get('pms_company_media')->row_array();

				$requirements[$i++]['company_requirement_pic'] = $pic['company_profile_pic'] ;
			}
		}

		$this->db->where('student_id', $userInfo['sid'] );
		$reqStatuses = $this->db->get('pms_student_applied_req')->result_array();

		$j = 0;
		if ( !empty($requirements) ) { 

			foreach ($requirements as $requirement) { 

				$requirements[$j]['status'] = NULL;

				foreach($reqStatuses as $status) {

					if ( $requirement['company_requirement_id'] == $status['company_requirement_id'] ) {
						
						if ( $status['student_applied_req_status'] == 1 ) {

							$requirements[$j]['status'] = 1;

						} else {

							$requirements[$j]['status'] = 0;

						}
					}
				}
				$j++;
			}
		}
		
		$this->load->model('Notification_fetch_model');
		$quickNotifications = $this->Notification_fetch_model->get_quick_Notifications();
		
		$data['userInfo'] = $userInfo;
		$data['requirements'] = $requirements;
		$data['quickNotifications'] = $quickNotifications;
		
		if ( empty($userInfo['r12']) || ( empty($userInfo['percentage_h']) && empty($userInfo['cgpa_h']) ) ) {
		    
		    $this->session->set_flashdata('ProMsg','Please update PERCENTAGES and HIGHEST ACADEMIC QUALIFYING DEGREE to Apply in Requirements in profile.');
		    
		}

		$this->load->view('student/dashboard', $data);

	}

	public function apply( $comId, $comReqId, $studId ) {

		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['student']['email'] );
		date_default_timezone_set('Asia/Kolkata');

		$applyArray['company_id'] = $comId;
		$applyArray['company_requirement_id'] = $comReqId;
		$applyArray['student_id'] = $studId;
		$applyArray['student_percentage'] = $userInfo['percentage_h'];
		$applyArray['student_cgpa'] = $userInfo['cgpa_h'];
		$applyArray['student_percentage_12'] = $userInfo['r12'];
		$applyArray['student_applied_req_at'] = date('Y/m/d H:i:s', time());

		$this->db->where('company_id', $comId );
		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('student_id', $studId );
		$reqStatus = $this->db->get('pms_student_applied_req')->row_array();

		$this->db->select('count(*) as total');
		$this->db->where('company_id', $comId );
		$this->db->where('company_requirement_id', $comReqId );
		$totalStudent = $this->db->get('pms_student_applied_req')->row_array();

		$notiArray['student_id'] = $studId;

		$this->db->where('company_requirement_id', $comReqId );
		$requirementInfo = $this->db->get('pms_company_requirements')->row_array();
		$notiArray['student_notification_created_at'] = date('Y/m/d H:i:s', time());

		if ( empty($reqStatus) ) {

			$notiArray['student_notification_class'] = "fas fa-thumbtack text-info";
			$notiArray['student_notification_detail'] = "Applied to <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
			$this->db->insert( 'pms_student_notification', $notiArray );
			
			$notiArray['student_notification_class'] = "fas fa-calendar-day text-danger";
			$notiArray['student_notification_detail'] = "Exam on ".date('j F Y h:i A', strtotime($requirementInfo['company_requirement_exam_date']))." for <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
			$this->db->insert( 'pms_student_notification', $notiArray );
			
			$this->db->insert( 'pms_student_applied_req', $applyArray );
			$this->session->set_flashdata('updateRSMsg', 'Your Applied Successfully.');
			redirect(base_url().'student/home/index');				
		
		} else {

			if ( $reqStatus['student_applied_req_status'] == 1 ) {

				$update = array(
					'student_applied_req_status' => 0
				);

				$notiArray['student_notification_class'] = "fas fa-undo text-default";
				$notiArray['student_notification_detail'] = "Revoke Application from <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
				$this->db->insert( 'pms_student_notification', $notiArray );

				$this->db->where('company_id', $comId );
				$this->db->where('company_requirement_id', $comReqId );

				$this->db->where('student_id', $studId );
				$this->db->update( 'pms_student_applied_req', $update );

				$this->session->set_flashdata('updateRIMsg', 'You Revoked Application Successfully.');
				redirect(base_url().'student/home/index');
				

			} else if ( $reqStatus['student_applied_req_status'] == 0 ) {

				$update = array(
					'student_applied_req_status' => 1
				);

				$notiArray['student_notification_class'] = "fas fa-thumbtack text-info";
				$notiArray['student_notification_detail'] = "Applied to <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post again at <i>".$requirementInfo['company_name']."</i>";
				$this->db->insert( 'pms_student_notification', $notiArray );
				
				$notiArray['student_notification_class'] = "fas fa-calendar-day text-danger";
				$notiArray['student_notification_detail'] = "Exam on ".date('j F Y h:i A', strtotime($requirementInfo['company_requirement_exam_date']))." for <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
				$this->db->insert( 'pms_student_notification', $notiArray );

				$this->db->where('company_id', $comId );
				$this->db->where('company_requirement_id', $comReqId );
				$this->db->where('student_id', $studId );
				$this->db->update( 'pms_student_applied_req', $update );
				$this->session->set_flashdata('updateRSMsg', 'Your Applied Successfully.');
				redirect(base_url().'student/home/index');
				
				
			}

		} 
	}
}
?>