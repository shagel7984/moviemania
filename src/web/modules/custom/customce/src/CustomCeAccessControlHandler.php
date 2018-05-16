<?php

namespace Drupal\customce;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Custom ce entity.
 *
 * @see \Drupal\customce\Entity\CustomCe.
 */
class CustomCeAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\customce\Entity\CustomCeInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished custom ce entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published custom ce entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit custom ce entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete custom ce entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add custom ce entities');
  }

}
