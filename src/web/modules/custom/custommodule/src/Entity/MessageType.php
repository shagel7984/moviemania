<?php
namespace Drupal\custommodule\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\custommodule\Interfaces\MessageTypeInterface;

/**
 * Defines the message type entity class.
 *
 * @ConfigEntityType(
 *   id = "message_type",
 *   label = @Translation("Message type"),
 *   handlers = {
 *     "list_builder" = "Drupal\custommodule\Controller\MessageTypeListBuilder",
 *     "storage" = "\Drupal\custommodule\Storage\MessageTypeStorage",
 *     "form" = {
 *       "default" = "Drupal\Core\Entity\EntityForm",
 *       "add" = "Drupal\custommodule\Form\MessageTypeEntityForm",
 *       "edit" = "Drupal\custommodule\Form\MessageTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "message_type",
 *   bundle_of = "message",
 *   admin_permission = "administer messages",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/message-types/add",
 *     "delete-form" = "/admin/structure/message-types/{message_type}/delete",
 *     "edit-form" = "/admin/structure/message-types/{message_type}",
 *     "admin-form" = "/admin/structure/message-types/{message_type}",
 *     "collection" = "/admin/structure/message-types"
 *   }
 * )
 */
class MessageType extends ConfigEntityBundleBase {


}