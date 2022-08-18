<?php

require_once 'interface_Box.php';
require_once 'AbstractBox.php';
require_once 'FileBox.php';
require_once 'DbBox.php';


    $fb = FileBox::getInstance("test.txt");
    $fb->setData(7,'Лев Толстой');
    $fb->setData(8,'Достоевский');
    $fb->save(); 
    $fb->getData(8);
    $fb->load();
    $fb->getData(8);

    $connect = new mysqli("localhost", "sqluser", "password", "astrio");
    $dbb = DbBox::getInstance($connect);
    $dbb->setData(11, 'Лиза');
    $dbb->save();
    $dbb->load();
    $dbb->getData(11);

?>