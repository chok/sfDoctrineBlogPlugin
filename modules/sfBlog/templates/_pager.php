

  <div class="pager">
<?php

  $navigation = '';
  if ($pager->haveToPaginate())
  {  
    $uri = htmlspecialchars_decode($route);
    $uri .= (preg_match('/\?/', $uri) ? '&' : '?').'page=';
    $uri = htmlspecialchars_decode($uri);
    
    // First and previous page
    if ($pager->getPage() != 1)
    {
      $navigation .= link_to(image_tag('fleche_gauche_mini'), $uri.$pager->getPreviousPage(), 'class=arrow previous png_fix');
      if (count($pager->getLinks()) > 5)
      {
        $navigation .= link_to('1', $uri.'1').'<span class="pointille">...</span>';
      }
      
      if ($pager->getPage() >= 5)
      {
        $navigation .= link_to('1', $uri.'1').'<span class="pointille">...</span>';
      }
    }

    // Pages one by one
    $links = array();
    $pages = $pager->getLinks();

    $nb_links = (count($pager->getLinks()) > 5) ? 5 : count($pager->getLinks());
    if ($pager->getPage() <= 5 )
    {
      $begin = 0;
      $end = $nb_links;
    }
    else if ($pager->getPage() > (count($pager->getLinks()) - 5))
    {
      $begin = (count($pager->getLinks()) - $nb_links);
      $end = count($pager->getLinks());
    }
    else
    {
      $begin = ($pager->getPage() - 2);
      $end = ($pager->getPage() + 2);
    }
    for ($i = $begin; $i < $end ; $i++)
    {
      $links[] = link_to_unless($pages[$i] == $pager->getPage(), $pages[$i], $uri.$pages[$i], array('class' => 'pager_page'));
    }

    $navigation .= join('', $links);
 
    // Next and last page
    if ($pager->getPage() != $pager->getLastPage())
    {
      if ($pager->getLastPage() - $pager->getPage() >= 5)
      {
        $navigation .= '<span class="pointille">...</span>'.link_to($pager->getLastPage(), $uri.$pager->getLastPage());
      }
      $navigation .= link_to(image_tag('fleche_droite_mini'), $uri.$pager->getNextPage(), 'class=arrow next png_fix');
      
    }
  }
  echo $navigation;
?>
  </div>
