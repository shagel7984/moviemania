<?php
namespace Drupal\custom_content_entity\Plugin;

use Drupal\Component\Plugin\Exception\PluginException;
use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\custom_content_entity\Plugin\ImporterInterface as ImporterPluginInterface;


abstract class ImporterBase extends PluginBase implements ImporterPluginInterface , ContainerFactoryPluginInterface{

  /**
   * @var \Drupal\Core\Entity
   */
  protected $entityTypeManager;

  /**
   * @var \GuzzleHttp\Client
   */
    protected $httpClient;

    public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManager $entityTypeManager, Client $httpClient){

      parent::__construct($configuration, $plugin_id, $plugin_definition);
      $this->entityTypeManager = $entityTypeManager;
      $this->httpClient = $httpClient;

      if (!isset($configuration['config'])){
        throw new PluginException('Missing Importer Configuration');
      }

      if (!$configuration['config'] instanceof \Drupal\custom_content_entity\Interfaces\ImporterInterface) {
        throw new PluginException('Wrong Importer configuration.');
      }
    }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('http_client')
    );
  }

}