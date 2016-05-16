<?php
/**
 * NotesBook FraseClass
 *
 * @author     Galo <galo.aragoneses@gmail.com>
 * @package    \app\domain
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

	class Frase implements JsonSerializable {

		private $id;
		private $frase;

		public function __construct($id, $frase) { 

			//Fields
			$this->frase = trim($frase);
			$this->id = trim($id);

		}

		/** Sets */
		public function set_frase($frase) {

			$this->frase = $frase;

		}

		/** Gets */
		public function get_frase() {

			return $this->frase;

		}

		/** Sets */
		public function set_id($id) {

			$this->id = $id;

		}

		/** Gets */
		public function get_id() {

			return $this->id;

		}

		/** JSON Serializer 
		 */

	    public function jsonSerialize() {
	        return [
	        	'id' => $this->id,
	            'frase' => $this->frase
	        ];
	    }

	}


?>