<?php
namespace Drupal\custommodule\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 *
 * @FieldType(
 *   id = "realname",
 *   label = @Translation("Real name"),
 *   description = @Translation("This field stores a first and last name"),
 *   category = @Translation("General"),
 *   default_widget = "realname_default",
 *   default_formatter = "realname_one_line"
 * )
 */

//default_widget = "string_textfield",
//default_formatter = "string"

class RealName extends FieldItemBase{

  public static function schema(FieldStorageDefinitionInterface $field_definition)
  {
    return [
     'columns' => [
       'first_name' => [
         'description' => 'First name.',
         'type' => 'varchar',
         'length' => '255',
         'not null' => TRUE,
         'default' => ''
       ],
       'last_name' => [
         'description' => 'Last name.',
         'type' => 'varchar',
         'length' => '255',
         'not null' => TRUE,
         'default' => ''
       ],
     ],
     'indexes' => [
      'first_name' => ['first_name'],
      'last_name' => ['last_name']
     ]
    ];
  }


  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition)
  {
    $properties['first_name'] = DataDefinition::create('string');
    $properties['first_name']->setLabel('First Name');
    $properties['last_name'] = DataDefinition::create('string');
    $properties['last_name']->setLabel('Last Name');

    return $properties;
  }


}