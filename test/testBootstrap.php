<?php 

include __DIR__ . '/../src/Interface/IMenu.php';
include __DIR__ . '/../src/Menu.php';
include __DIR__ . '/../src/Bootstrap3Menu.php';

$menu = new \thunderid\menu\Bootstrap3Menu();
$menu->add('dashboard', 'Dashboard', 'http://yahoo.com', null, '__left_nav');
$menu->add('overview', 'Overview', 'http://yahoo.com', 'glyphicon glyphicon-add', 'dashboard');

echo $menu->render();


