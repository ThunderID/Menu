<?php 

include '../src/Interface/IMenu.php';
include '../src/Bootstrap3Menu.php';

$menu = new \thunderid\menu\Bootstrap3Menu();
$menu->add('dashboard', 'Dashboard', 'http://yahoo.com', null, '__left_nav');
$menu->add('overview', 'Overview', 'http://yahoo.com', null, 'dashboard');

echo $menu->render();


