<?php

/**
 * Implements hook_form_FORM_ID_alter().
 */
function unicorn_form_system_theme_settings_alter(&$form, &$form_state) {
  $form['unicorn_show_overlay'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show grid overlay'),
    '#default_value' =>  theme_get_setting('unicorn_show_overlay'),
    '#description' => t('Shows the unicorn grid debug overlay.'),
  );
}
