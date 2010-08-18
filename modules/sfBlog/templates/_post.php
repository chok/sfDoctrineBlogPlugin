<div class="blog_post">
  <div class="blog_title blue-link">
    <?php echo link_to($post->getTitle(),'sfBlog/viewPost?slug='.$post->getSlug()) ?>
  </div>
  <div class="blog_post_date">publié par <?php echo link_to($post->getUser()->getUsername(),'account/index?slug='.$post->getUser()->getUsername()) ?>, <span>le <?php echo $post->getDate() ?></span></div>
  <div class="blog_post_content corner"><?php echo $post->getRawValue()->getContent() ?></div>
  <div id="comments">
    <?php $plural = $post->getComments()->count() > 1?'s':'' ?>
    <?php if($view == 'blog'): ?>
      <?php echo link_to($post->getComments()->count().' commentaire'.$plural,'sfBlog/viewPost?slug='.$post->getSlug(), array('id' => 'comments-nb')) ?>
    <?php else: ?>
      <div id="comments-nb"><?php echo $post->getComments()->count().' commentaire'.$plural ?></div>
      <?php foreach($post->getComments() as $comment):?>
        <div class="comment">
          <?php include_partial('comment',array('comment' => $comment)) ?>
        </div>
      <?php endforeach;?>
    <?php endif; ?>
  </div>
  <?php if($view == 'full'): ?>
    <?php if($sf_user->isAuthenticated() || !sfConfig::get('app_sfBlog_register_for_comments')): ?>
    <?php echo form_tag('sfBlog/sendComment?slug='.$post->getSlug(),array('id' => 'blog_post_form'))?>
      <?php echo $comment_form['_csrf_token']->renderError() ?>
      <?php echo $comment_form['_csrf_token']->render() ?>
      <p><?php echo $comment_form['title']->renderLabel() ?></p>
      <?php echo $comment_form['title']->render(array('class' => 'text')) ?>
      <p><?php echo $comment_form['content']->renderLabel() ?></p>
      <?php echo $comment_form['content']->render(array('class' => 'textarea')) ?>
      <br/>
      <input type="submit" class="submit" value="Envoyer"/>
    </form>
    <?php else: ?>
      <p style="clear:both;margin: 20px 0">Vous devez être <?php echo link_to('connecté', '@sf_guard_signin')?> pour laisser un commentaire</p>
    <?php endif ?>
  <?php endif; ?>
</div>