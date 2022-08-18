<?php
abstract class AbstractBox implements Box
    {
       protected $data = array();

       public function setData($key, $value)
       {
            $this->data[$key] = $value;
       }

       public function getData($key)
       {

            if ($this->data[$key] != null)
            {
               $result = $this->data[$key];
               echo "Запрашиваемые данные: ".$key." - ".$result;
               return $result;
            }
            else{
                return null;
            }
         
       }

       public abstract function save();
       public abstract function load();
    }
?>