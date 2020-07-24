<?php
require_once 'PDOWrapper.php';

use MVC\model\PDOWrapper as PDOWrapper;

$base = new PDOWrapper("localhost", "my_db", "mysql", "mysql");
$res = $base->query("SELECT * FROM `person` WHERE `id_person` = :name", ["name"=>90]);
print_r("Результат запроса : ");
print_r($res);

$num = $base->insert("type_doc", [0,"test3"]);
print_r ("<br> номер последней вставленной строки : ".$num);
//
$num = $base->update("type_doc",  ["name_type"=> "newww test"],["id_type_doc"=>14]);
print_r("<br> кол-во модифицированных строк : ". $num);

$num = $base->delete("type_doc", ["id_type_doc"=> 17]);
print_r("<br> Кол-во удаленных строк : ". $num);

?>