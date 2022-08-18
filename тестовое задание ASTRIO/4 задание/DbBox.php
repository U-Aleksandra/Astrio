<?php
    class DbBox extends AbstractBox
    {
        private $conn;
        protected static $_instance;

        private function __construct($conn)
        {
            $this->conn = $conn;
        }

        public static function getInstance($conn) { 
            if (self::$_instance === null) { 
                self::$_instance = new self($conn);  
            }
            return self::$_instance;
        }

        public function save()
        {
            if($this->conn->connect_error)
            {
                die("Ошибка: " . $this->conn->connect_error);
            }
            foreach($this->data as $key=>$value)
            {   
                $update = "UPDATE astrio.box SET `value` = '{$value}' WHERE `key`='{$key}'";
                $result = $this->conn->query($update);
                if (mysqli_affected_rows($this->conn) > 0)
                {
                    echo "Данные успешно обновлены!";
                }
                else
                {
                    $insert = "INSERT INTO astrio.box (`key`, `value`) VALUES ('{$key}', '{$value}')";
                    if($this->conn->query($insert))
                    {
                        echo "Данные успешно добавлены!";
                    }
                    else
                    {
                        echo "Ошибка: " . $this->conn->error;
                    }
                }
            }
                $this->conn->close();
        }

        public function load()
        {
            if($this->conn->connect_error){
                die("Ошибка: " . $this->conn->connect_error);
            }
            $sql = "SELECT * FROM astrio.box";
            if($result = $this->conn->query($sql))
            {
                foreach($result as $row)
                {
                   $this->setData($row["key"],$row["value"]);
                }
            $result->free();
            }
            else{
                echo "Ошибка: " . $this->conn->error;
            }
            $this->conn->close();
        }
    }
?>