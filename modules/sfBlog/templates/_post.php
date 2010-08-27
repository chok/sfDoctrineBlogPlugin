<?php use_stylesheet('/js/syntaxhl/styles/shCore.css') ?>
<?php use_stylesheet('/js/syntaxhl/styles/shCoreDefault.css') ?>

<?php use_javascript('syntaxhl/scripts/shCore.js') ?>
<?php use_javascript('syntaxhl/scripts/shAutoloader.js') ?>


<?php use_javascript('jquery/jquery.js') ?>
<?php use_javascript('syntaxhl') ?>

<div class="blog_post">
  <div class="blog_title blue-link">
    <?php echo link_to($post->getTitle(),'sfBlog/viewPost?slug='.$post->getSlug()) ?>
  </div>
  <div class="blog_post_date"><?php echo $post->getUser()->getFirstName().' '.$post->getUser()->getLastName() ?> - <?php echo $post->getDate() ?></div>
  <div class="blog_post_content corner"><?php echo $post->getRawValue()->getContent() ?></div>
  <div id="comments">
    <?php $plural = $post->getComments()->count() > 1?'s':'' ?>
    <?php if($view == 'blog'): ?>
      <div id="comments-nb">
        <?php echo link_to('Comment'.$plural.'('.$post->getComments()->count().')','@blog_view?slug='.$post->getSlug()) ?>
      </div>
    <?php elseif($post->getComments()->count() > 0): ?>
      <div id="comments-title">Comments(<?php echo $post->getComments()->count() ?>)</div>
      <?php foreach($post->getComments() as $comment):?>
        <div class="comment">
          <?php include_partial('comment',array('comment' => $comment)) ?>
        </div>
      <?php endforeach;?>
    <?php endif; ?>
  </div>
  <?php if($view == 'full'): ?>
    <?php if($sf_user->isAuthenticated() || !sfConfig::get('app_sfBlog_register_for_comments')): ?>
    <div id="leave-comment"><a href="#comment-form" name="comment-form">Leave a comment</a></div>
    <?php echo form_tag('@blog_comment?slug='.$post->getSlug(),array('id' => 'blog_post_form'))?>
      <?php echo $comment_form['_csrf_token']->renderError() ?>
      <?php echo $comment_form['_csrf_token']->render() ?>

      <?php echo $comment_form['username']->renderError() ?>
      <?php echo $comment_form['username']->render(array('class' => 'text')) ?>
      <?php echo $comment_form['username']->renderLabel() ?>

      <?php echo $comment_form['mail']->renderError() ?>
      <?php echo $comment_form['mail']->render(array('class' => 'text')) ?>
      <?php echo $comment_form['mail']->renderLabel() ?>

      <?php echo $comment_form['website']->renderError() ?>
      <?php echo $comment_form['website']->render(array('class' => 'text')) ?>
      <?php echo $comment_form['website']->renderLabel() ?>

      <?php echo $comment_form['content']->renderError() ?>
      <?php echo $comment_form['content']->renderLabel(null, array('class' => 'content-label')) ?>
      <?php echo $comment_form['content']->render(array('class' => 'textarea')) ?>

      <hr/>
      <input type="submit" class="submit" value="Submit"/>
    </form>
    <?php else: ?>
      <p style="clear:both;margin: 20px 0">Vous devez être <?php echo link_to('connecté', '@sf_guard_signin')?> pour laisser un commentaire</p>
    <?php endif ?>
  <?php endif; ?>
</div>