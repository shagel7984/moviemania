<?php

namespace Drupal\lotus\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\lotus\LotusInterface;

/**
 * Defines the lotus entity.
 *
 * @ConfigEntityType(
 *   id = "lotus",
 *   label = @Translation("Lotus"),
 *   handlers = {
 *     "list_builder" = "Drupal\lotus\Controller\LotusListBuilder",
 *     "form" = {
 *       "add" = "Drupal\lotus\Form\LotusForm",
 *       "edit" = "Drupal\lotus\Form\LotusForm",
 *       "delete" = "Drupal\lotus\Form\LotusDeleteForm",
 *     }
 *   },
 *   config_prefix = "lotus",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/system/lotus/{lotus}",
 *     "delete-form" = "/admin/config/system/lotus/{lotus}/delete",
 *   }
 * )
 */
class Lotus extends ConfigEntityBase implements LotusInterface {

  /**
   * The lotus ID.
   *
   * @var string
   */
  public $id;

  /**
   * The lotus label.
   *
   * @var string
   */
  public $label;

  // Your specific configuration property get/set methods go here,
  // implementing the interface.
}
