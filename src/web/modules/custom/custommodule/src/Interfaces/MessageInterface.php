<?php
/**
 * @file Contains \Drupal\mymodule\Entity\MessageInterface.
 */
namespace Drupal\custommodule\Interfaces;
use Drupal\Core\Entity\ContentEntityInterface;

interface MessageInterface extends ContentEntityInterface {
  /**
   * Gets the message value.
   *
   * @return string
   */
  public function getMessage();

  /**
   * Gets the message value.
   *
   * @return string
   */
  public function getName();
}