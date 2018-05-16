<?php

namespace Drupal\hbm_privacy\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\StateInterface;
use Drupal\hbm_privacy\HbmServices\HbmPrivacyService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class HbmPrivacyConfigForm
 * @package Drupal\hbm_privacy\Form
 * provides a configuration form to save the privacy url an
 */
class HbmPrivacyConfigForm extends ConfigFormBase {

  /**
   * The state keyvalue collection.
   *
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * The state keyvalue collection.
   *
   * @var \Drupal\hbm_privacy\HbmServices\HbmPrivacyService
   */
  protected $hbmPrivacyService;

  /**
   * HbmPrivacyConfigForm constructor.
   * @param ConfigFactoryInterface $config_factory
   * @param StateInterface $state
   * @param HbmPrivacyService $hbmPrivacyService
   */
  public function __construct(ConfigFactoryInterface $config_factory, StateInterface $state, HbmPrivacyService $hbmPrivacyService){
    parent::__construct($config_factory);
    $this->state = $state;
    $this->hbmPrivacyService = $hbmPrivacyService;

  }

  /**
   * @param ContainerInterface $container
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('state'),
      $container->get('hbm_privacy.hbmprivacyservice')
    );
  }

  /**
   * @return string
   */
  public function getFormId() {
    return 'hbm_privacy_form';
  }

  /**
   * @return array
   */
  protected function getEditableConfigNames() {
    return [
      'hbm_privacy.settings',
    ];
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hbm_privacy.settings');

    $form['status'] = [
      '#type' => 'details',
      '#title' => $this->t('HBM Service status information'),
      '#open' => TRUE,
    ];

    $statusMessage = \Drupal::state()->get('hbm_privacy_service.statusmessage');
    $statusMessage = !empty($statusMessage) ? $statusMessage : 'no status info available yet';

    $args = [
      '%statusMessage' => $statusMessage
    ];

    $form['status']['last'] = [
      '#type' => 'item',
      '#markup' => $this->t('HBM Service: %statusMessage', $args),
    ];

    /**
     * Manual HBM Privacy Information Update Button
     */
    $form['hbm_privacy_information_update'] = [
      '#type' => 'details',
      '#title' => $this->t('Update privacy information'),
      '#open' => TRUE,
    ];

    $form['hbm_privacy_information_update']['hbm_privacy_information_update_trigger']['actions'] = ['#type' => 'actions'];
    $form['hbm_privacy_information_update']['hbm_privacy_information_update_trigger']['actions']['sumbit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Update privacy information now'),
      '#submit' => [[$this, 'updatePrivacyInformation']],
    ];

    $form['privacy_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('HBM privacy url'),
      '#default_value' => $config->get('privacy_url'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * Checks if the privacy url is not empty
   * and if its starts with http:// or https://
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {

    if($form_state->isValueEmpty('privacy_url')){
      $form_state->setErrorByName('privay_url', t('the privay url must not be empty'));
    }else{
      if (!$this->is_url($form_state->getValue('privacy_url'))){
        $form_state->setErrorByName('privay_url', t('The HBM privacy url must start with http or https and has to be a valid url'));
      }
    }
  }

  /**
   * Check if entered value is a valid url
   */
  private function is_url($uri){
    if(preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$uri)){
      return true;
    }
    else{
      return false;
    }
  }

  /**
   * updatePrivacyInformation - executes the hbmPrivacyService->getPrivacyData()
   */
  public function updatePrivacyInformation() {
    $statusMessage = $this->hbmPrivacyService->getPrivacyData();
    drupal_set_message($statusMessage['lastExecutionTime'] .' - '. $statusMessage['status']);
  }


  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // Retrieve the configuration
    $this->configFactory->getEditable('hbm_privacy.settings')
      // Set the submitted configuration setting
      ->set('privacy_url', $form_state->getValue('privacy_url'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
