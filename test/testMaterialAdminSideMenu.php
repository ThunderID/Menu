<?php 

include __DIR__ . '/../src/Interface/IMenu.php';
include __DIR__ . '/../src/Menu.php';
include __DIR__ . '/../src/MaterialAdminSideMenu.php';

$menu = new \thunderid\menu\MaterialAdminSideMenu();
$menu->add('dashboard', 'Dashboard', 'http://yahoo.com', null);
$menu->add('overview', 'Overview', 'http://yahoo.com', 'glyphicon glyphicon-add', 'dashboard');

echo $menu->render();


