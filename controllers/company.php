<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class company extends CI_Controller {

	private $upload_path = "./uploads";

	public function index()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('common_footer');
	}

	public function companylogin()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('company_login');
		$this->load->view('company_login_script');
		$this->load->view('common_footer');
	}

	public function briefing()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('common_footer');
	}

	public function registerproducts()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('common_footer');
	}

	public function productreports()
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
}