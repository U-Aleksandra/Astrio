<?php
$categories = array(
	array(
   	"id" => 1,
   	"title" =>  "Обувь",
   	'children' => array(
       	array(
           	'id' => 2,
           	'title' => 'Ботинки',
           	'children' => array(
               	array('id' => 3, 'title' => 'Кожа'),
               	array('id' => 4, 'title' => 'Текстиль'),
           	),
       	),
       	array('id' => 5, 'title' => 'Кроссовки',),
   	)
	),
	array(
   	"id" => 6,
   	"title" =>  "Спорт",
   	'children' => array(
       	array(
           	'id' => 7,
           	'title' => 'Мячи'
       	)
   	)
	),
);

function searchCategory($array, $id)
{
   foreach ($array as $value)
   {
    if (is_array($value))
    { 
        searchCategory($value, $id);
    }
    else
    {   
        if ($value === $id) {
            echo "Данная категория: ".$array['title']."<br />";
            }
    }
   }
}

$result = searchCategory($categories, 5);

?>