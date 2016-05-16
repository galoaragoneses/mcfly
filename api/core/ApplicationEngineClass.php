<?php 
/**
 * NotesBook start_application
 *
 * @author     Nombre <email@email.com>
 * @package    \api\core
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

	class ApplicationEngine {

		public static function start() {
			try {

				/** Routing - Load Controller and execute Action with the parameters from URI */
				RoutingEngineService::init();

				/** Create Controller */
				$controller_name = RoutingEngineService::get_controller_name();
				$controller_obj = new $controller_name;

				/** Execute action */
				HttpEngineService::set_response_json_headers();
				echo $controller_obj->init();

			} catch (Exception $err) {
				
				print_r($err);
				throw $err;

			}
		}
	}

?>