<?php
function Validation($array)
    {
        $single_tag = array("<img>","<link>","<br>","<col>","<hr>","<input>","<source>");//массив одиночных тегов
        $array_tag = array_diff($array,$single_tag);//убираем из массива одиночные теги
        $open_tag = array();// массив открывающихся тегов
        foreach($array_tag as $value)
        {
           if(!str_contains($value,'/'))//проверка на открывающийся тег
           {
                $open_tag[]=$value;//если открывающийся, добавляем его в массив
           }
           //если тег закрывающийся
           else
           {
            $closed = str_replace("/", "", $value);//заменяем закрывающийся тег на открывающийся
            $open = array_pop($open_tag);//берем последний открывающийся тег
            if($closed != $open)//если теги не совпадают
            {
                break;//документ не корректный
            }
           }
        }
        if (count($open_tag)==0)//если в массиве не осталось элементов, то документ корректный
        {
            print("Этот HTML документ корректный\n");
        }
        else 
        {
            print("Этот HTML документ не корректный\n");
        }
    }

$test_array = array("<a>", "<div>","<br>","</div>", "</a>" ,"<span>","<input>","</span>");
$result = Validation($test_array);

?>