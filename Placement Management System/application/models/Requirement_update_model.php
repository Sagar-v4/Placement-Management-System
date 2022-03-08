<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requirement_update_model extends CI_Model {

	public function requirementUpdate($requirementArray) {
        
        $update = array(
            'company_requirement_name' => $requirementArray['company_requirement_name'],
            'company_requirement_description' => $requirementArray['company_requirement_description'],
            'company_requirement_post' => $requirementArray['company_requirement_post'],
            'company_requirement_vacancy' => $requirementArray['company_requirement_vacancy'],
            'company_requirement_min_percentage' => $requirementArray['company_requirement_min_percentage'],
            'company_requirement_min_cgpa' => $requirementArray['company_requirement_min_cgpa'],
            'company_requirement_min_percentage_12th' => $requirementArray['company_requirement_min_percentage_12th'],
            'company_requirement_min_salary' => $requirementArray['company_requirement_min_salary'],
            'company_requirement_last_date' => $requirementArray['company_requirement_last_date'],
            'company_requirement_exam_date' => $requirementArray['company_requirement_exam_date'],
            'company_requirement_exam_date_end' => $requirementArray['company_requirement_exam_date_end'],
            'company_requirement_interview_date' => $requirementArray['company_requirement_interview_date'],
            'company_requirement_interview_date_end' => $requirementArray['company_requirement_interview_date_end']
        );

		$this->db->where('company_requirement_id', $requirementArray['rid']);
        $this->db->update('pms_company_requirements', $update);

	}

	public function requirementExamUpdate($requirementArray) {
        
        $update = array(
            'company_requirement_exam_date' => $requirementArray['company_requirement_exam_date'],
            'company_requirement_exam_date_end' => $requirementArray['company_requirement_exam_date_end']
        );

		$this->db->where('company_requirement_id', $requirementArray['rid']);
        $this->db->update('pms_company_requirements', $update);

	}

	public function requirementInterviewUpdate($requirementArray) {
       
        $update = array(
            'company_requirement_interview_date' => $requirementArray['company_requirement_interview_date'],
            'company_requirement_interview_date_end' => $requirementArray['company_requirement_interview_date_end']
        );

		$this->db->where('company_requirement_id', $requirementArray['rid']);
        $this->db->update('pms_company_requirements', $update);

	}

}
