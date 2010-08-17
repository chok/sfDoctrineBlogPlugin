<div id="pub_websites">
  <?php open_box('Les adresses des auteurs')?>
  <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->isAuthor()): ?>
    <div class="pub_infos">Mettez-vous en avant</div>
    <div class="pub_infos">Complétez votre <?php echo link_to('profil', '@account_edit') ?></div>
  <?php endif ?>
  <div class="pub_author_website">
    <?php foreach($authors as $author): ?>
      <div class="pub_author"><?php echo $author->getUser()->getProfile()->getFullName($author->getUser()->getUsername()) ?></div>
      <div class="pub_website"><?php echo link_to($author->getUser()->getProfile()->getWebsite(),$author->getUser()->getProfile()->getWebsite()) ?></div>
    <?php endforeach; ?>
  </div>
  <?php close_box()?>
</div>
