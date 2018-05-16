<?php

namespace Drupal\custommmodule;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider;

class MessageHtmlRouteProvider extends DefaultHtmlRouteProvider{

  protected function getCanonicalRoute(EntityTypeInterface $entity_type)
  {
    return $this->getEditFormRoute();
  }

}
