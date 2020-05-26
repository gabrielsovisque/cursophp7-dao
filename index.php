<?php

require_once "config.php";

/*

$sql = new SQL();
// esse objeto $variavel tem o objeto stmt que tem os método - conexão, - prapare, - bindParam, -execute e  - fechall
$usuarios = $sql -> select("SELECT * FROM tb_usuarios2 ");
echo json_encode($usuarios);

*/

$root = new Usuario();
$root -> loadById(4);



 //como é um objeto ele retorn o método magico tostring que é usado para retornar algo quando o objeto é usado desse jeito.
echo $root;
