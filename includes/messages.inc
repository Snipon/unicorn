<?php

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
