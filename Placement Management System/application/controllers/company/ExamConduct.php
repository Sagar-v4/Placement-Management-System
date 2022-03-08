<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamConduct extends CI_Controller {

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

    public function index( $comReqId, $comId ) {

		$this->load->library('form_validation');

		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['company']['email'] );

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$requirement = $this->db->get('pms_company_requirements')->row_array();
		
		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$totalQues = $this->db->count_all_results('pms_company_requirement_exam_create');

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$examQues = $this->db->get('pms_company_requirement_exam_create')->result_array();
		
		date_default_timezone_set("Asia/Kolkata");
		$current = strtotime(date("Y-m-d H:i:s", time()));
		$end = strtotime( $requirement['company_requirement_exam_date_end'] );
		
        if ( $current < $end ) {
            
    		$data['requirement'] = $requirement;
    		$data['examQues'] = $examQues;
    		$data['totalQues'] = $totalQues;
    		
    		if ( $userInfo['cid'] == $comId ) {
    			$this->load->view('company/examConduct', $data);
    		} else {
    			$data['heading'] = "404";
    			$data['message'] = "Page Not Found";
    
    			$this->load->view('errors/html/error_404', $data);
    		}
        }

    }

	public function save( $comReqId, $comId ) {

		$this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata');

		$this->form_validation->set_rules('question', 'Question', 'trim|required');
		$this->form_validation->set_rules('option_1', 'option1', 'trim|required');
		$this->form_validation->set_rules('option_2', 'option2', 'trim|required');
		$this->form_validation->set_rules('option_3', 'option3', 'trim|required');
		$this->form_validation->set_rules('option_4', 'option4', 'trim|required');
		$this->form_validation->set_rules('option_correct', 'Option correct', 'trim|required');

		if ( $this->form_validation->run() == TRUE) { 

            
			$queArray = array();

			$queArray['company_requirement_id'] = $comReqId;
			$queArray['company_id'] = $comId;
			$queArray['question_description'] = $this->input->post('question');
			$queArray['option_1'] = $this->input->post('option_1');
			$queArray['option_2'] = $this->input->post('option_2');
			$queArray['option_3'] = $this->input->post('option_3');
			$queArray['option_4'] = $this->input->post('option_4');
			$queArray['option_correct'] = $this->input->post('option_correct');
            $queArray['exam_question_created_at'] = date('Y/m/d H:i:s', time());

            if ( $queArray['option_correct'] != $queArray['option_1'] and  $queArray['option_correct'] != $queArray['option_2'] and  $queArray['option_correct'] != $queArray['option_3'] and $queArray['option_correct'] != $queArray['option_4']   ) {
                
                $this->session->set_flashdata('queESave','Correct Ans Doesn\'t Match With Any Option.');
                redirect( base_url().'company/ExamConduct/index/'.$comReqId.'/'.$comId );
			}  

			if ( !empty($queArray) ) {

                $this->db->insert('pms_company_requirement_exam_create', $queArray);
				$this->session->set_flashdata('queSSave','Question Added Successfully.');
                redirect( base_url().'company/ExamConduct/index/'.$comReqId.'/'.$comId );

			}
		} else {
			
			$this->session->set_flashdata('queESave','Incorrect Inputs.');
            redirect( base_url().'company/ExamConduct/index/'.$comReqId.'/'.$comId );

		}
		
	}

	public function edit( $comReqId, $comId, $queId ) {

		$this->load->library('form_validation');

		$this->form_validation->set_rules('question_edit', 'Question edit', 'trim|required');
		$this->form_validation->set_rules('option_1_edit', 'option1 edit', 'trim|required');
		$this->form_validation->set_rules('option_2_edit', 'option2 edit', 'trim|required');
		$this->form_validation->set_rules('option_3_edit', 'option3 edit', 'trim|required');
		$this->form_validation->set_rules('option_4_edit', 'option4 edit', 'trim|required');
		$this->form_validation->set_rules('option_correct_edit', 'Option correct edit', 'trim|required');

		if ( $this->form_validation->run() == TRUE) { 

            
			$queArray = array();

			$queArray['company_requirement_id'] = $comReqId;
			$queArray['company_id'] = $comId;
			$queArray['question_description'] = $this->input->post('question_edit');
			$queArray['option_1'] = $this->input->post('option_1_edit');
			$queArray['option_2'] = $this->input->post('option_2_edit');
			$queArray['option_3'] = $this->input->post('option_3_edit');
			$queArray['option_4'] = $this->input->post('option_4_edit');
			$queArray['option_correct'] = $this->input->post('option_correct_edit');

            if ( $queArray['option_correct'] != $queArray['option_1'] and  $queArray['option_correct'] != $queArray['option_2'] and  $queArray['option_correct'] != $queArray['option_3'] and $queArray['option_correct'] != $queArray['option_4']   ) {
                
                $this->session->set_flashdata('queESave','Correct Ans Doesn\'t Match With Any Option.');
                redirect( base_url().'company/ExamConduct/index/'.$comReqId.'/'.$comId );
			}  

			if ( !empty($queArray) ) {

				$update = array(
					'company_requirement_id' => $comReqId,
					'company_id' => $comId,
					'question_description' => $queArray['question_description'],
					'option_1' => $queArray['option_1'],
					'option_2' => $queArray['option_2'],
					'option_3' => $queArray['option_3'],
					'option_4' => $queArray['option_4'],
					'option_correct' => $queArray['option_correct']
				);

				$this->db->where('exam_question_id', $queId );
                $this->db->update('pms_company_requirement_exam_create', $update);

				$this->session->set_flashdata('queSSave','Question Edited Successfully.');
                redirect( base_url().'company/ExamConduct/index/'.$comReqId.'/'.$comId );

			}
		} else {
			
			$this->session->set_flashdata('queESave','Incorrect Inputs.');
            redirect( base_url().'company/ExamConduct/index/'.$comReqId.'/'.$comId );

		}
		
	}

	public function delete( $comReqId, $comId, $queId ) {

        $this->db->where('company_id', $comId );
        $this->db->where('company_requirement_id', $comReqId );
        $this->db->where('exam_question_id', $queId );
        $this->db->delete('pms_company_requirement_exam_create');
        
		$this->session->set_flashdata('queSSave','Deleted Successfully.');
		redirect( base_url().'company/ExamConduct/index/'.$comReqId.'/'.$comId );
		
	}

}
?>