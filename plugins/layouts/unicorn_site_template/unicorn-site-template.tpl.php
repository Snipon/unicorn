<?php

/**
 * @file
 * This layout is designed to be the site template layout when using
 * the Panels Everywhere module.
 */
?>
<div<?php print $css_id ? " id=\"$css_id\"" : ''; ?> class="page-wrapper">

  <?php if (!empty($content['branding'])): ?>
    <div class="branding-wrapper">
      <section class="branding container">
        <?php print render($content['branding']); ?>
      </section>
    </div>
  <?php endif; ?>

  <?php if (!empty($content['nav'])): ?>
    <div class="navbar-wrapper">
      <nav class="navbar container">
        <?php print render($content['nav']); ?>
      </nav>
    </div>
  <?php endif; ?>

  <?php if (!empty($content['main'])): ?>
    <div class="content-wrapper">
      <section class="content container">
        <?php print render($content['main']); ?>
      </section>
    </div>
  <?php endif; ?>

  <?php if (!empty($content['footer'])): ?>
    <div class="closure-wrapper">
        <section class="closure container">
          <?php print render($content['footer']); ?>
        </footer>
    </div>
  <?php endif; ?>

</div>
