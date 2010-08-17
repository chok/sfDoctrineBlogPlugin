<div class="blog_title blue-link mini">
  <?php $anchor = 'comment-'.$comment->getId() ?>
  <a name="<?php echo $anchor ?>" href="#<?php echo $anchor ?>"/><?php echo $comment->getTitle()?></a>
</div>
<div class="blog_post_date mini">publié par <?php echo link_to($comment->getUser()->getUsername(),'account/index?slug='.$comment->getUser()->getSlug()) ?>, <span>le <?php echo $comment->getDate() ?></span></div>
<div class="blog-comment-content corner"><?php echo $comment->getContent() ?></div>
