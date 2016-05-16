<?php 
/**
 * McFlyApp Bootstrap File
 *
 * @author     Nombre <email@email.com&lt;<br/>
 * @package    \application\config
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

	/** Global Vars */
	$_MCFLY_GLOBALS = array();
	$_MCFLY_GLOBALS["settings"] = array();

	/** Load Settings from webconfig.xml file */
	function nb_loadSettings() {
		global $_MCFLY_GLOBALS;

		$file_path = "./webconfig.xml";
		if(!file_exists($file_path)) {
			throw new Exception("No Existe fichero de configuración del api");
		}

		$aux_xml = file_get_contents($file_path);
		$_MCFLY_GLOBALS["settings"] = simplexml_load_string($aux_xml);
	}

	nb_loadSettings();

	/** Load Dependecies */
	/** Services */
	include("core/services/HttpEngineServiceClass.php");
	include("core/services/RoutingEngineServiceClass.php");

	/** Application */
	include("core/ApplicationEngineClass.php");

	/** Controllers */	
	include('controllers/DummyControllerClass.php');
	include('controllers/FraseControllerClass.php');

	/** Domain */
	include('domain/FraseClass.php');

	/** Init Application
	 *
	 * Execute the Specifics Action and Controller 
	*/
	
	ApplicationEngine::start();
	
 ?>

