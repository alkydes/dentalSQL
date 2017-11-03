<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class dentist extends CI_Controller {

	private $upload_path = "./uploads";

	public function index()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('common_footer');
	}

	public function dentistlogin()
	{
		if($this->session->userdata('is_login')) redirect('/dentist/timeline/');
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('dentist_login');
		$this->load->view('dentist_login_script');
		$this->load->view('common_footer');
	}

	public function createpatient()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('common_footer');
	}

	public function listpatient()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('dentist_listpatient');
		$this->load->view('dentist_listpatient_script');		
		$this->load->view('common_footer');
	}

	public function timeline($p_idx)
	{
		$this->load->database();

		$t_query = '
		select 
			firstname,
			lastname,
			birth,
			gender,
			email,
			phone,
			hospital,
			patient_number,
			referral,
			description,
			reg_date,
			status,
			date_format(reg_date, "%Y-%m-%d") as folder_name
		from 
			patients 
		where 
			doctor_idx = "' . $this->session->userdata('idx') . '" and
			idx = "' . $p_idx . '"
		order by 
			idx desc
		';

		$query = $this->db->query($t_query);
		$patient_info = $query->row();

		$data = array(
			'p_idx' => $p_idx,
			'p_firstname' => $patient_info->firstname,
			'p_lastname' => $patient_info->lastname,
			'p_birth' => $patient_info->birth,
			'p_gender' => $patient_info->gender,
			'p_email' => $patient_info->email,
			'p_phone' => $patient_info->phone,
			'p_hospital' => $patient_info->hospital,
			'p_patient_number' => $patient_info->patient_number,
			'p_referral' => $patient_info->referral,
			'p_description' => $patient_info->description,
			'p_reg_date' => $patient_info->reg_date,
			'p_status' => $patient_info->status,
			'p_folder_name' => $patient_info->folder_name
		);

		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('dentist_timeline', $data);
		$this->load->view('dentist_timeline_script', $data);
		$this->load->view('dentist_timeline_modal', $data);
		$this->load->view('common_footer');

	}

	public function statistics()
	{
		$this->load->view('common_head');
		$this->load->view('common_nav');
		$this->load->view('common_script');
		$this->load->view('dentist_statistics');	
		$this->load->view('dentist_statistics_script');	
		$this->load->view('common_footer');
	}

	





