<?php

namespace Drupal\customce;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface CustomCeStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Custom ce revision IDs for a specific Custom ce.
   *
   * @param \Drupal\customce\Entity\CustomCeInterface $entity
   *   The Custom ce entity.
   *
   * @return int[]
   *   Custom ce revision IDs (in ascending order).
   */
  public function revisionIds(CustomCeInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Custom ce author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Custom ce revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\customce\Entity\CustomCeInterface $entity
   *   The Custom ce entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(CustomCeInterface $entity);

  /**
   * Unsets the language for all Custom ce with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
