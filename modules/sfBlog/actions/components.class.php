<?php
class sfBlogComponents extends sfComponents
{
  public function executeArchives(sfWebRequest $request)
  {
    $this->archives = Doctrine::getTable('Post')->getArchives();
  }

  public function executeLast(sfWebRequest $request)
  {
    $this->billets = Doctrine::getTable('Post')->getLast(sfConfig::get('blog_nb_posts', 5));
  }
}