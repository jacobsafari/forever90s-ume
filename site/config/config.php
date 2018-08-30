<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set('license', 'put your license key here');
c::set('debug', true);

/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/

c::set('panel.install', true);

c::set('cache', false);

c::set('thumbs.driver', 'im');

function exportContent() {
  $content = new StdClass();
  $content->desktop = kirby()->site()->pages()->find('desktop')->getPublicContent(true);
  $content->menu = kirby()->site()->pages()->find('menu')->getPublicContent(true);
  return file_put_contents(kirby()->roots()->content() . DS . 'content.json', json_encode($content));
}

kirby()->hook('panel.page.update', function() {
	exportContent();
});

require_once(dirname(__FILE__) . DS . '..' . DS . 'routes.php');

/**
 * Helper Functions
 */

function consoleLog($input) {
	file_put_contents("php://stdout", var_export($input, true) . "\n");
}
