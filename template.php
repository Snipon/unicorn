<?php
/**
 * Order of function types:
 * - Custom functions
 * - Preprocess functions
 * - Theme functions
 */

/**
 * Generic function that modifies some variables in all unicorn layouts.
 */
function unicorn_check_layout_variables(&$vars) {
  $vars['css_id'] = strtr($vars['css_id'], '_', '-');
}

/**
 * Implementation of template_preprocess_html
 */
function unicorn_preprocess_html(&$variables){
  // Check if overlay is activated.
  if (theme_get_setting('unicorn_show_overlay')) {
    // Extract and put back the body classes.
    $variables['classes_array'][] = 'show-grid';
    $variables['classes'] = implode(' ', $variables['classes_array']);
    // Add the overlay css to the page.
    $styles = (drupal_add_css(drupal_get_path('theme', 'unicorn') . '/styles/unicorn.debug.css'));
    $variables['css'] = $styles;
    $variables['styles'] = drupal_get_css($variables['css']);
  }

  // Add boostrap js files
  if(theme_get_setting('unicorn_enable_bootstrap')) {
    foreach (theme_get_setting('unicorn_enable_bootstrap') as $row) {
      if ($row) {
        drupal_add_js(drupal_get_path('theme', 'unicorn') . '/js/vendor/bootstrap/' . $row . '.js');
      }
    }
  }

  $element = array();

  // Set charset
  $element[] = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'charset',
      'content' => 'utf-8',
    ),
  );

  // Set device zoom
  $element[] = array (
    '#tag' => 'meta',
    '#attributes' => array (
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes',
    ),
  );
  $i = 0;

  // Loop through the elements and add them to head
  foreach ($element as $row) {
    $i ++;
    drupal_add_html_head($row, 'unicorn-' . $i);
  }
}

/**
 * Changes the search form to use the HTML5 "search" input attribute.
 */
function unicorn_preprocess_search_block_form(&$vars) {
  $vars['search_form'] = str_replace('type="text"', 'type="search"', $vars['search_form']);
}

/**
 * Implementation of template_preprocess_panels_pane
 */
function unicorn_preprocess_panels_pane(&$variables) {
  // Wrap site name pane with some markup
  if($variables['pane']->type == 'page_site_name') {
    $variables['content'] = '<h1 class="site-name">' . l($variables['content'], '') . '</h1>';
  }
}

/**
 * Implementation of theme_panels_default_style_render_region().
 */
function unicorn_panels_default_style_render_region($vars) {
  return implode($vars['panes']);
}

/**
 * Implementation of theme_status_messages
 */
function unicorn_status_messages(&$variables) {
  $display = $variables['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
  );

  // Change message types to bootstrap types
  $bs_type = '';
  foreach (drupal_get_messages($display) as $type => $messages) {
    switch ($type) {
      case 'status':
        $bs_type = 'alert-success';
        break;
      case 'warning':
        $bs_type = 'alert-info';
        break;
      case 'error':
        $bs_type = 'alert-error';
        break;
    }

    $output .= "<div class=\"alert $bs_type\">\n";
    if (!empty($status_heading[$type])) {
      $output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
    }
    if (count($messages) > 1) {
      foreach ($messages as $message) {
        $output .= '<div class="message">' . $message . "</div>\n";
      }
    }
    else {
      $output .= $messages[0];
    }
    $output .= "</div>\n";
  }
  return $output;
}

/**
 * Implementation of theme_menu_local_tasks
 */
function unicorn_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="nav nav-tabs primary">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="nav nav-pills secondary">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }

  return $output;
}

/**
 * Implementation of theme_button
 */
function unicorn_button(&$variables) {
  // Add twitter bootstrap button class
  $variables['element']['#attributes']['class'][] = 'btn';

  if (in_array('delete', $variables['element']['#parents'])) {
    $variables['element']['#attributes']['class'][] = 'btn-warning';
  }

  return theme_button($variables);
}

/**
 * Implementation of theme_pager
 */
function unicorn_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next ›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));

  $items = array();

  if ($pager_total[$element] > 1) {
    if ($li_first) {
      $items[] = array(
        'class' => array('pager-first'),
        'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
        'class' => array('pager-previous'),
        'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => array('active'),
            'data' => '<a>' . $i . '</a>',
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('pager-next'),
        'data' => $li_next,
      );
    }
    if ($li_last) {
      $items[] = array(
        'class' => array('pager-last'),
        'data' => $li_last,
      );
    }
    return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . '<div class="pagination pagination-centered">' . theme('item_list', array(
      'items' => $items,
    )) . '</div>';
  }
}
