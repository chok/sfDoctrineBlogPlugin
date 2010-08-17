<?php foreach($billets as $billet): ?>
  <div class="blog-billet-link"><?php echo link_to($billet->getTitle(), '@blog_view?slug='.$billet->getSlug()) ?></div>
<?php endforeach ?>