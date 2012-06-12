<?php

$plugin = array(
  'title' => t('Unicorn two columns left'),
  'theme' => 'unicorn_two_col_left',
  'icon' => 'unicorn-two-col-left.png',
  'category' => 'Unicorn',
  'regions' => array(
    'header' => t('Header'),
    'aside' => t('Aside'),
    'main' => t('Main'),
    'footer' => t('Footer'),
  ),
);

/**
 * Implementation of theme_preprocess_unicorn_column_two().
 */
function unicorn_preprocess_unicorn_two_col_left(&$vars) {
  unicorn_check_layout_variables($vars);
}
