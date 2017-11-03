<?php


exit;
defined('BASEPATH') OR exit('No direct script access allowed');

class db_chart_insert extends CI_Controller {

	private $upload_path = "./uploads";

	public function index()
	{

		$t_query_a = "
			select 
				idx 
			from 
				goto_08.patients 
			where 
				status = 1 
			order by idx asc
		";

		$query_a = $this->db->query($t_query_a);

		foreach ($query_a->result_array() as $row_a)
		{
			$t_query_b = '
				select 
					date_format(cre_date, "%Y-%m-%d") as t_date 
				from 
					goto_08.archive 
				where 
					patients_idx = "' . $row_a["idx"] . '" 
					and status = 1 
				order by cre_date desc 
				limit 1
			';
			$query_b = $this->db->query($t_query_b);



			//치아, 재료 환자별 랜덤으로 정하기
			$arrTn = array("11","12","13","14","15","16","17","21","22","23","24","25","26","27","31","32","33","34","35","36","37","41","42","43","44","45","46","47");
			$pTn = $arrTn[mt_rand(0, 27)];
			$arrMt = array("3M Singlebond Universal", "GC G-Premio bond Universal");
			$pMt = $arrMt[mt_rand(0, 1)];

			


			foreach ($query_b->result_array() as $row_b)
			{
				// echo $row_a["idx"] . ".." . $row_b["t_date"] . '<br>';
				
				date_default_timezone_set('Asia/Seoul');
				$timenow = date("Y-m-d"); 
				$timetarget = $row_b["t_date"];

				$str_now = strtotime($timenow);
				$str_target = strtotime($timetarget);


				//USPHS 변수
				$values_a = array("alpha", "bravo", "charlie");
				$values_b = array("alpha", "bravo", "charlie");
				$values_c = array("alpha", "bravo", "charlie");
				$values_d = array("alpha", "bravo", "charlie");
				$values_e = array("alpha", "bravo", "charlie");

				if($pMt == "3M Singlebond Universal"){
					$weights_a = [95,4,1];
					$weights_b = [95,4,1];
					$weights_c = [95,4,1];
					$weights_d = [95,4,1];
					$weights_e = [95,4,1];
				}else{
					$weights_a = [90,7,3];
					$weights_b = [90,7,3];
					$weights_c = [90,7,3];
					$weights_d = [90,7,3];
					$weights_e = [90,7,3];
				}

				

				for($i=0; $i<10000; $i++){				


					if($str_now > $str_target) {
						//echo $row_a["idx"] . ".." . date("Y-m-d", $str_now) . "//" .  date("Y-m-d", $str_target) . "<br>";						

						$t_query_c = '
							insert into 
								visit 
							set
								patients_idx = "' .  $row_a["idx"] . '",
								reg_date = "' . date("Y-m-d", $str_target) . ' 00:00:00",
								status = 1

						';
						$this->db->query($t_query_c);

						$visit_idx = $this->db->insert_id(); 
						//$visit_idx = 1; 

						//echo $pMt . ".." . $pTn . ".." .  $t_query_c . "<br>";

						$t_query_d = '
							insert into
								material
							set
								tn = "' . $pTn . '",
								dentin_adhesive = "' . $pMt . '",
								visit_idx = "' . $visit_idx . '",
								status = 1

						';
						
						$this->db->query($t_query_d);

						
						$index_a = weighted_random($weights_a);
						$result_a = $values_a[$index_a];

						if($result_a == "bravo") $weights_a = [0,95,5];
						if($result_a == "charlie") $weights_a = [0,0,100];

						$index_b = weighted_random($weights_b);
						$result_b = $values_b[$index_b];

						if($result_b == "bravo") $weights_b = [0,95,5];
						if($result_b == "charlie") $weights_b = [0,0,100];


						$index_c = weighted_random($weights_c);
						$result_c = $values_c[$index_c];

						if($result_c == "bravo") $weights_c = [0,95,5];
						if($result_c == "charlie") $weights_c = [0,0,100];


						$index_d = weighted_random($weights_d);
						$result_d = $values_d[$index_d];

						if($result_d == "bravo") $weights_d = [0,95,5];
						if($result_d == "charlie") $weights_d = [0,0,100];


						$index_e = weighted_random($weights_e);
						$result_e = $values_e[$index_e];

						if($result_e == "bravo") $weights_e = [0,95,5];
						if($result_e == "charlie") $weights_e = [0,0,100];

						if($i == 0 )
						{
							$result_a = "alpha";
							$result_b = "alpha";
							$result_c = "alpha";
							$result_d = "alpha";
							$result_e = "alpha";
						}						

						$t_query_e = '
							insert into
								USPHS_criteria
							set
								tn = "' . $pTn . '",
								`color_match` = "' . $result_a . '",
								`cavosurface_maginal_discoloration` = "' . $result_b . '",
								`anaotomic_form` = "' . $result_c . '",
								`marginal_adaptation` = "' . $result_d . '",
								`caries` = "' . $result_e . '",
								visit_idx = "' . $visit_idx . '",
								status = 1

						';

						echo  $t_query_e . "<br>";
						
						$this->db->query($t_query_e);

						$timetarget = date('Y-m-d',strtotime($timetarget.'+6 months')); 
						$str_target = strtotime($timetarget);
						
						if($result_a == "charlie") break;
						if($result_b == "charlie") break;
						if($result_c == "charlie") break;
						if($result_d == "charlie") break;
						if($result_e == "charlie") break;


					}else{
						break;
					}


				}

				






			}

			
		}
	

	}

}


function weighted_random($weights) {
  $r = rand(1, array_sum($weights));
  for($i=0; $i<count($weights); $i++) {
	$r -= $weights[$i];
	if($r < 1) return $i;
  }
  return false;
}