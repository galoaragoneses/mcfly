<?php 
/**
 * McFlyApp Bootstrap File
 *
 * @author     Nombre <email@email.com&lt;<br/>
 * @package    \application\config
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */


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

