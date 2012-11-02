<?php
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
        $output .= '  <div>' . $message . "</div>\n";
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
 * Changes the search form to use the HTML5 "search" input attribute.
 */
function unicorn_preprocess_search_block_form(&$vars) {
  $vars['search_form'] = str_replace('type="text"', 'type="search"', $vars['search_form']);
}

/**
 * Implementation of theme_panels_default_style_render_region().
 */
function unicorn_panels_default_style_render_region($vars) {
  return implode($vars['panes']);
}

/**
 * Generic function that modifies some variables in all unicorn layouts.
 */
function unicorn_check_layout_variables(&$vars) {
  $vars['css_id'] = strtr($vars['css_id'], '_', '-');
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
