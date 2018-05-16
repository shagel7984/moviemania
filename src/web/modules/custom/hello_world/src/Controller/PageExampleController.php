<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Drupal\hello_world\Utility\DescriptionTemplateTrait;
use Drupal\Core\Render\Element;

/**
 * Controller routines for page example routes.
 */
class PageExampleController extends ControllerBase {

  use DescriptionTemplateTrait;

  /**
   * {@inheritdoc}
   */
  protected function getModuleName() {
    return 'page_example';
  }

  /**
   * Constructs a simple page.
   *
   * The router _controller callback, maps the path
   * 'examples/page-example/simple' to this method.
   *
   * _controller callbacks return a renderable array for the content area of the
   * page. The theme system will later render and surround the content with the
   * appropriate blocks, navigation, and styling.
   */
  public function simple() {
    $class = get_class($this);
    $build = [
      'marquee' => [
        '#theme' => 'hello_world_marquee',
        '#content' => $this->t('Hello world xxxxxxxxxx!'),
        '#attributes' => [
          'class' => ['my-marquee-element'],
          'direction' => 'right',
        ],
      ],
      'cachedexample' => [
        '#markup' => $this->t('Drupal is the coolest *'),
        '#cache' => [
          'max-age' => \Drupal\Core\Cache\Cache::PERMANENT,
        ],
      ],
      'marquee1' => [
        '#type' => 'mymarquee',
      ],
      'test1' => [
        '#theme' => 'item_list',
        '#items' => [
          $this->t('test item 1'),
          $this->t('test item 2'),
        ],
        '#title' => 'My custom item list'
      ],
      'test2' => [
        '#theme' => 'hello_world_marquee',
        '#content' => $this->t('Hello world from custom theme hook marquee! im overridden by moviemania_preprocess_hello_world_marquee'),
        '#attributes' => [
          'class' => ['my-marquee-element'],
          'direction' => 'left',
        ],
      ],
      'test3' => [
        '#theme' => 'item_list',
        '#items' => [
          $this->t('test item 1'),
          $this->t('test item 2'),
        ],
        '#title' => 'My custom item list'
      ],
      'test4' => [
        '#theme' => 'hello_world_custom',
        '#content' => $this->t('Hello world CUSTOM!'),
        '#attributes' => [
          'class' => ['my-custom-element'],
          'direction' => 'left',
        ],
      ],
      'test5' => [
        '#markup' => $this->t('This item has a #pre_render callback.'),
        '#pre_render' => [
          [$class, 'customPreRender'],
        ],
      ],



    /*'test6' => [
      '#markup' => $this->t('This item has a #pre_render callback.'),
      '#pre_render' => [$this::class, ['argument1', 'argument2']]
    ]*/
    ];
    return $build;

  }


  public static function customPreRender($element) {
    $element['#markup'] = 'This item has a customPreRender callback';
    return $element;

  }

/*
  public function preRenderButton($element) {
    var_drump($element);
    return $element;
  }
*/
  /**
   * A more complex _controller callback that takes arguments.
   *
   * This callback is mapped to the path
   * 'examples/page-example/arguments/{first}/{second}'.
   *
   * The arguments in brackets are passed to this callback from the page URL.
   * The placeholder names "first" and "second" can have any value but should
   * match the callback method variable names; i.e. $first and $second.
   *
   * This function also demonstrates a more complex render array in the returned
   * values. Instead of rendering the HTML with theme('item_list'), content is
   * left un-rendered, and the theme function name is set using #theme. This
   * content will now be rendered as late as possible, giving more parts of the
   * system a chance to change it if necessary.
   *
   * Consult @link http://drupal.org/node/930760 Render Arrays documentation
   * @endlink for details.
   *
   * @param string $first
   *   A string to use, should be a number.
   * @param string $second
   *   Another string to use, should be a number.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
   *   If the parameters are invalid.
   */
  public function arguments($first, $second) {
    // Make sure you don't trust the URL to be safe! Always check for exploits.
    if (!is_numeric($first) || !is_numeric($second)) {
      // We will just show a standard "access denied" page in this case.
      throw new AccessDeniedHttpException();
    }

    $list[] = $this->t("First number was @number.", ['@number' => $first]);
    $list[] = $this->t("Second number was @number.", ['@number' => $second]);
    $list[] = $this->t('The total was @number.', ['@number' => $first + $second]);

    $render_array['page_example_arguments'] = [
      // The theme function to apply to the #items.
      '#theme' => 'item_list',
      // The list itself.
      '#items' => $list,
      '#title' => $this->t('Argument Information'),
    ];
    return $render_array;
  }

}
