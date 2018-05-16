<?php
/**
 * @file
 * Contains \Drupal\drupalform\Form\ExampleConfigForm
 */
namespace Drupal\drupalform\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ExampleConfigForm extends ConfigFormBase {

  public function getFormId()
  {
    return 'durpalform_example_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['company_name'] = [
      '#type' => 'textfield',
      '#title' => t('Company name'),
      '#default_value' => $this->config('drupalform.company')->get('company_name')
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    parent::submitForm($form, $form_state);
    $config = $this->config('drupalform.company');
    $config->set('company_name',$form_state->getValue('company_name'));
    $config->save();
  }

  protected function getEditableConfigNames()
  {
    return ['drupalform.company'];
  }

}