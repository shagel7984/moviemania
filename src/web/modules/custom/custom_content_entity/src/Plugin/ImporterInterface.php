<?php
namespace Drupal\custom_content_entity\Plugin{

  use Drupal\Component\Plugin\PluginInspectionInterface;

  interface ImporterInterface extends PluginInspectionInterface{

    /**
     * @return bool
     */
    public function import();
  }

}