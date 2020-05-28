<?php

/*
----------------- class usuario ( class que vai ser usada pelo objeto para a tabela em especifico usuarios2

) ----------------------
*/

//criando class
class Usuario{
/*----------------------------------------------------------------------------------------------------------------------- */
    //criando atributos das colunas da tabela

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;


/*---------------------------------------------------------------------------------------------------------------------- */
    //get e set dos atributos 

    public function getIdusuario(){
        return $this -> idusuario;
    }
    public function setIdusuario($idusuario){
        $this -> idusuario = $idusuario;
    }
    
    public function getDeslogin(){
        return $this -> deslogin;
    }
    public function setDeslogin($deslogin){
        $this -> deslogin = $deslogin;
    }

    public function getDessenha(){
        return $this -> dessenha;
    }
    public function setDessenha($dessenha){
          $this -> dessenha = $dessenha;
    }

    public function getDtcadastro(){
        return $this -> dtcadastro;
    }
    public function setDtcadastro($dtcadastro){
        $this -> dtcadastro = $dtcadastro;
    }

/*-------------------------------------------------------------------------------------------------------------------------------------------*/

                                    // __toString para mostrar os valores dos atributos para o objeto
                                    // __construct para inserir os valores nos atributos




/*-------------------------------------------------------------------------------------------------------------------------------------------*/
                    
                 /*(((((((((((((((((((((((((( MÉTODOS QUE USAM OS ATRIBOS DE FORMA GENÉRICAS )))))))))))))))))))))))))) */

    //método que envia valores para todos os atributos 
    public function result($row){
        $this -> setIdusuario($row['idusuario']);
        $this -> setDeslogin($row['deslogin']);
        $this -> setDessenha($row['dessenha']);
        //envia para o atributo um objeto dateTime 
        $this -> setDtcadastro(new DateTime($row['dtcadastro']));
    }

    //método que retira valores de todos os atributos e retorna como um array
    public function selectAtributs(){
        return array(
            "idusuario"=> $this -> getIdusuario(),
            "deslogin"=> $this -> getDeslogin(),
            "dessenha"=> $this -> getDessenha(),
            // o valor do atributo dtcadastro é um objeto que tem o valor e 
            //um método nativo datetime então da pra estanciar de novo esse valor para formatar como eu quiser 
            "dtcadastro"=> $this -> getDtcadastro() -> format("d/m/y H:i:s")
        );
    }




/*--------------------------------------------------------------------------------------------------------------------- */

                                    /*((((((((((((((((SELECT)))))))))))))))) */


    //criando método para dar um select pelo $ID DO usuario usando a class sql e o método select dela
    // só chama as linha que o id for informado no parâmetro
    // ele só preenche os atributos, quem vai dar algum return é o método magico toString
     public function loadById($id){
         $sql = new Sql();

         //objeto result vai ter o retorno do método select que é um array com os valores 
         // objeto $results contém um array e dentro desse array contem mais um array que é a linha 
         $results = $sql -> select("SELECT * FROM tb_usuarios2 WHERE idusuario = :ID", array(":ID"=>$id));

        //verificando se existe pelo menos a primeira linnha que foi chamada pelo parametro id
        if(count($results) > 0){
            // aqui ele ta colocando em uma variavel o primeiro array dentro do array maior que nesse caso é uma linha
            $row = $results[0];
            
            //aqui ele chama o método génerico que envia todos os valores do array para os atributos
            $this -> result($row);
    
            
         }
     }


     //método para trazer uma lista de linhas definidas pelo nome (idusuario)
     public static function getList(){
         //chama a class sql 
         $sql = new Sql();
         
        //usa o método que devolve em um array o que foi requisitado no comando sql bruto
        return $sql -> select("SELECT * FROM tb_usuarios2 ORDER BY deslogin;");
     }


