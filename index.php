<?php
/*
----------------------------------------------------- ARQUIVO PARA CLASS DOS BLOCOS DO PROJETO(
                                            
) --------------------------------------------------------------------
*/
require_once "config.php";


/*(((((((((((((((((((((((((((((((((((((((((((((((((((((((( USANDO MÉTODODS SELECTS )))))))))))))))))))))))))))))))))))))))))))))))))))))))) */




/*
----------------------------------------------/ usando a class cru SQL/------------------------------------------------------------

$sql = new SQL();
// esse objeto $variavel tem o objeto stmt que tem os método - conexão, - prapare, - bindParam, -execute e  - fechall
$usuarios = $sql -> select("SELECT * FROM tb_usuarios2 ");
echo json_encode($usuarios);

*/

/*-------------------------------/ usando class usuario com método LOADBYID E TOSTRING  /-------------------------------------- */

//$root = new Usuario();
//$root -> loadById(4);

 //como é um objeto ele retorn o método magico tostring que é usado para retornar algo quando o objeto é usado desse jeito.
//echo $root;


/*----------------------------/ usando class usuario com métodos getList /------------------------------- */

// ele usa um método static da class usuario então ele nem precisa estanciar a class em um objeto pra usar o método
// esse método tras todas as linhas da tabela em ordem que estão na coluna deslogin
// echo json_encode($list = Usuario::getList());


/*-----------------------------------------------------/ usando class usuario com método static search /---------------------------------------- */
// esse método tras todas as linhas que começam com tais letras na coluna deslogin (método de pesquisa) 
//echo json_encode(Usuario::search("j"));


/*------------------------------------/ usando class usuario e o método login  /------------------------------------------------ */
// esse método faz um select com os params definidos e se não tiver esses parâmetros, ele fala que login ou senha estão invalidos
// como é usado os atributos da class, podemos usar o método magico __toString
//$login = new Usuario();
//$login -> login("gabriel", "heheheh");
//echo $login;
/*((((((((((((((((((((((((((((((((((((((((((((((((((((((((USANDO MÉTODODS INSERTS)))))))))))))))))))))))))))))))))))))))))))))))))))))))))))) */

//--------------------/ usando class usuario e os métodos setDeslogin, setDessenha, isert, magico __toString /------------------------------- */

//instancia e envia valores para o atributo
//$aluno = new Usuario("aluno", "al!@#");

//$aluno -> insert();

//echo $aluno;


/*((((((((((((((((((((((((((((((((((((((((((((((((((((((((USANDO MÉTODODS UPDATE)))))))))))))))))))))))))))))))))))))))))))))))))))))))))))) */

$update = new Usuario();

//definido a linha que eu quero alterar usando o método loadbyid
$update -> loadById(11);

//depois simplismente passa os novos valores que vão ser alterado na tabela
$update -> update("estudante", "foco");

echo $update;

