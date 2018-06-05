<?php

namespace Drupal\Tests\hello_world\FunctionalJavascript;



use Drupal\FunctionalJavascriptTests\JavascriptTestBase;

/**
 * Class TimeTest
 * @package Drupal\Tests\hello_world\FunctionalJavascript
 *
 */
class TimeTest extends JavascriptTestBase {

  /**
   * @var array
   */
  protected static $modules = ['hello_world'];

  public function testTime() {
    $this->drupalGet('/hello');
    $this->assertSession()->pageTextContains('The time is');

    $config = $this->config('hello_world.custom_salutation');
    $config->set('salutation', 'Testing salutation');
    $config->save();

    $this->drupalGet('/hello');
    $this->assertSession()->pageTextNotContains('The time is');

  }

}