/*	visit 적용

	public function upload()
	{
		$this->load->database();

		if ( ! empty($_FILES)) 
		{
			$config["upload_path"]   = $this->upload_path;
			$config["allowed_types"] = "gif|jpg|png";
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("file"))
			{
				print_r($this->upload->display_errors('<p>', '</p>'));
			}
			else
			{
				$t_a = $this->upload->data();
				$t_b = exif_read_data("./uploads/" . $t_a['file_name']);

				if( ! empty($t_b['DateTime']))
				{
					$t_c = substr($t_b['DateTime'], 0, 10);
					$t_d = str_replace(':', '-', $t_c);
					$t_e = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $t_d;

					if(!is_dir($t_e))
					{
						mkdir($t_e, 0777);
						$suc_file = rename("./uploads/" . $t_a['file_name'], "./uploads/" . $t_d . "/" .  $t_a['file_name']);
					}
					else
					{
						$suc_file = rename("./uploads/" . $t_a['file_name'], "./uploads/" . $t_d . "/" .  $t_a['file_name']);
					}					
				}
				else
				{
					$t_d = date( 'Y-m-d', strtotime(substr($t_a['file_name'], 13, 8) ) );
					$t_e = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $t_d;

					if(!is_dir($t_e))
					{
						mkdir($t_e, 0777);
						$suc_file = rename("./uploads/" . $t_a['file_name'], "./uploads/" . $t_d . "/" .  $t_a['file_name']);
					}
					else
					{
						$suc_file = rename("./uploads/" . $t_a['file_name'], "./uploads/" . $t_d . "/" .  $t_a['file_name']);
					}	

				}

				if ( empty($t_b['COMMENT']) )
				{
					$t_cat = 1;
				}
				else
				{
					if ( $t_b['COMPUTED']['Width'] < 1600 )
					{
						$t_cat = 2;
					}
					else
					{
						$t_cat = 3;
					}
				}
		

				if ( $suc_file > 0 )
				{
				
					$t_query = '
						select 
							count(0) as t_count
						from 
							visit
						where 
							patients_idx = 1 and
							status = 1 and
							date_format(reg_date, "%Y-%m-%d") = date_format("' . $t_d . '", "%Y-%m-%d")
					';

					$query = $this->db->query($t_query);
					$count = $query->row();
					$t_count = $count->t_count;

					if( $t_count > 0 )
					{
						$t_query = '
							select 
								idx as visit_idx
							from 
								visit
							where 
								patients_idx = 1 and
								status = 1 and
								date_format(reg_date, "%Y-%m-%d") = date_format( "' . $t_d . '", "%Y-%m-%d")
						';

						$query = $this->db->query($t_query);
						$visit = $query->row();
						$visit_idx = $visit->visit_idx;
					}
					else
					{
						$t_query = '
							insert into 
								visit 
							set
								patients_idx = 1,
								reg_date = "' . $t_d . ' 00:00:00",
								status = 1

						';
						$this->db->query($t_query);

						$visit_idx = $this->db->insert_id(); 
					}

					$t_query = '
						insert into 
							archive 
						set
							server_name = "' . $t_e . '",
							local_name = "' . $t_a['file_name'] . '",
							size = ' . $t_b['FileSize'] . ',
							category = ' . $t_cat . ',
							reg_date = now(),
							cre_date = "' . $t_d . ' 00:00:00",
							status = 1,
							visit_idx = ' . $visit_idx . ',
							patients_idx = 1
					';

					$this->db->query($t_query);


				}
			}
		}
	}
*/

	public function upload($p_idx)
	{
		$this->load->database();

		if ( ! empty($_FILES)) 
		{
			$config["upload_path"]   = $this->upload_path;
			$config["allowed_types"] = "gif|jpg|png";
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("file"))
			{
				print_r($this->upload->display_errors('<p>', '</p>'));
			}
			else
			{
				$t_a = $this->upload->data();
				$t_b = exif_read_data("./uploads/" . $t_a['file_name']);

				if( ! empty($t_b['DateTime']))
				{
					$t_c = substr($t_b['DateTime'], 0, 10);
					$t_d = str_replace(':', '-', $t_c);
					$t_e = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $t_d;

					if(!is_dir($t_e))
					{
						mkdir($t_e, 0777);
						rename("./uploads/" . $t_a['file_name'], "./uploads/" . $t_d . "/" .  $t_a['file_name']);
					}
					else
					{
						rename("./uploads/" . $t_a['file_name'], "./uploads/" . $t_d . "/" .  $t_a['file_name']);
					}					
				}
				else
				{
					$t_d = date( 'Y-m-d', strtotime(substr($t_a['file_name'], 13, 8) ) );
					$t_e = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $t_d;

					if(!is_dir($t_e))
					{
						mkdir($t_e, 0777);
						rename("./uploads/" . $t_a['file_name'], "./uploads/" . $t_d . "/" .  $t_a['file_name']);
					}
					else
					{
						rename("./uploads/" . $t_a['file_name'], "./uploads/" . $t_d . "/" .  $t_a['file_name']);
					}	

				}

				if ( empty($t_b['COMMENT']) )
				{
					$t_cat = 1;
				}
				else
				{
					if ( $t_b['COMPUTED']['Width'] < 1600 )
					{
						$t_cat = 2;
					}
					else
					{
						$t_cat = 3;
					}
				}

				/*
				echo "<xmp>";
				print_r($t_b);
				echo "</xmp>";
				*/

				$t_query = '
					insert into 
						archive
					set
						patients_idx = "' . $p_idx . '",
						server_name = "' . $t_e . '",
						local_name = "' . $t_a['file_name'] . '",
						size = ' . $t_b['FileSize'] . ',
						category = ' . $t_cat . ',
						reg_date = now(),
						cre_date = "' . $t_d . ' 00:00:00",
						status = 1
				';
				/*
				echo "<xmp>";
				print_r($t_query);
				echo "</xmp>";				
				*/
				$this->db->query($t_query);

			}
		}
	}

	public function remove()
	{
		$file = $this->input->post("file");
		if ($file && file_exists($this->upload_path . "/" . $file)) {
			unlink($this->upload_path . "/" . $file);
		}
	}

	public function list_files($p_idx)
	{
		/*
		$this->load->helper("file");
		$files = get_filenames($this->upload_path);
		// we need name and size for dropzone mockfile
		foreach ($files as &$file) {
			$file = array(
				'name' => $file,
				'size' => filesize($this->upload_path . "/" . $file)
			);
		}

		header("Content-type: text/json");
		header("Content-type: application/json");
		echo json_encode($files);
		*/

		$this->load->database();

		/*
		$t_query = '
			select 
				idx,
				server_name,
				local_name,
				category,
				size,
				cre_date,
				local_name as name,
				date_format(cre_date, "%Y-%m-%d") as folder_name
			from
				archive
			where
				status = 1
		';
		*/

		$t_query = '
			select 
				date_format(cre_date, "%Y-%m-%d") as folder_name, 
				category 
			from 
				archive 
			where 
				status = 1 and 
				patients_idx = "' . $p_idx . '"
			group by 
				cre_date, 
				category
		';

		$query = $this->db->query($t_query);
		$files = $query->result();

		header("Content-type: text/json");
		header("Content-type: application/json");
		echo json_encode($files);


	}

	public function list_file($p_idx)
	{
		$this->load->database();

		$t_query = '
			select 
				idx,
				server_name,
				local_name,
				category,
				size,
				cre_date,
				local_name as name,
				date_format(cre_date, "%Y-%m-%d") as folder_name
			from
				archive
			where
				status = 1 and
				patients_idx = "' . $p_idx . '"
			order by idx desc
			limit 1
		';

		$query = $this->db->query($t_query);
		$file = $query->row(); 
		$files = $query->result();

		$t_query = '
			select 
				count(0) as t_count
			from 
				archive 
			where 
				status = 1
				and category = ' . $file->category . '
				and cre_date = "' . $file->cre_date . '"
				and patients_idx = "' . $p_idx . '"
			group by 
				cre_date, 
				category
		';

		 $query = $this->db->query($t_query);
		 $count = $query->row();
		 $t_count = $count->t_count;

		 if($t_count == 1)
		{
			header("Content-type: text/json");
			header("Content-type: application/json");
			echo json_encode($files);
		}
	}

	public function get_images($p_idx)
	{		
		$this->load->database();
		
		$t_query = '
			select 
				idx,
				server_name,
				local_name,
				size,
				date_format(cre_date, "%Y-%m-%d") as folder_name
			from
				archive
			where
				status = 1 and
				category = ' . @$this->input->post(category) . ' and
				cre_date = "' . @$this->input->post(folder_name) . ' 00:00:00" and
				patients_idx = "' . $p_idx . '"
			order by idx desc
		';

		$query = $this->db->query($t_query);
		$files = $query->result();

		header("Content-type: text/json");
		header("Content-type: application/json");
		echo json_encode($files);
		
	}

	public function insert_chart($p_idx)
	{

		$this->load->database();


		// visit 생성
		$t_query = '
			select 
				count(0) as t_count
			from 
				visit
			where 
				patients_idx = "' . $p_idx . '" and
				status = 1 and
				date_format(reg_date, "%Y-%m-%d") = "' . @$this->input->post(t_date) . '"
		';

		$query = $this->db->query($t_query);
		$count = $query->row();
		$t_count = $count->t_count;

		if( $t_count > 0 )
		{
			$t_query = '
				select 
					idx as visit_idx
				from 
					visit
				where 
					patients_idx = "' . $p_idx . '" and
					status = 1 and
					date_format(reg_date, "%Y-%m-%d") = "' . @$this->input->post(t_date) . '"
			';

			$query = $this->db->query($t_query);
			$visit = $query->row();
			$visit_idx = $visit->visit_idx;
		}
		else
		{
			$t_query = '
				insert into 
					visit 
				set
					patients_idx = "' . $p_idx . '",
					reg_date = "' . @$this->input->post(t_date) . ' 00:00:00",
					status = 1

			';
			$this->db->query($t_query);

			$visit_idx = $this->db->insert_id(); 
		}



// 각 table insert
		$t_query = '
			select 
				count(0) as t_count
			from 
				' . @$this->input->post(table) . '
			where 
				visit_idx = "' . $visit_idx . '" and
				tn = "' . @$this->input->post(tn) . '"
		';

		$query = $this->db->query($t_query);
		$count = $query->row();
		$t_count = $count->t_count;

		if( $t_count > 0 )
		{
			$t_query = '
				update
					' . @$this->input->post(table) . '
				set					
					' . @$this->input->post(coloum) . ' = "' . @$this->input->post(html) . '"
				where
					tn = "' . @$this->input->post(tn) . '" and
					visit_idx = "' . $visit_idx . '"
			';

			$this->db->query($t_query);
		}
		else
		{
			$t_query = '
				insert into
					' . @$this->input->post(table) . '
				set
					tn = "' . @$this->input->post(tn) . '",
					' . @$this->input->post(coloum) . ' = "' . @$this->input->post(html) . '",
					visit_idx = "' . $visit_idx . '",
					status = 1

			';
			$this->db->query($t_query);

		}










		echo $t_query;

		//echo $this->input->post(table);
		//echo $this->input->post(coloum);
		//echo $this->input->post(tn);
		//echo $this->input->post(html);

	}



	public function get_chart($p_idx)
	{

		$this->load->database();

		$xml = simplexml_load_file("./chart_list.xml"); 

		$files = array();

		for($i=0; $i<$xml[0]->count(); $i++)
		{

			$colomn = "tn";

			for($j=0; $j<$xml[0]->children()[$i]->count(); $j++) 
			{
				$colomn = $colomn . ", " . $xml[0]->children()[$i]->children()[$j]->getName();
			}


			$t_query = '
				select 
					' . $colomn . ' 
				from 
					' . $xml[0]->children()[$i]->getName() . '
				where
					visit_idx = (select idx from visit where date_format(reg_date, "%Y-%m-%d") = "' .  @$this->input->post(folder_name) . '" and patients_idx = "' . $p_idx . '")				

			';

/*
			$t_query = '
				select 
					' . $colomn . ' 
				from 
					' . $xml[0]->children()[$i]->getName() . '
				where
					visit_idx = (select idx from visit where date_format(reg_date, "%Y-%m-%d") = "2017-08-03")				

			';	
*/

			$query = $this->db->query($t_query);

			foreach ($query->result_array() as $row)
			{
				for($j=0; $j<$xml[0]->children()[$i]->count(); $j++) 
				{ 
					$file = array
					(
						'chart ' . $xml[0]->children()[$i]->getName() . ' ' . $xml[0]->children()[$i]->children()[$j]->getName() . ' ' . $row["tn"] =>  $row[$xml[0]->children()[$i]->children()[$j]->getName()]
					);
					$files = array_merge($files, $file);
				}
			}

		}
		
		header("Content-type: text/json");
		header("Content-type: application/json");
		echo json_encode($files);

	}

	
	public function list_charts($p_idx)
	{
		$this->load->database();

		$t_query = '
			select 
				date_format(reg_date, "%Y-%m-%d") as folder_name
			from 
				visit 
			where 
				status = 1 and
				patients_idx = "' . $p_idx . '"
		';

		$query = $this->db->query($t_query);
		$files = $query->result();

		header("Content-type: text/json");
		header("Content-type: application/json");
		echo json_encode($files);


	}


	// 로그인

	function authentication()
	{

		$this->load->database();

		$t_query = '
			select 
				idx,
				password,
				firstname,
				lastname,
				hospital,
				speciality
			from 
				doctor 
			where 
				email = "' . @$this->input->post('email') . '" and
				status = 1 
		';

		$query = $this->db->query($t_query);
		$doctor = $query->row();

		if(@password_verify(@$this->input->post('password'), $doctor->password))
		{
			$this->session->set_userdata('is_login', true);
			$this->session->set_userdata('idx', $doctor->idx);
			$this->session->set_userdata('firstname', $doctor->firstname);
			$this->session->set_userdata('lastname', $doctor->lastname);
			$this->session->set_userdata('hospital', $doctor->hospital);
			$this->session->set_userdata('speciality', $doctor->speciality);

			echo "로그인 성공";

			echo $this->session->userdata('is_login');
			echo $this->session->userdata('idx');
			echo $this->session->userdata('firstname');
			echo $this->session->userdata('lastname');
			echo $this->session->userdata('hospital');
			echo $this->session->userdata('speciality');\

			redirect('/dentist/listpatient');

		}
		else
		{
			echo "로그인 실패";
			redirect('/');
		}


	}


	function listpatients()
	{
		$this->load->database();
		
		$t_query = '
			select 
				idx,
				firstname,
				lastname,
				birth,
				gender,
				email,
				phone,
				hospital,
				patient_number,
				referral,
				description,
				reg_date,
				status,
				date_format(reg_date, "%Y-%m-%d") as folder_name,
				-- (select date_format(cre_date, "%Y-%m-%d") from archive where patients_idx = a.idx and status = 1 order by cre_date asc limit 1) as start_date,
				-- (select date_format(now(), "%Y-%m-%d") from archive where patients_idx = a.idx and status = 1 order by cre_date desc limit 1) as end_date
				(select date_format(reg_date, "%Y-%m-%d") from visit where patients_idx = a.idx and status = 1 order by reg_date asc limit 1) as start_date,
				(select date_format(reg_date, "%Y-%m-%d") from visit where patients_idx = a.idx and status = 1 order by reg_date desc limit 1) as end_date
			from 
				patients as a
			where 
				doctor_idx = "' . $this->session->userdata('idx') . '"
			order by 
				idx desc
		';

		
		$query = $this->db->query($t_query);
		$files = $query->result();

		header("Content-type: text/json");
		header("Content-type: application/json");
		echo json_encode($files);


	}


	function get_kaplan3($variable)
	{
		$this->load->database();
			
		/*
		$t_query = '
			select
				(select dentin_adhesive from goto_08.material where visit_idx = (select idx from goto_08.visit where patients_idx = a.idx order by idx asc limit 1)) as material,	
			    (TIMESTAMPDIFF(month, birth, (select reg_date from goto_08.visit where patients_idx = a.idx order by idx desc limit 1)) - TIMESTAMPDIFF(month, birth, (select reg_date from goto_08.visit where patients_idx = a.idx order by idx asc limit 1))) as time,
				(case
					when TIMESTAMPDIFF(month, (select reg_date from goto_08.visit where patients_idx = a.idx order by idx desc limit 1), now()) < 6 then 0
					else 1
				end) as death
			from 
				patients as a
			where
				status = 1 and
				doctor_idx = "' . $this->session->userdata('idx') . '"
			order by 
				idx desc
		';
		*/

		if($variable == "all"){
			$t_query = '
				select 	
					distinct(a.idx),	
					(select dentin_adhesive from goto_08.material where visit_idx = b.idx order by idx asc limit 1) as material,
					TIMESTAMPDIFF(month, (select reg_date from goto_08.visit where patients_idx = a.idx order by idx asc limit 1), (select reg_date from goto_08.visit where patients_idx = a.idx order by idx desc limit 1)) as time,
					(case
						when TIMESTAMPDIFF(month, (select reg_date from goto_08.visit where patients_idx = a.idx order by idx desc limit 1), now()) < 6 then 0
						else 1
					end) as death
				from 
					goto_08.patients as a
					left join goto_08.visit as b on a.idx = b.patients_idx
				where
					a.status = 1 and
					a.doctor_idx = "' . $this->session->userdata('idx') . '"
				order by 
					a.idx desc
			';
		}else{
			$t_query = '
				select 
					basic.idx as p_idx,
					 c.dentin_adhesive as material,
					TIMESTAMPDIFF(month, (select reg_date from goto_08.visit where idx = basic.svi), (select reg_date from goto_08.visit where idx = lvi)) as time,
					case when b.' . $variable . ' = "charlie" then "1" else "0" end as death
				from 
					(select
						a.idx as idx,
						(select idx from goto_08.visit where patients_idx = a.idx order by idx asc limit 1) as svi,
						(select idx from goto_08.visit where patients_idx = a.idx order by idx desc limit 1) as lvi
					from 
						goto_08.patients as a) as basic
					left join goto_08.USPHS_criteria as b on b.idx = basic.lvi
					left join goto_08.material as c on c.idx = basic.svi
				order by 
					basic.idx asc
			';

		}
		
		$query = $this->db->query($t_query);
		$files = $query->result();

		header("Content-type: text/json");
		header("Content-type: application/json");
		echo json_encode($files);


	}



}

