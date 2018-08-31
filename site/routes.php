<?php

c::set('routes', array(

  array(
    'method' => 'GET',
    'pattern' => 'api/all',
    'action' => function() {
      $content = new StdClass();
      $content->desktop = kirby()->site()->pages()->find('desktop')->getPublicContent(true);
      $content->menu = kirby()->site()->pages()->find('menu')->getPublicContent(true);
      return response::json(json_encode($content));
    }
  ),

  array(
    'method' => 'GET',
    'pattern' => 'export',
    'action' => function() {
      $export = exportContent();
      if ($export !== false) {
        return response::json(json_encode('Successfully exported to content/content.json'));
      } else {
        return response::json(json_encode('There was an error exporting the content'));
      }
    }
  ),

  array(
    'method' => 'GET',
    'pattern' => 'desktop/(:all)',
    'action' => function($one) {
      return page('/desktop');
    }
  ),
));

 ?>
