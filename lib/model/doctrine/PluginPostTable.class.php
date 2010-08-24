<?php
/**
 */
class PluginPostTable extends Doctrine_Table
{
  //TODO Solution moins... francaise à faire
  public static $fr_month = array(
                                  'January'   => 'Janvier',
                                  'February'  => 'Février',
                                  'March'     => 'Mars',
                                  'April'     => 'Avril',
                                  'May'       => 'Mai',
                                  'June'      => 'Juin',
                                  'July'      => 'Juillet',
                                  'August'    => 'Août',
                                  'September' => 'Septembre',
                                  'October'   => 'Octobre',
                                  'November'  => 'Novembre',
                                  'December'  => 'Décembre'
                                );
  public static $nb_month = array(
                                  'janvier'   => 1,
                                  'fevrier'   => 2,
                                  'mars'      => 3,
                                  'avril'     => 4,
                                  'mai'       => 5,
                                  'juin'      => 6,
                                  'juillet'   => 7,
                                  'aout'      => 8,
                                  'septembre' => 9,
                                  'octobre'   => 10,
                                  'novembre'  => 11,
                                  'decembre'  => 12
                                );

 public static $nb_month_en = array(
                                  'january'   => 1,
                                  'february'   => 2,
                                  'march'      => 3,
                                  'april'     => 4,
                                  'may'       => 5,
                                  'june'      => 6,
                                  'july'   => 7,
                                  'august'      => 8,
                                  'september' => 9,
                                  'october'   => 10,
                                  'november'  => 11,
                                  'december'  => 12
                                );


  public function getPublishedPostQuery()
  {
    $q = $this->createQuery('p')
              ->where('p.is_publish = 1');

    return $q;
  }

  public function getArchivesQuery($format = "month",$start = null, $end = nul)
  {
    $q = $this->createQuery('p')
              ->where('p.is_publish = 1')
              ->orderBy('p.created_at DESC');

    if(!is_null($start))
    {
      $q->addWhere('p.created_at >  ?',$start);

      if(is_null($end))
      {
        $end = time();
      }
    }

    if(!is_null($end))
    {
      $q->addWhere('p.created_at < ?',$end);
    }

    return $q;
  }

  public function getCategoryQuery($category)
  {
    $q = $this->createQuery('p')
              ->leftJoin('p.Categories c')
              ->where('p.is_publish = 1')
              ->addWhere('c.id = ?', $category->getId());

    return $q;
  }

  public function getArchives($format = "month",$start = null, $end = null, $culture = 'en')
  {
    $q = $this->getArchivesQuery($format,$start,$end);

    $results = $q->execute();

    $archives = array();

    foreach($results as $result)
    {
      $dt = $result->getDateTimeObject('created_at');
      $month = $dt->format('F');
      if($culture == 'fr')
      {
        $month = self::$fr_month[$month];
      }
      $year = $dt->format('Y');

      $archives[$month.' '.$year][] = $result;
    }

    return $archives;
  }

  public function getLast($limit)
  {
    $q = $this->createQuery('p')
              ->where('p.is_publish = 1')
              ->orderBy('p.created_at DESC')
              ->limit($limit);

    return $q->execute();
  }
}