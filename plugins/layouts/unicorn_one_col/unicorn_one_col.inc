<?php

$plugin = array(
  'title' => t('Unicorn one column'),
  'theme' => 'unicorn_one_col',
  'icon' => 'unicorn-one-col.png',
  'category' => 'Unicorn',
  'regions' => array(
    'main' => t('Main'),
  ),
);

/**
 * Implementation of theme_preprocess_unicorn_column_one().
 */
function unicorn_preprocess_unicorn_one_col(&$vars) {
  unicorn_check_layout_variables($vars);
}
