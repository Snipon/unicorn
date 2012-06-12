<?php

$plugin = array(
  'title' => t('Unicorn two columns'),
  'theme' => 'unicorn_two_col',
  'icon' => 'unicorn-two-col.png',
  'category' => 'Unicorn',
  'regions' => array(
    'header' => t('Header'),
    'main' => t('Main'),
    'aside' => t('Aside'),
    'footer' => t('Footer'),
  ),
);

/**
 * Implementation of theme_preprocess_unicorn_column_two().
 */
function unicorn_preprocess_unicorn_two_column(&$vars) {
  unicorn_check_layout_variables($vars);
}
