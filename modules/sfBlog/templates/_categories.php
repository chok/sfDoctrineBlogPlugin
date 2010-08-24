<div class="blog-block">
  <h3>Categories</h3>
  <div class="blog-block-content">
    <?php foreach ($categories as $node): ?>
      <?php $category = Doctrine::getTable('Category')->findOneById($node['id']) ?>
      <?php if($category->getPosts()->count() > 0): //Ultra ultra moche?>
        <div>
          <?php echo str_repeat('&nbsp;&nbsp;', $node['level']);?>
          <?php echo link_to($node['name'].'('.$category->getPosts()->count().')', '@blog_category?category='.$node['slug'] ) ?>
        </div>
      <?php endif ?>
    <?php endforeach ?>
  </div>
</div>