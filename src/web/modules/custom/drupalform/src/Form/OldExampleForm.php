<?php
/**
 * @file
 * Contains \Drupal\drupalform\Form\ExampleForm
 */
namespace Drupal\drupalform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class OldExampleForm extends FormBase {

  public function getFormId()
  {
    return 'durpalform_example_form_old';
  }

  public function buildForm(array $form, FormStateInterface $form_state)
  {
    // Adding multiple validation handlers
    /*$form_state->setValidateHandlers([
      ['::validateForm'],
      ['::method1'],
      [$this,'method2']
    ]);*/

    $form['company_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Company name')
    ];
    /*
        $form['phone'] = [
          '#type' => 'tel',
          '#title' => $this->t('Phone')
        ];

        $form['email'] = [
          '#type' => 'email',
          '#title' => $this->t('Email')
        ];

        $form['integer'] = [
          '#type' => 'number',
          '#title' => $this->t('Some integer'),
          '#step' => 1,
          '#min' => 0,
          '#max' => 100
        ];

        $form['date'] = [
          '#type' => 'date',
          '#title' => $this->t('Date'),
          '#date_date_format' => 'Y-m-d'
        ];

        $form['website'] = [
          '#type' => 'url',
          '#title' => $this->t('Website')
        ];

        $form['search'] = [
          '#type' => 'search',
          '#title' => $this->t('Search'),
          '#autocomplete_route_name' => FALSE
        ];

        $form['range'] = [
          '#type' => 'range',
          '#title' => $this->t('Range'),
          '#min' => 0,
          '#max' => 100,
          '#step' => 1
        ];
    */
    $form['submit'] = [
      '#type' => 'submit',
      '#title' => $this->t('Save')
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    // TODO: Implement submitForm() method.
  }

  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    if(!$form_state->isValueEmpty('company_name')){
      if(strlen($form_state->getValue('company_name')) <= 5){
        $form_state->setErrorByName('company_name', t('Company name is less than 5 characters'));
      }
    }
  }
  /*
  public static function method1(array &$form, FormStateInterface $form_state){
    if(!$form_state->isValueEmpty('company_name')){
      if(strlen($form_state->getValue('company_name')) <= 5){
        $form_state->setErrorByName('company_name', t('Company name is less than 5 characters'));
      }
    }
  }
  public static function method2(array &$form, FormStateInterface $form_state){
    var_dump($form_state);
  }
  */
}