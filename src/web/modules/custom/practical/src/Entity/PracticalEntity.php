<?php

namespace Drupal\practical\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the Practical entity.
 *
 * @ContentEntityType(
 *   id = "practical",
 *   label = @Translation("Practical"),
 *   base_table = "practical",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "bundle",
 *     "uid" = "uid",
 *     "label" = "name",
 *     "created" = "created",
 *     "changed" = "changed",
 *   },
 *   fieldable = TRUE,
 *   admin_permission = "administer practical types",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\practical\PracticalListBuilder",
 *     "access" = "Drupal\practical\PracticalEntityAccessControlHandler",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\practical\Form\PracticalEntityForm",
 *       "add" = "Drupal\practical\Form\PracticalEntityForm",
 *       "edit" = "Drupal\practical\Form\PracticalEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/practical/{practical}",
 *     "add-page" = "/practical/add",
 *     "add-form" = "/practical/add/{practical_type}",
 *     "edit-form" = "/practical/{practical}/edit",
 *     "delete-form" = "/practical/{practical}/delete",
 *     "collection" = "/admin/content/practicals",
 *   },
 *   bundle_entity_type = "practical_type",
 *   field_ui_base_route = "entity.practical_type.edit_form",
 * )
 */
class PracticalEntity extends ContentEntityBase implements PracticalEntityInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('uid')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('uid')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('uid', $account->id());
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('uid', $uid);
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Practical entity.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
       ->setLabel(t('Name'))
       ->setDescription(t('The name of the Practical entity.'))
       ->setSettings([
         'max_length' => 50,
         'text_processing' => 0,
       ])
       ->setDefaultValue('')
       ->setDisplayOptions('view', [
         'label' => 'hidden',
         'type' => 'string',
         'weight' => -4,
       ])
       ->setDisplayOptions('form', [
         'type' => 'string_textfield',
         'weight' => -4,
       ])
       ->setDisplayConfigurable('form', TRUE)
       ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'uid' => \Drupal::currentUser()->id(),
    ];
  }

}
