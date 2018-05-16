<?php

namespace Drupal\custommodule;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

interface SiteAnnouncementInterface extends ConfigEntityInterface{

  /**
   * The ammouncement's message
   */

  public function getMessage();

}