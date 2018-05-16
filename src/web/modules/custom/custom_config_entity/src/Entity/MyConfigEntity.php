<?php

namespace Drupal\custom_config_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\custom_config_entity\Interfaces\MyConfigEntityInterface;

/**
 * Defines the myconfigentity.
 *
 * The lines below, starting with '@ConfigEntityType,' are a plugin annotation.
 * These define the entity type to the entity type manager.
 *
 * The properties in the annotation are as follows:
 *  - id: The machine name of the entity type.
 *  - label: The human-readable label of the entity type. We pass this through
 *    the "@Translation" wrapper so that the multilingual system may
 *    translate it in the user interface.
 *  - handlers: An array of entity handler classes, keyed by handler type.
 *    - access: The class that is used for access checks.
 *    - list_builder: The class that provides listings of the entity.
 *    - form: An array of entity form classes keyed by their operation.
 *  - entity_keys: Specifies the class properties in which unique keys are
 *    stored for this entity type. Unique keys are properties which you know
 *    will be unique, and which the entity manager can use as unique in database
 *    queries.
 *  - links: entity URL definitions. These are mostly used for Field UI.
 *    Arbitrary keys can set here. For example, User sets cancel-form, while
 *    Node uses delete-form.
 *
 * @see http://previousnext.com.au/blog/understanding-drupal-8s-config-entities
 * @see annotation
 * @see Drupal\Core\Annotation\Translation
 *
 * @ingroup custom_config_entity
 *
 * @ConfigEntityType(
 *   id = "myconfigentity",
 *   label = @Translation("My Config Entity"),
 *   admin_permission = "administer site configuration",
 *   handlers = {
 *     "list_builder" = "Drupal\custom_config_entity\Controller\MyConfigEntityListBuilder",
 *     "form" = {
 *       "default" = "Drupal\custom_config_entity\Form\MyConfigEntityForm",
 *       "add" = "Drupal\custom_config_entity\Form\MyConfigEntityForm",
 *       "edit" = "Drupal\custom_config_entity\Form\MyConfigEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     },
 *     "route_provider" =  {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider"
 *     },
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/custom-config-entity/{myconfigentity}",
 *     "add-form" =  "/admin/structure/custom-config-entity/add",
 *     "edit-form" = "/admin/structure/custom-config-entity/{myconfigentity}/edit",
 *     "delete-form" = "/admin/structure/custom-config-entity/{myconfigentity}/delete",
 *     "collection" = "/admin/structure/custom-config-entity/collection"
 *   }
 * )
 */
class MyConfigEntity extends ConfigEntityBase implements MyConfigEntityInterface{

  /**
   * The myconfigentity ID.
   *
   * @var string
   */
  public $id;

  /**
   * The myconfigentity UUID.
   *
   * @var string
   */
  public $uuid;

  /**
   * The myconfigentity label.
   *
   * @var string
   */
  public $label;

  /**
   * The myconfigentity floopy flag.
   *
   * @var string
   */
  protected $floopy;

  /**
   * Gets the floppy value
   * @return boolean
   */
  public function getFloppy()
  {
    return $this->floopy;
  }
}
