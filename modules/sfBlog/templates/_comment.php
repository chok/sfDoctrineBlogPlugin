<?php use_helper('Gravatar') ?>

<div class="blog_post_gravatar"><?php echo gravatar($comment->getMail()) ?></div>
<div class="blog_post_comment">
  <div class="blog_post_date mini"><span><?php echo $comment->getDate() ?></span></div>
  <div class="blog_post_user">
    <?php $website = $comment->getWebsite()?>
    <?php if(!empty($website)): ?>
      <?php echo link_to($comment->getUsername(), $website, array('name' => 'comment-'.$comment->getId())) ?> :
    <?php else: ?>
      <a href="#comment-<?php echo $comment->getId() ?>" name="comment-<?php echo $comment->getId() ?>" ><?php echo $comment->getUsername() ?></a> :
    <?php endif ?>
  </div>
  <div class="blog-comment-content corner"><?php echo nl2br($comment->getContent(), true) ?></div>
</div>

<hr/>


