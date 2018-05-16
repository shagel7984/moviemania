<?php
namespace Drupal\custom_content_entity\Plugin\Importer;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\custom_content_entity\Entity\ImporterInterface;
use Drupal\custom_content_entity\Entity\ProductInterface;
use Drupal\custom_content_entity\Plugin\ImporterBase;
/**
 * Product importer from a JSON format.
 *
 * @Importer(
 *   id = "json",
 *   label = @Translation("JSON Importer")
 * )
 */
class JsonImporter extends ImporterBase {
  use StringTranslationTrait;
  /**
   * {@inheritdoc}
   */
  public function import() {
    $data = $this->getData();
    if (!$data) {
      return FALSE;
    }
    if (!isset($data->products)) {
      return FALSE;
    }
    $products = $data->products;
    foreach($products as $product){
      $this->persistProduct($product);
    }
    /*$batch = [
      'title' => $this->t('Importing products'),
      'operations' => [
        [[$this, 'clearMissing'], [$products]],
        [[$this, 'importProducts'], [$products]],
      ],
      'finished' => [$this, 'importProductsFinished'],
    ];
    batch_set($batch);
    if (PHP_SAPI == 'cli') {
      drush_backend_batch_process();
    }*/
    return TRUE;
  }


  private function getData(){
    $config = $this->configuration['config'];
    $request = $this->httpClient->get($config->getUrl()->toString());
    $string = $request->getBody()->getContents();

    return json_decode($string);
  }

  private function persistProduct($data){
    $config = $this->configuration['config'];
    $existing = $this->entityTypeManager->getStorage(
      'product')->loadByProperties([
        'remote_id' => $data->id,
        'source' => $config->getSource()
    ]);

    if(!$existing){
      $values = [
        'remote_id' => $data->id,
        'source' => $config->getSource(),
        'type' => $config->getBundle(),
       ];

      $product = $this->entityTypeManager->getStorage('product')->create($values);
      $product->setName($data->name);
      $product->setProductNumber($data->number);
      $product->save();

      return;
    }

    if(!$config->updateExisting()){
      return;
    }

    $product = reset($existing);
    $product->setName($data->name);
    $product->setProductNumber($data->number);
    $product->save();

  }
}