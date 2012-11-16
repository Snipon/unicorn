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
  <header class="region contentheader span12">
    <?php print render($content['header']); ?>
  </header>
<?php endif; ?>

<?php if (!empty($content['aside_alpha'])): ?>
  <aside class="region sidebar-left span3">
    <?php print render($content['aside_alpha']); ?>
  </aside>
<?php endif; ?>

<?php if (!empty($content['main'])): ?>
  <div class="region main <?php print grid('span12', $content['aside_alpha'], 3, $content['aside_beta'], 3); ?>">
    <?php print render($content['main']); ?>
  </div>
<?php endif; ?>

<?php if (!empty($content['aside_beta'])): ?>
  <aside class="region sidebar-right span3">
    <?php print render($content['aside_beta']); ?>
  </aside>
<?php endif; ?>

<?php if (!empty($content['footer'])): ?>
  <footer class="region contentfooter span12">
    <?php print render($content['footer']); ?>
  </footer>
<?php endif; ?>

</div>
