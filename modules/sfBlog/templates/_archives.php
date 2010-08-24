<div class="blog-block">
  <h3>Archives</h3>
  <ul class="blog-block-content">
    <?php foreach($archives as $date => $archive): ?>
      <li><?php echo link_to($date.' ('.count($archive).')','@blog_archive?archive='.Doctrine_Inflector::urlize($date)) ?></li>
    <?php endforeach;?>
  </ul>
</div>
