<?php
namespace Drupal\Tests\testingmodule;

use Drupal\testingmodule\Calculator;
use Drupal\Tests\UnitTestCase;

/**
 * Class CalculatorTest
 * @package Drupal\Tests\testingmodule
 * @group testingmodule
 *
 */

class CalculatorTest extends UnitTestCase{

  /*
   * @var Calculator
   */
  protected $calculatorOne;

  /*
   * @var Calculator
   */
  protected $calculatorTwo;


  public function setUp(){
    parent::setUp();
    $this->calculatorOne = new Calculator(10,5);
    $this->calculatorTwo = new Calculator(10,10);
  }
   
  /**
   * Tests Calculator::add() method
   */
  public function testAdd(){
    /*$calculator = new Calculator(10,5);
    $this->assertEquals(15, $calculator->add());

    $calculator = new Calculator(10,10);
    $this->assertEquals(20, $calculator->add());*/
    $this->assertEquals(15, $this->calculatorOne->add());
    $this->assertEquals(15, $this->calculatorTwo->add());
  }

  /**
   * Tests Calculator::substract() method
   */
  public function testSubstract(){
    $calculator = new Calculator(10,5);
    $this->assertEquals(15, $calculator->subtract());
  }

  /**
   * Tests Calculator::multiply() method
   */
  public function testMultiply(){
    $calculator = new Calculator(10,5);
    $this->assertEquals(15, $calculator->multiply());
  }

  /**
   * Tests Calculator::divide() method
   */
  public function testDivide(){
    $calculator = new Calculator(10,5);
    $this->assertEquals(2, $calculator->divide());
  }
}