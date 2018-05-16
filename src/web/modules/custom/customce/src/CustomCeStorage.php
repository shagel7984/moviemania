<?php

namespace Drupal\customce;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\customce\Entity\CustomCeInterface;

/**
 * Defines the storage handler class for Custom ce entities.
 *
 * This extends the base storage class, adding required special handling for
 * Custom ce entities.
 *
 * @ingroup customce
 */
class CustomCeStorage extends SqlContentEntityStorage implements CustomCeStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(CustomCeInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {custom_ce_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {custom_ce_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(CustomCeInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {custom_ce_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('custom_ce_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
