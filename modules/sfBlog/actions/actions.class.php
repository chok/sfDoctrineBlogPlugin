<?php
class sfBlogActions extends sfActions
{
  public function preExecute()
  {
    if($layout = sfConfig::get('app_sfBlog_layout'))
    {
      $this->setLayout($layout);
    }
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new PostPager($request->getParameter('page',1),$request->getParameter('archive'));

    $title = 'Blog';
    if($archive = $request->getParameter('archive'))
    {
      list($month,$year) = explode('-',$archive);
      $month = PostTable::$nb_month[$month];
      $month = PostTable::$fr_month[date('F',mktime(0,0,0,$month,1,0))];

      $title .= ' - '.$month.' '.$year;
    }
  }

  public function executeViewPost(sfWebRequest $request)
  {
    $this->post = Doctrine::getTable('Post')->findOneBySlug($request->getParameter('slug'));

    $this->forward404Unless($this->post);

    $this->comment_form = new CommentForm();
  }

  public function executeSendComment(sfWebRequest $request)
  {
    $this->post = Doctrine::getTable('Post')->findOneBySlug($request->getParameter('slug'));

    $this->forward404Unless($this->post && ($this->getUser()->isAuthenticated() || !sfConfig::get('app_sfBlog_register_for_comments')));

    $user = sfConfig::get('app_sfBlog_register_for_comments')?$this->getUser()->getGuardUser():null;
    $this->form = new CommentForm($this->post, $user);

    if($this->form->bindAndSave($request->getParameter('comment')))
    {
      $this->getUser()->setFlash('notice','Votre commentaire a été posté');
    }
    else
    {
      $this->getUser()->setFlash('error','Un problème a été rencontré. Réessayer ultérieurement');
    }

    $this->redirect('sfBlog/viewPost?slug='.$this->post->getSlug());
  }
}


