<?php

namespace Drupal\customce\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Custom ce entities.
 *
 * @ingroup customce
 */
interface CustomCeInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Custom ce name.
   *
   * @return string
   *   Name of the Custom ce.
   */
  public function getName();

  /**
   * Sets the Custom ce name.
   *
   * @param string $name
   *   The Custom ce name.
   *
   * @return \Drupal\customce\Entity\CustomCeInterface
   *   The called Custom ce entity.
   */
  public function setName($name);

  /**
   * Gets the Custom ce creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Custom ce.
   */
  public function getCreatedTime();

  /**
   * Sets the Custom ce creation timestamp.
   *
   * @param int $timestamp
   *   The Custom ce creation timestamp.
   *
   * @return \Drupal\customce\Entity\CustomCeInterface
   *   The called Custom ce entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Custom ce published status indicator.
   *
   * Unpublished Custom ce are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Custom ce is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Custom ce.
   *
   * @param bool $published
   *   TRUE to set this Custom ce to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\customce\Entity\CustomCeInterface
   *   The called Custom ce entity.
   */
  public function setPublished($published);

  /**
   * Gets the Custom ce revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Custom ce revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\customce\Entity\CustomCeInterface
   *   The called Custom ce entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Custom ce revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Custom ce revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\customce\Entity\CustomCeInterface
   *   The called Custom ce entity.
   */
  public function setRevisionUserId($uid);

}
