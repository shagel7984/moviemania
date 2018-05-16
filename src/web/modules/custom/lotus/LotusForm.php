<?php

namespace Drupal\lotus\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form handler for the lotus add and edit forms.
 */
class LotusForm extends EntityForm {

  protected $entityQuery;

  protected $entityManager;

  /**
   * Constructs an lotusForm object.
   *
   * @param \Drupal\Core\Entity\Query\QueryFactory $entity_query
   *   The entity query.
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity Manager.
   */
  public function __construct(QueryFactory $entity_query, EntityManagerInterface $entity_manager) {
    $this->entityQuery = $entity_query;
    $this->entityManager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.query'),
      $container->get('entity.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $lotus = $this->entity;

    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $lotus->label(),
      '#description' => $this->t("Label for the lotus."),
      '#required' => TRUE,
    );
    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $lotus->id(),
      '#machine_name' => array(
        'exists' => array($this, 'exist'),
      ),
      '#disabled' => !$lotus->isNew(),
    );

    $content_types = $this->entityManager->getStorage('node_type')->loadMultiple();
    $content_types_list = [];
    foreach ($content_types as $content_type) {
      $content_types_list[$content_type->id()] = $content_type->label();
    }

    $form['content_type'] = array(
      '#type' => 'select',
      '#default_value' => $lotus->get('content_type'),
      '#description' => $this->t('Select content type to add Email Address'),
      '#required' => TRUE,
      '#options' => $content_types_list,
    );

    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#maxlength' => 255,
      '#default_value' => $lotus->get('email'),
      '#description' => $this->t("Enter email address to send notifications"),
      '#required' => TRUE,
    );

    // You will need additional form elements for your custom properties.
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $lotus = $this->entity;
    $status = $lotus->save();

    if ($status) {
      drupal_set_message($this->t('Saved the %label lotus.', array(
        '%label' => $lotus->label(),
      )));
    }
    else {
      drupal_set_message($this->t('The %label lotus was not saved.', array(
        '%label' => $lotus->label(),
      )));
    }

    $form_state->setRedirect('entity.lotus.collection');
  }

  /**
   * Helper function to check whether an lotus configuration entity exists.
   */
  public function exist($id) {
    $entity = $this->entityQuery->get('lotus')
      ->condition('id', $id)
      ->execute();
    return (bool) $entity;
  }

}
