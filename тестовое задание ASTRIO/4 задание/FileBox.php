<?php
    class FileBox extends AbstractBox
    {
        private $file;
        protected static $_instance;

        public function __construct($file)
        {
            $this->file = $file;
        }

        public static function getInstance($file) { // получить экземпляр данного класса
            if (self::$_instance === null) { // если экземпляр данного класса  не создан
                self::$_instance = new self($file);  // создаем экземпляр данного класса
            }
            return self::$_instance;
        }
       
        private function __clone() {}
        public function __wakeup(){}

        public function save()
        {
            $result = array();

            $fd = fopen($this->file, 'r') or die("не удалось создать файл");
            
            if ($fd) 
            {
                
                while (($str = fgets($fd)) !== false) 
                {
                    $key = substr($str, 0, strrpos($str, ":"));
                    $value = substr($str, strpos($str, ":")+1);
                    $result[$key] = $value;
                }
                if (!feof($fd)) 
                {
                    echo "Error: unexpected fgets() fail\n";
                }
                
            }
            fclose($fd);

            $fd = fopen($this->file, 'w') or die("не удалось создать файл");
            if ($fd) 
            {
                foreach ($result as $keyArray=>$valueArray)
                {
                    foreach($this->data as $key=>$value)
                    {
                        if($keyArray == $key)
                        {
                            $result[$keyArray] = $value."\n";
                        }
                        else
                        {
                            $result[$key] = $value."\n";
                        }
                    }
                }
                foreach ($result as $keyArray=>$valueArray)
                {
                    fputs($fd, "{$keyArray}:{$valueArray}");
                }
                
            }
            fclose($fd);
            
        }

        public function load()
        {
            $fd = fopen($this->file, 'r') or die("не удалось создать файл");

            if ($fd) 
            {
                while (($str = fgets($fd)) !== false) 
                {
                    $this->setData(substr($str, 0, strrpos($str, ":")), substr($str, strrpos($str, ":") + 1));
                }

                if (!feof($fd)) 
                {
                    echo "Error: unexpected fgets() fail\n";
                }
                fclose($fd);
            }
        }
    }
?>
