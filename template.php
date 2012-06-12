<?php
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
 * Implementation of template_process_html().
 */
function unicorn_process_html(&$variables, $hook) {
  // Check if overlay is activated.
  if (theme_get_setting('unicorn_show_overlay')) {
    // Extract and put back the body classes.
    $variables['classes_array'][] = 'show-grid';
    $variables['classes'] = implode(' ', $variables['classes_array']);
    // Add the overlay css to the page.
    $styles = (drupal_add_css(drupal_get_path('theme', 'unicorn') . '/debug/debug.css'));
    $variables['css'] = $styles;
    $variables['styles'] = drupal_get_css($variables['css']);
  }
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
