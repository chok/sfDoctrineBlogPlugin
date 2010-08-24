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

  public function executeCategories(sfWebRequest $request)
  {
    $this->categories = Doctrine::getTable('Category')->getTree()->fetchTree();
  }

  public function executeBoth(sfWebRequest $request)
  {
    $this->archives = Doctrine::getTable('Post')->getArchives();
    $this->categories = Doctrine::getTable('Category')->getTree()->fetchTree();
  }
}