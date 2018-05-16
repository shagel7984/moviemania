<?php
namespace Drupal\custom_content_entity\Entity;
use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Url;
use Drupal\custom_content_entity\Interfaces\ImporterInterface;

/**
 * Defines the Importer entity.
 *
 * @ConfigEntityType(
 *   id = "importer",
 *   label = @Translation("Importer"),
 *   handlers = {
 *     "list_builder" = "Drupal\custom_content_entity\Controller\ImporterListBuilder",
 *     "form" = {
 *       "add" = "Drupal\custom_content_entity\Form\ImporterForm",
 *       "edit" = "Drupal\custom_content_entity\Form\ImporterForm",
 *       "delete" = "Drupal\custom_content_entity\Form\ImporterDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "importer",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/importer/add",
 *     "edit-form" = "/admin/structure/importer/{importer}/edit",
 *     "delete-form" = "/admin/structure/importer/{importer}/delete",
 *     "collection" = "/admin/structure/importer"
 *   }
 * )
 */
class Importer extends ConfigEntityBase implements ImporterInterface {
  /**
   * The Importer ID.
   *
   * @var string
   */
  protected $id;
  /**
   * The Importer label.
   *
   * @var string
   */
  protected $label;
  /**
   * @var string
   */
  protected $url;
  /**
   * The plugin ID of the plugin to be used for processing this import.
   *
   * @var string
   */
  protected $plugin;

  /**
   * Whether or not to update existing products if they have already been imported.
   *
   * @var bool
   */
  protected $update_existing = TRUE;
  /**
   * The source of the products.
   *
   * @var string
   */
  protected $source;
  /**
   * The product bundle.
   *
   * @var string
   */
  protected $bundle;

  /**
   * {@inheritdoc}
   */
  public function getUrl(){
    return $this->url ? Url::fromUri($this->url) : NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function getPluginId() {
    return $this->plugin;
  }

  /**
   * {@inheritdoc}
   */
  public function updateExisting() {
    return $this->update_existing;
  }

  /**
   * {@inheritdoc}
   */
  public function getSource() {
    return $this->source;
  }

  /**
   * {@inheritdoc}
   */
  public function getBundle() {
    return $this->bundle;
  }

}