<?php

    require_once "PHPUnit/Autoload.php";
    require "../domain/FraseClass.php";

    class FraseTest extends PHPUnit_Framework_TestCase
    {

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