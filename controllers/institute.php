f<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class institute extends CI_Controller {

	private $upload_path = "./uploads";

	public function index()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('common_footer');
	}

	public function institutelogin()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('institute_login');
		$this->load->view('institute_login_script');
		$this->load->view('common_footer');
	}

	public function createdentist()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('institute_doctor_create');
		$this->load->view('institute_doctor_create_script');
		$this->load->view('common_footer');
	}

	public function database()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('common_footer');
	}

	public function timeline()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('common_footer');
	}

	public function statistics()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('common_footer');
	}

	public function insert_dentist()
	{
		$this->load->database();

		$t_query = '
			insert into 
				doctor 
			set
				password = "' . password_hash($this->input->post('password'), PASSWORD_BCRYPT) . '",
				firstname = "' . $this->input->post('first_name') . '",
				lastname = "' . $this->input->post('last_name') . '",
				birth = "' . $this->input->post('date') . '",
				gender = "' . $this->input->post('gender') . '",
				email = "' . $this->input->post('email') . '",
				phone = "' . $this->input->post('phone') . '",
				hospital = "' . $this->input->post('hospital') . '",
				licence_number = "' . $this->input->post('drcode') . '",
				licence_date = "' . $this->input->post('drdate') . '",
				speciality = "' . $this->input->post('specialty') . '",
				description = "' . $this->input->post('comment') . '",
				reg_date = now(),
				status = 1

		';
		$this->db->query($t_query);

		$visit_idx = $this->db->insert_id(); 

		redirect('/dentist/dentistlogin/');

	}

}