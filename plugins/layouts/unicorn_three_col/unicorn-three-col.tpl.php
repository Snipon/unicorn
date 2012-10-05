<?php

/**
 * @file
 * This layout is intended to be used inside the page content pane. Thats why
 * there is not wrapper div by default.
 */
?>
<?php if (!empty($css_id)): ?>
  <div id="<?php print $css_id; ?>" class="row">
<?php else: ?>
  <div class="row">
<?php endif; ?>

<?php if (!empty($content['header'])): ?>
  <header class="region contentheader clearfix">
    <?php print render($content['header']); ?>
  </header>
<?php endif; ?>

<?php if (!empty($content['aside_alpha'])): ?>
  <aside class="region sidebar-left">
    <?php print render($content['aside_alpha']); ?>
  </aside>
<?php endif; ?>

<?php if (!empty($content['main'])): ?>
  <div class="region main">
    <?php print render($content['main']); ?>
  </div>
<?php endif; ?>

<?php if (!empty($content['aside_beta'])): ?>
  <aside class="region sidebar-right">
    <?php print render($content['aside_beta']); ?>
  </aside>
<?php endif; ?>

<?php if (!empty($content['footer'])): ?>
  <footer class="region contentfooter ">
    <?php print render($content['footer']); ?>
  </footer>
<?php endif; ?>

</div>
