<?php

$plugin = array(
  'title' => t('Unicorn flex'),
  'theme' => 'unicorn_flex',
  'icon' => 'unicorn-flex.png',
  'category' => 'Unicorn',
  'regions' => array(
    'header' => t('Header'),
    'aside_alpha' => t('Aside left'),
    'main' => t('Main'),
    'aside_beta' => t('Aside right'),
    'footer' => t('Footer'),
  ),
);

/**
 * Implementation of theme_preprocess_unicorn_column_two().
 */
function unicorn_preprocess_unicorn_flex(&$vars) {
  unicorn_check_layout_variables($vars);
}

/**
 * Grid size function
 */
function grid() {
  $args = func_get_args();
  $default = array_shift($args);
  preg_match('/(?<type>[a-zA-Z]*)(?<val>[0-9]*)/', $default, $grid);

  // Process the conditions.
  $flip_states = array('var' => 'int', 'int' => 'var');
  $state = 'var';
  foreach ($args as $arg) {
    if ($state == 'var') {
      $var_state = !empty($arg);
    }
    elseif ($var_state) {
      $grid['val'] = $grid['val'] - $arg;
    }
    $state = $flip_states[$state];
  }

  $output = '';
  // Anything below a value of 1 is not needed.
  if ($grid['val'] > 0) {
    $output = $grid['type'] . $grid['val'];
  }
  return $output;
}
