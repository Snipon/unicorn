<?php

/**
 * Implements hook_form_FORM_ID_alter().
 */
function unicorn_form_system_theme_settings_alter(&$form, &$form_state) {
  $form['unicorn_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Unicorn settings'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,
    '#weight' => 0,
  );

  // Debug overlay
  $form['unicorn_settings']['unicorn_show_overlay'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show grid overlay'),
    '#default_value' =>  theme_get_setting('unicorn_show_overlay'),
    '#description' => t('Shows the unicorn grid debug overlay.'),
  );
  
  // Twitter bootstrap js files
  $form['unicorn_settings']['unicorn_enable_bootstrap'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Select boostrap js plugins to enable'),
    '#default_value' => theme_get_setting('unicorn_enable_bootstrap'),
    '#description' => 
      '<p>' . t('Select boostrap js plugins to enable, more info: ') . 
      l(t('Twitter bootstrap on github'), 'http://twitter.github.com/bootstrap/') . '</p>' .
      '<p>' . t('Requires ' .  l('jQuery update', 'http://drupal.org/project/jquery_update')) . '</p>',
    '#options' => array(
      'bootstrap-affix' => 'Affix',
      'bootstrap-alert' => 'Alert',
      'bootstrap-button' => 'Button',
      'bootstrap-carousel' => 'Carousel',
      'bootstrap-collapse' => 'Collapse',
      'bootstrap-dropdown' => 'Dropdown',
      'bootstrap-modal' => 'Modal',
      'bootstrap-popover' => 'Popover',
      'bootstrap-scrollsply' => 'Scrollspy',
      'bootstrap-tab' => 'Tab',
      'bootstrap-tooltip' => 'Tooltip',
      'bootstrap-transition' => 'Transition',
      'bootstrap-typeahead' => 'Typeahead',
    ),
  );
}
