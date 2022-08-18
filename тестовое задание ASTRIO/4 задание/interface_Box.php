<?php
interface Box
    {
        function setData($key,$value);
        function getData($key);
        function save();
        function load();
    }
?>