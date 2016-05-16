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
		public function edit() {

			//1. Get User's fields from $request_body
			$request_body = HttpEngineService::get_array_from_json_body();


			if ($this->method == "PUT")
				return $this->insert($request_body["frase"]);


		}


		private function insert($frase_txt) {

			$new_id = $this->get_new_id();

			$frase = new Frase($new_id, $frase_txt);

			$this->json_frases_array["frases"][] = $frase;
			file_put_contents ( $this->json_file_path, json_encode($this->json_frases_array) );

		}


		private function get_new_id() {

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

	}
