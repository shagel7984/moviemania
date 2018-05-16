<?php
namespace Drupal\custom_content_entity\Entity;
use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\custom_content_entity\Interfaces\ProductTypeInterface;

/**
 * Product type configuration entity type.
 *
 * @ConfigEntityType(
 *   id = "product_type",
 *   label = @Translation("Product type"),
 *   handlers = {
 *     "list_builder" = "Drupal\custom_content_entity\Controller\ProductTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\custom_content_entity\Form\ProductTypeForm",
 *       "edit" = "Drupal\custom_content_entity\Form\ProductTypeForm",
 *       "delete" = "Drupal\custom_content_entity\Form\ProductTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "product_type",
 *   bundle_of = "product",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/product_type/{product_type}",
 *     "add-form" = "/admin/structure/product_type/add",
 *     "edit-form" = "/admin/structure/product_type/{product_type}/edit",
 *     "delete-form" = "/admin/structure/product_type/{product_type}/delete",
 *     "collection" = "/admin/structure/producttypelist"
 *   }
 * )
 */
class ProductType extends ConfigEntityBundleBase implements ProductTypeInterface {
  /**
   * The Product type ID.
   *
   * @var string
   */
  protected $id;
  /**
   * The Product type label.
   *
   * @var string
   */
  protected $label;
}