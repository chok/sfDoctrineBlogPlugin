<div class="blog-block">
  <h3>Archives</h3>
  <ul>
    <?php foreach($archives as $date => $archive): ?>
      <li><?php echo link_to($date.' ('.count($archive).')','@blog_index?archive='.Doctrine_Inflector::urlize($date)) ?></li>
    <?php endforeach;?>
  </ul>
</div>
