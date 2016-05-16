<?php
/**
 * McFlyApp FraseControllerClass
 *
 * @author     Galo <galo.aragoneses@gmail.com.com>
 * @package    \app\controllers
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

	class FraseController {

		private $method;
		private $json_frases_array;
		private $json_file_path;


		public function __construct() {

			$this->method = $_SERVER['REQUEST_METHOD'];
			$this->json_file_path = "data/frases.json";

			$json_content_txt = file_get_contents($this->json_file_path);
			$this->json_frases_array = json_decode($json_content_txt, TRUE);

		}

		/* Method POST
		 * Create new Frase
		 */
		public function init() {

			switch ($this->method) {
			 	case 'PUT':
					//1. Get User's fields from Request Body
					$request_body = HttpEngineService::get_array_from_json_body();
					return $this->insert($request_body["frase"]);
			 		break;
			 	
			 	case 'GET':
			 	default:
			 		$params = RoutingEngineService::get_params();
			 		$params_count = count($params);

			 		if (!$params_count) {

			 			//get_all
			 			return json_encode($this->json_frases_array["frases"]);

			 		} else if ($params_count == 1 && intval($params[0])) {

			 			//get_by_id
			 			$id = intval($params[0]);
			 			return json_encode($this->get_by_id($id));

			 		} else if ($params_count == 2 && $params[1] == "favorita") {

			 			//mark_as_favorita
			 			$id = intval($params[0]);
			 			return json_encode($this->mark_as_favorita($id));

			 		} else if ($params_count == 1 && $params[0] == "favoritas") {

			 			//get_all_favoritas
			 			$id = intval($params[0]);
			 			return json_encode($this->get_all_favoritas());

			 		}

			 		break;
			 }
		}


		public function insert($frase_txt) {

			$new_id = $this->get_new_id();

			$frase = new Frase($new_id, $frase_txt);

			$this->json_frases_array["frases"][] = $frase;
			file_put_contents ( $this->json_file_path, json_encode($this->json_frases_array) );

		}


		public function get_new_id() {

			$frases_aux = $this->json_frases_array["frases"];
			if(!count($frases_aux))
				return 1;

			$max_id = 1;
			foreach ($frases_aux as $key => $frase) {
				$aux_id = intval($frase["id"]);
			 	$max_id = $aux_id > $max_id ? $aux_id : $max_id;
			} 


			return $max_id + 1;

		}


		public function get_by_id($id) {

			$frases_aux = $this->json_frases_array["frases"];

			$frase_aux = null;
			foreach ($frases_aux as $key => $frase) {
				$aux_id = intval($frase["id"]);
			 	
			 	if ($aux_id == $id)
			 		return $frase;
			}

			return null;
		}


		public function mark_as_favorita($id) {

			$frase_aux = null;
			foreach ($this->json_frases_array["frases"] as $key => $frase) {
				$aux_id = intval($frase["id"]);
			 	
			 	if ($aux_id == $id) {
					if (!array_key_exists("favorita", $frase) || !$frase["favorita"])
						$this->json_frases_array["frases"][$key]["favorita"] = true;
					else 
						$this->json_frases_array["frases"][$key]["favorita"] = false;


			 		$frase_aux = $frase;
					break;
				}
			}

			if (!is_null($frase_aux)) {
				file_put_contents ( $this->json_file_path, json_encode($this->json_frases_array));
				return true;
			}

			throw "ERROR APPLICATION: Frase Not Found";

		}


		public function get_all_favoritas() {

			function is_favorita($frase)
			{
			    return $frase["favorita"];
			}

			return array_filter($this->json_frases_array["frases"], "is_favorita");

		}

	}
