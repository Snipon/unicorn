<?php

$plugin = array(
  'title' => t('Unicorn three columns'),
  'theme' => 'unicorn_three_col',
  'icon' => 'unicorn-three-col.png',
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
function unicorn_preprocess_unicorn_three_column(&$vars) {
  unicorn_check_layout_variables($vars);
}
