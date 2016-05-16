<?php
/**
 * McFlyApp FraseClass
 *
 * @author     Galo <galo.aragoneses@gmail.com>
 * @package    \app\domain
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

    require_once "PHPUnit/Autoload.php";

    class FraseTest extends PHPUnit_Framework_TestCase {

        public function testFailDummy()
        {
            // Arrange
            $a = true;

            // Act
            $b = false;

            // Assert
            $this->assertEquals(-1, false);
        }

    }


?>