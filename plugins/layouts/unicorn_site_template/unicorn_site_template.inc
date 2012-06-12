<?php

$plugin = array(
  'title' => t('Unicorn site template'),
  'theme' => 'unicorn_site_template',
  'icon' => 'unicorn-site-template.png',
  'category' => 'Unicorn',
  'regions' => array(
    'branding' => t('Branding'),
    'nav' => t('Navigation'),
    'main' => t('Main'),
    'footer' => t('Footer'),
  ),
);

/**
 * Preprocess the site template layout.
 */
function unicorn_preprocess_unicorn_site_template(&$vars) {
  unicorn_check_layout_variables($vars);
}
