<?php include_partial('slot') ?>

<?php if(!is_null($pager) && $pager->getNbResults() > 0 ): ?>
  <?php foreach($pager->getResults() as $post): ?>
    <?php include_partial('sfBlog/post',array('post' => $post,'view' => 'blog')) ?>
    <hr/>
  <?php endforeach ?>
  <?php include_partial('sfBlog/pager',array('pager' => $pager)) ?>
<?php else: ?>
<h1>Aucun billet</h1>
<?php endif;?>
