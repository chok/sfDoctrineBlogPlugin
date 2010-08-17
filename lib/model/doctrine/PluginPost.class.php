<?php

/**
 * PluginPost
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7294 2010-03-02 17:59:20Z jwage $
 */
abstract class PluginPost extends BasePost
{
  public function getDate()
  {
    $dt = $this->getDateTimeObject('created_at');
    $day = $dt->format('d');
    $month = PostTable::$fr_month[$dt->format('F')];
    $year = $dt->format('Y');

    return $day.' '.$month.' '.$year;
  }
}