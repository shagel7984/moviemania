<?php
namespace Drupal\custommodule\Entity;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\custommodule\Interfaces\MessageInterface;
/**
 * Defines the Default entity entity.
 *
 * @ingroup custommodule
 *
 * @ContentEntityType(
 *   id = "message",
 *   label = @Translation("Custommmessage entity"),
 *   base_table = "message",
 *   handlers = {
 *     "list_builder" = "Drupal\custommodule\Controller\MessageListBuilder",
 *     "access" = "\Drupal\entity\EntityAccessControlHandler",
 *     "permission_provider" = "\Drupal\entity\EntityPermissionProvider",
 *     "storage" = "\Drupal\custommodule\Storage\MessageStorage",
 *     "form" = {
 *       "default" = "Drupal\Core\Entity\ContentEntityForm",
 *       "add" = "Drupal\Core\Entity\ContentEntityForm",
 *       "edit" = "Drupal\Core\Entity\ContentEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider"
 *     },
 *   },
 *   entity_keys = {
 *     "id" = "message_id",
 *     "label" = "title",
 *     "langcode" = "langcode",
 *     "bundle" = "type",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/messages/{message}",
 *     "add-form" = "/admin/structure/messages/add",
 *     "edit-form" = "/admin/structure/messages/{message}/edit",
 *     "delete-form" = "/admin/structure/messages/{message}/delete",
 *     "collection" = "/admin/structure/messages",
 *   },
 *   admin_permission = "administer custommessage entity",
 *   permission_granularity = "bundle",
 *   bundle_entity_type = "message_type",
 *   fieldable = TRUE,
 *   field_ui_base_route = "entity.message_type.edit_form",
 * )
 */
class Message extends ContentEntityBase implements MessageInterface {
  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }
  /**
   * {@inheritdoc}
   */
  public function getMessage() {
    return $this->get('content')->value;
  }
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Default entity entity.'))
      ->setRevisionable(TRUE)
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRequired(TRUE)
      ->setTranslatable(TRUE)
      ->setRevisionable(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE);
    $fields['content'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Content'))
      ->setDescription(t('Content of the message'))
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'text_default',
        'weight' => 0,
      ))
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('form', array(
        'type' => 'text_textfield',
        'weight' => 0,
      ))
      ->setDisplayConfigurable('form', TRUE);


    $fields['type'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Message Type'))
      ->setDescription(t('The message tyoe'))
      ->setSetting('target_type', 'message_type')
      ->setSetting('max_length', EntityTypeInterface::BUNDLE_MAX_LENGTH);

    return $fields;
  }
}