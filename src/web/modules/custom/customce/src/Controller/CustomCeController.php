<?php

namespace Drupal\customce\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\customce\Entity\CustomCeInterface;

/**
 * Class CustomCeController.
 *
 *  Returns responses for Custom ce routes.
 */
class CustomCeController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Custom ce  revision.
   *
   * @param int $custom_ce_revision
   *   The Custom ce  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($custom_ce_revision) {
    $custom_ce = $this->entityManager()->getStorage('custom_ce')->loadRevision($custom_ce_revision);
    $view_builder = $this->entityManager()->getViewBuilder('custom_ce');

    return $view_builder->view($custom_ce);
  }

  /**
   * Page title callback for a Custom ce  revision.
   *
   * @param int $custom_ce_revision
   *   The Custom ce  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($custom_ce_revision) {
    $custom_ce = $this->entityManager()->getStorage('custom_ce')->loadRevision($custom_ce_revision);
    return $this->t('Revision of %title from %date', ['%title' => $custom_ce->label(), '%date' => format_date($custom_ce->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Custom ce .
   *
   * @param \Drupal\customce\Entity\CustomCeInterface $custom_ce
   *   A Custom ce  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(CustomCeInterface $custom_ce) {
    $account = $this->currentUser();
    $langcode = $custom_ce->language()->getId();
    $langname = $custom_ce->language()->getName();
    $languages = $custom_ce->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $custom_ce_storage = $this->entityManager()->getStorage('custom_ce');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $custom_ce->label()]) : $this->t('Revisions for %title', ['%title' => $custom_ce->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all custom ce revisions") || $account->hasPermission('administer custom ce entities')));
    $delete_permission = (($account->hasPermission("delete all custom ce revisions") || $account->hasPermission('administer custom ce entities')));

    $rows = [];

    $vids = $custom_ce_storage->revisionIds($custom_ce);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\customce\CustomCeInterface $revision */
      $revision = $custom_ce_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $custom_ce->getRevisionId()) {
          $link = $this->l($date, new Url('entity.custom_ce.revision', ['custom_ce' => $custom_ce->id(), 'custom_ce_revision' => $vid]));
        }
        else {
          $link = $custom_ce->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.custom_ce.translation_revert', ['custom_ce' => $custom_ce->id(), 'custom_ce_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.custom_ce.revision_revert', ['custom_ce' => $custom_ce->id(), 'custom_ce_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.custom_ce.revision_delete', ['custom_ce' => $custom_ce->id(), 'custom_ce_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['custom_ce_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
