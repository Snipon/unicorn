<?php

/**
 * @file
 * This layout is intended to be used inside the page content pane. Thats why
 * there is not wrapper div by default.
 */
?>
<?php if (!empty($css_id)): ?>
  <div id="<?php print $css_id; ?>" class="unicorn-two-col">
<?php else: ?>
  <div>
<?php endif; ?>

<?php if (!empty($content['header'])): ?>
  <header class="region grid-16 contentheader">
    <?php print render($content['header']); ?>
  </header>
<?php endif; ?>

<?php if (!empty($content['main'])): ?>
  <div class="region main">
    <?php print render($content['main']); ?>
  </div>
<?php endif; ?>

<?php if (!empty($content['aside'])): ?>
  <aside class="region sidebar-right">
    <?php print render($content['aside']); ?>
  </aside>
<?php endif; ?>

<?php if (!empty($content['footer'])): ?>
  <footer class="region contentfooter">
    <?php print render($content['footer']); ?>
  </footer>
<?php endif; ?>

</div>
