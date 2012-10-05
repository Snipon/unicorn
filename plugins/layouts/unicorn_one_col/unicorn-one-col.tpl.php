<?php
?>

<?php if (!empty($css_id)): ?>
  <div id="<?php print $css_id; ?>">
<?php endif; ?>

<?php if (!empty($content['main'])): ?>
  <div class="main">
      <?php print render($content['main']); ?>
  </div>
<?php endif; ?>

<?php if (!empty($css_id)): ?>
  </div>
<?php endif; ?>