     //método que retorna uma linha especifica definindo apenas o deslogin
     public static function search($login){
         $sql = new Sql();

         // retorno do método select que executa o comando bruto sql  que é 
         //selecione todos da tabela usuarios2 usando a coluna deslogin e nessa coluna trazer somentes os que começam com a ou as letras tal
         // na ordem que esta a coluna deslogin da tabela usuarios2 
         return $sql -> select("SELECT * FROM tb_usuarios2 WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(":SEARCH" =>"%" .$login ."%"));
     }


     //método que retorna tudo da linha se o usuario e a senha estiverem corretos 
     public function login($login, $password){
        $sql = new sql();

         //objeto result vai ter o retorno do método select que é um array com os valores 
         // objeto $results contém um array e dentro desse array contem mais um array que é a linha 
         // aqui ele só vai retornar se ambos os parâmetros existirem na tabela
         $results = $sql -> select("SELECT * FROM tb_usuarios2 WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(":LOGIN"=>$login, ":PASSWORD"=>$password));

         //verificando se existe pelo menos a primeira linnha que foi chamada pelo parametro id
         if(count($results) > 0){
            // aqui ele ta colocando em uma variavel o primeiro array dentro do array maior que nesse caso é uma linha
            $row = $results[0];
            
            //aqui ele chama o método génerico que envia todos os valores do array para os atributos
            $this -> result($row);
            
            //se não retornar nada, é porque não tinha uma linha com esses parâmetros passados resumindo, usuario ou senha errado 
         } else{
             //estourando uma excessão se der else
            throw new Exception("login e/ou senha invalidos.");
         }
     }



     //método mágico tostring que escreve algo na tela quando da um echo no objeto
    // tentar deixar somente esse método usando os atributos da class
     public function __toString(){

        //ele vai retorna um dado json criado com um array formado dos atributos 
         return json_encode($this -> selectAtributs());
     }

     /*--------------------------------------------------------------------------------------------------------------------- */

                                    /*(((((((((((((((( INSERT )))))))))))))))) */

     // método insert ele insere uma linha e preenche os atributos com a linha inserida na tabela
     public function insert(){
         
        //instancea a class sql pra executar algum comando
        $sql = new Sql();

        //executa o método SELECT PORQUE ele só não inseriri uma tabela mas vai retornar a linha inserida e o método select pega essa linha e
        //transforma em um array de arrays no caso só um array porque ele retorna só uma linha 
        $result = $sql -> select("CALL sp_usuarios_insert(:DESLOGIN, :DESSENHA)",  array( // CALL (usado para usar um PROSEGURI)
            
            //ele vai inserir no atributo pelo método setDeslogin e setDessenha no objeto no arquivo index
            ":DESLOGIN" => $this-> getDeslogin(),
            ":DESSENHA" => $this -> getDessenha()
        ) );

        //verifica se retornou algum array 
        if (count($result) > 0) {
            
            //envia para os atributos
            $this -> result($result[0]);
        }
     }                                       
 

     //MÉTODO MAGICO CONSTRUTUTOR PARA INSERIR VALORES NOS ATRIBUTOS e coloca opcional a passagem de parâmetros
     public function __construct($login = "", $password = ""){
        $this -> setDeslogin($login);
        $this -> setDessenha($password);


     }

 
/*--------------------------------------------------------------------------------------------------------------------- */

                                /*(((((((((((((((( UPDATE )))))))))))))))) */


    //depois de prencher os atributos  da linha que eu quero mudar com o método loadbyid o método update pega os novos valores
    // e pega o id da linha no atributo preenchido com o método loadbyid e altera a tabela executando o query
    // depois da usa o __toString pra ver como ficou a linha alterada
     public function update($login, $password){
        $this -> setDeslogin($login);
        $this -> setDessenha($password);

         $sql = new Sql();

         $sql -> query("UPDATE tb_usuarios2 SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario =  :ID; ",
        array(
            ":LOGIN" => $this -> getDeslogin(),
            ":PASSWORD" => $this -> getDessenha(),
            ":ID" => $this -> getIdusuario()
        ));
     }





}
?>