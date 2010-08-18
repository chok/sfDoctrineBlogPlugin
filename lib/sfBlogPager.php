<?php
class sfBlogPager extends sfDoctrinePager
{ 
  public function __construct($page)
  {
    parent::__construct('Post',sfConfig::get('app_blog_post_per_page',5));

    $this->setQuery(NULL);
    $this->setPage($page);
    
    $this->init();
  }  

}
