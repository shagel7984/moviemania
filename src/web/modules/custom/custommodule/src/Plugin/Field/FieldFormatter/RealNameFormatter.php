<?php
namespace Drupal\custommodule\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 *
 * @FieldFormatter(
 *  id = "realname_one_line",
 *  label = @Translation("Real name (one line)"),
 *   field_types = {
 *     "realname"
 *   }
 * )
 *
 */

class RealNameFormatter extends FormatterBase {
  public function viewElements(FieldItemListInterface $items, $langcode)
  {
    $element = [];

    foreach($items as $delta => $item){
      $element[$delta] = [
        '#markup' => $this->t('@first @last',[
          '@first' => $item->first_name,
          '@last' => $item->last_name
        ])
      ];
    }

    return $element;
  }
}