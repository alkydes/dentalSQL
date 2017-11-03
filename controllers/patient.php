<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	private $upload_path = "./uploads";

	public function index()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('common_footer');
	}

	public function patientlogin()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('patient_login');
		$this->load->view('patient_login_script');
		$this->load->view('common_footer');
	}

	public function createpatient()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('patient_create');
		$this->load->view('patient_create_script');
		$this->load->view('common_footer');
	}

	public function survey()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('patient_survey');
		$this->load->view('patient_survey_script');
		$this->load->view('common_footer');
	}

	public function dentalreports()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('patient_timeline');
		$this->load->view('patient_timeline_script');
		$this->load->view('patient_timeline_modal');
		$this->load->view('common_footer');
	}

	public function insert_patient()
	{
		$this->load->database();

		$t_query = '
			insert into 
				patients 
			set
				password = "' . password_hash($this->input->post('password'), PASSWORD_BCRYPT) . '",
				firstname = "' . $this->input->post('first_name') . '",
				lastname = "' . $this->input->post('last_name') . '",
				birth = "' . $this->input->post('date') . '",
				gender = "' . $this->input->post('gender') . '",
				email = "' . $this->input->post('email') . '",
				phone = "' . $this->input->post('phone') . '",
				hospital = "' . $this->input->post('hospital') . '",
				patient_number = "' . $this->input->post('ptcode') . '",
				referral = "' . $this->input->post('referral') . '",
				description = "' . $this->input->post('comment') . '",
				doctor_idx = "' . $this->session->userdata('idx') . '",
				reg_date = now(),
				status = 1

		';
		$this->db->query($t_query);

		$visit_idx = $this->db->insert_id(); 

		redirect('/dentist/listpatient/');

	}

}