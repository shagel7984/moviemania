<?php
/**
 * @file providing the service that say hello world and hello 'given name'.
 *
 */
namespace  Drupal\hello_world\Services;

class GoodbyeService {
  protected $say_something;

  public function __construct() {
    $this->say_something = 'Goodbye World!';
  }
  public function sayGoodbye($name = ''){
    if (empty($name)) {
      return $this->say_something;
    }
    else {
      return "Goodbye " . $name . "!";
    }
  }
}