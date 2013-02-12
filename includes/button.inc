<?php

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
