<?php
/**
 * @file Contains \Drupal\custommodule\Controller\MessageListBuilder
 */
namespace Drupal\custommodule\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

class MessageListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Default entity ID');
    $header['label'] = $this->t('Label');
    $header['name'] = $this->t('Name');
    $header['content'] = $this->t('Content');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\default_content_entity_module\Entity\DefaultEntity */
    $row['id'] = $entity->id();
    $row['label'] = $entity->label();
    //$row['name'] = $entity->getName();


    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.message.edit_form',
      ['message' => $entity->id()]
    );

    $row['content'] = $entity->getMessage();
    return $row + parent::buildRow($entity);
  }


}