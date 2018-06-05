<?php

namespace Drupal\Tests\hello_world\Functional;

use Drupal\Tests\BrowserTestBase;


/**
 * Class HelloWorldPageTest
 * @package Drupal\Tests\hello_world\Functional
 * @group hello_world
 */
class HelloWorldPageTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['hello_world','user'];

  public function testPage() {
    $this->drupalGet('/hello/world');
    $ex = 23;
    $this->assertEquals(2, $ex);
    $expected = 'fsdfdsafs';
    $this->assertSession()->pageTextContains($expected);
    $expected = 'Salutation';
    $this->assertSession()->pageTextNotContains($expected);


   /* $expected = $this->assertDefaultSalutation();
    $config = $this->config('hello_world.custom_salutation');
    $config->set('saluation', 'Testing salutation');
    $config->save();


    $this->drupalGet('/hello/world');
    $this->assertSession()->pageTextNotContains($expected);
    $expected = 'Testing bla';
    $this->assertSession()->pageTextContains($expected);*/
  }

  private function assertDefaultSalutation() {
    $this->drupalGet('/hello/world');
    $this->assertSession()->pageTextContains('Salutation');
    $time = new \DateTime();
    $expected = '';
    if ((int) $time->format('G') >= 06 && (int) $time->format('G') < 12) {
      $expected = 'Good morning';
    }

    if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      $expected = 'Good morning';
    }

    if ((int) $time->format('G') >= 18) {
      $expected = 'Good morning';
    }

    $expected .= ' world';
    $this->assertSession()->pageTextContains($expected);
    return $expected;
  }

}
