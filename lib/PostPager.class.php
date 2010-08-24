<?php
class PostPager extends sfDoctrinePager
{
  protected $search;
  protected $type;
  protected $letter;

  public function __construct($page,$archive = null, $category = null)
  {
    parent::__construct('Post',sfConfig::get('app_blog_max_per_page',10));

    $q = null;


    if(!is_null($archive))
    {
      list($month,$year) = explode('-',$archive);
      $month = PostTable::$nb_month_en[$month];
      $start = date('Y-m-d H:i:s',mktime(0,0,0,$month,1,$year));
      $end = date('Y-m-d H:i:s',mktime(0,0,0,$month+1,0,$year));
      $q = Doctrine::getTable('Post')->getArchivesQuery('month',$start,$end);
    }
    elseif(!is_null($category))
    {
      $q = Doctrine::getTable('Post')->getCategoryQuery($category);
    }
    else
    {
      $q = Doctrine::getTable('Post')->getPublishedPostQuery();
    }


    $this->setQuery($q);
    $this->setPage($page);
    $this->init();
  }

}
