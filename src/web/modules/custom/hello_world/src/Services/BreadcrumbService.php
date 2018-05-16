<?php
/**
 * @file providing the service that say hello world and hello 'given name'.
 *
 */
namespace  Drupal\hello_world\Services;

class BreadcrumbService {

  public function build(){
    return array(
      '#title' => 'Hello World!',
      '#markup' => 'Here is some content from breadcrumb.',
    );
  }
}