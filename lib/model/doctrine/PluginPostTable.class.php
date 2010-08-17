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

  public function getArchives($format = "month",$start = null, $end = null)
  {
    $q = $this->getArchivesQuery($format,$start,$end);

    $results = $q->execute();

    $archives = array();

    foreach($results as $result)
    {
      $dt = $result->getDateTimeObject('created_at');
      $month = self::$fr_month[$dt->format('F')];
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