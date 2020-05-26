<?php

/*
----------------- class usuario ( class que vai ser usada pelo objeto para a tabela em especifico usuarios2

) ----------------------
*/

//criando class
class Usuario{

    //criando atributos das colunas da tabela
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

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

    //criando método para dar um select pelo usuario usando a class sql e o método select dela
     public function loadById($id){
         $sql = new sql();

         //objeto result vai ter o retorno do método select que é um array com os valores 
         //no caso ele retorna uma linha só mais se adicionar mais id ele retorna mais linhas para o $results
         $results = $sql -> select("SELECT * FROM tb_usuarios2 WHERE idusuario = :ID", array(":ID"=>$id));

         //verificando se existe pelo menos a primeira linnha que foi chamada pelo parametro id
         if(count($results) > 0){
            // aqui ele ta colocando em uma variavel uma linha que o fetchaal retornou em array que no caso é o indice 0
            $row = $results[0];
            
            //aqui ele ta enviando os dados dessa subarray que na verdade é uma linha 
            $this -> setIdusuario($row['idusuario']);
            $this -> setDeslogin($row['deslogin']);
            $this -> setDessenha($row['dessenha']);
            $this -> setDtcadastro(new DateTime($row['dtcadastro']));
         }



     }

     //método mágico tostring que escreve algo na tela quando a class é instaceada pela primeira vez
     public function __toString(){

        //ele vai retorna um dado json criado com um array formado dos atributos 
         return $valor =  json_encode(array(
             "idusuario"=> $this -> getIdusuario(),
             "deslogin"=> $this -> getDeslogin(),
             "dessenha"=> $this -> getDessenha(),
             // o valor do atributo dacadastro é um método nativo datetime então da pra estanciar ele
             "dtcadastro"=> $this -> getDtcadastro() -> format("d/m/y H:i:s")
         ));

        
         
         /* 
        $valor = $this -> getDeslogin();
        $valor2 = $this -> getDessenha();
        $valor3 = $valor. " e ". $valor2;
        return  $valor3 ;
         */
     }
}
?>