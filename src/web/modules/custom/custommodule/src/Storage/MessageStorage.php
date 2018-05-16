<?php
namespace Drupal\custommodule\Storage;


use Drupal\Core\Entity\Sql\SqlContentEntityStorage;

class MessageStorage extends SqlContentEntityStorage{

  /**
   * Load multiple messages by bundle type.
   *
   * @param string $mesage_type
   * The message type.
   *
   * @return array \Drupal\Core\Entity\EntityInterface[]
   * An array of loaded messages entities.
   *
   */
  public function loadMultipleByType($message_type){
    return $this->loadByProperties(
      [
      'type' => $message_type
      ]
    );
  }

}