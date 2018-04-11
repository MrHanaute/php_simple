<?php
function getConnection(){
    return new \PDO("mysql:host=localhost;dbname=php_base","root","1234");
}