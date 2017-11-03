<?php
exit;
defined('BASEPATH') OR exit('No direct script access allowed');

class db_patients_insert extends CI_Controller {

	private $upload_path = "./uploads";

	public function index()
	{
		
		$arr = file('a.txt'); 

		foreach($arr as $v){ 
			$arrV = explode(" ", $v);
			$last_name = mb_substr($arrV[1], 0, 1);
			$first_name = mb_substr($arrV[1], 1, 2);
			$full_name = $last_name . $first_name;

			$this->load->database();

			$t_query = '
				insert into 
					patients 
				set
					password = "' . password_hash($full_name, PASSWORD_BCRYPT) . '",
					firstname = "' . $first_name . '",
					lastname = "' . $last_name . '",
					birth = "' . mt_rand(1980, 2000) . '-' . mt_rand(1, 12) . '-' . mt_rand(1, 30) . '",
					gender = "' . mt_rand(1, 2) . '",
					email = "' . $arrV[0] . '@dankook.ac.kr",
					phone = "010-' . mt_rand(1000,9999) . '-' . mt_rand(1000, 9999) . '",
					hospital = "Dankook University Dental Hospital",
					patient_number = "' . $arrV[0] . '",
					referral = "goto.dentist",
					description = "goto.dentist",
					doctor_idx = "1",
					reg_date = now(),
					status = 1

			';

			echo $t_query . "<br>";
			$this->db->query($t_query);

		} 
	}

}