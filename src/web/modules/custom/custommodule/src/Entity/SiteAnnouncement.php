<?php
namespace Drupal\custommodule\Entity;


use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\custommodule\SiteAnnouncementInterface;


/**
 * Class SiteAnnouncement
 * @package Drupal\custommodule\Entity
 *
 * @ConfigEntityType(
 *   id = "announcement",
 *   label = @Translation("Site Announcement"),
 *   handlers = {
 *     "list_builder" = "Drupal\custommodule\Controller\SiteAnnouncementListBuilder",
 *     "form" = {
 *       "default" = "Drupal\custommodule\Form\SiteAnnouncementForm",
 *       "add" = "Drupal\custommodule\Form\SiteAnnouncementForm",
 *       "edit" = "Drupal\custommodule\Form\SiteAnnouncementForm",
 *       "delete" = "Drupal\custommodule\Form\SiteAnnouncementDeleteForm",
 *     }
 *   },
 *   config_prefix = "announcement",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *    "id" = "id",
 *    "label" = "label"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/system/site-announcements/{announcement}",
 *     "delete-form" = "/admin/config/system/site-announcements/{announcement}/delete",
 *   },
 *   config_export = {
 *    "id",
 *    "label",
 *    "message"
 *   }
 * )
 *
 */


class SiteAnnouncement extends ConfigEntityBase implements SiteAnnouncementInterface{

  /**
   * The Example ID.
   *
   * @var string
   */
  public $id;

  /**
   * The Example label.
   *
   * @var string
   */
  public $label;

  /**
   * @return string
   */
  protected $message;

  public function getMessage()
  {
    return $this->message;
  }
}