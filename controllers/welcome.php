<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class welcome extends CI_Controller {

	private $upload_path = "./uploads";

	public function index()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('welcome_body');
		$this->load->view('common_script');
		$this->load->view('common_footer');
	}

}