<?php

namespace Drupal\hbm_privacy\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\StateInterface;
use Drupal\hbm_privacy\HbmServices\HbmPrivacyService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class HbmPrivacyConfigForm.
 *
 * @package Drupal\hbm_privacy\Form
 *
 * Provides a configuration form to save the privacy url an.
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
   *
   * @param Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   Drupal\Core\Config\ConfigFactoryInterface $config_factory.
   * @param Drupal\Core\State\StateInterface $state
   *   Drupal\Core\State\StateInterface $state.
   * @param Drupal\hbm_privacy\HbmServices\HbmPrivacyService $hbmPrivacyService
   *   Drupal\hbm_privacy\HbmServices\HbmPrivacyService $hbmPrivacyService.
   */
  public function __construct(ConfigFactoryInterface $config_factory, StateInterface $state, HbmPrivacyService $hbmPrivacyService) {
    parent::__construct($config_factory);
    $this->state = $state;
    $this->hbmPrivacyService = $hbmPrivacyService;
  }

  /**
   * Function create()
   *
   * @inheritdoc
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('state'),
      $container->get('hbm_privacy.hbmprivacyservice')
    );
  }

  /**
   * Function getFormId().
   *
   * @inheritdoc
   */
  public function getFormId() {
    return 'hbm_privacy_form';
  }

  /**
   * Function getEditableConfigNames().
   *
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return [
      'hbm_privacy.settings',
    ];
  }

  /**
   * Function buildForm().
   *
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hbm_privacy.settings');

    $form['status'] = [
      '#type' => 'details',
      '#title' => $this->t('HBM Service status information'),
      '#open' => TRUE,
    ];

    $statusMessage = $this->state->get('hbm_privacy_service.statusmessage');
    $statusMessage = !empty($statusMessage) ? $statusMessage : 'no status info available yet';

    $args = [
      '%statusMessage' => $statusMessage,
    ];

    $form['status']['last'] = [
      '#type' => 'item',
      '#markup' => $this->t('HBM Service: %statusMessage', $args),
    ];

    /* Manual HBM Privacy Information Update Button */
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

    $form['privacy_page_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('HBM Privacy Page Link (z.B. datenschutz)'),
      '#default_value' => $config->get('privacy_page_link'),
    ];

    $form['privacy_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('HBM Privacy Url (z.B. https://cdn.datenschutz.burda.com/ID.json)'),
      '#default_value' => $config->get('privacy_url'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Function validateForm().
   *
   * @inheritdoc
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    /* Checks if the privacy page link is not empty and if the link not already exists */
    if ($form_state->isValueEmpty('privacy_page_link')) {
      $form_state->setErrorByName('privacy_page_link', t('the privay url must not be empty'));
    }
    else {
      $routePath = '/' . $form_state->getValue('privacy_page_link');
      $url_object = \Drupal::service('path.validator')->getUrlIfValid($routePath);

      if ($url_object) {
        $route_name = $url_object->getRouteName();
        if ($route_name !== 'hbm_privacy.route') {
          $form_state->setErrorByName('privay_page_link', t('The HBM the route already exists'));
        }
      }
    }

    /* Checks if the privacy url field is not empty and if it is a valid url */
    if ($form_state->isValueEmpty('privacy_url')) {
      $form_state->setErrorByName('privay_url', t('the privay url must not be empty'));
    }
    else {
      if (!$this->is_url($form_state->getValue('privacy_url'))) {
        $form_state->setErrorByName('privay_url', t('The HBM privacy url must start with http or https and has to be a valid url'));
      }
    }

  }

  /**
   * Check if entered value is a valid url.
   */
  private function is_url($uri) {
    if (preg_match('/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' , $uri)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  /**
   * UpdatePrivacyInformation - executes the hbmPrivacyService->getPrivacyData()
   */
  public function updatePrivacyInformation() {
    $statusMessage = $this->hbmPrivacyService->getPrivacyData();
    drupal_set_message($statusMessage['lastExecutionTime'] . ' - ' . $statusMessage['status']);
  }

  /**
   * Function submitForm().
   *
   * @inheritdoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    /* Retrieve the configuration */
    $this->configFactory->getEditable('hbm_privacy.settings')
      /* Set the submitted configuration setting */
      ->set('privacy_url', $form_state->getValue('privacy_url'))
      ->set('privacy_page_link', $form_state->getValue('privacy_page_link'))
      ->save();

    parent::submitForm($form, $form_state);

    \Drupal::service("router.builder")->rebuild();
  }

}
