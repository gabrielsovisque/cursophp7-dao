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


/*--------------------------------------------------------------------------------------------------------------------- */

                                    /*((((((((((((((((SELECT)))))))))))))))) */


    //criando método para dar um select pelo $ID DO usuario usando a class sql e o método select dela
    // só chama as linha que o id for informado no parâmetro
    // ele só preenche os atributos, quem vai dar algum return é o método magico toString
     public function loadById($id){
         $sql = new sql();

         //objeto result vai ter o retorno do método select que é um array com os valores 
         // objeto $results contém um array e dentro desse array contem mais um array que é a linha 
         $results = $sql -> select("SELECT * FROM tb_usuarios2 WHERE idusuario = :ID", array(":ID"=>$id));

         //verificando se existe pelo menos a primeira linnha que foi chamada pelo parametro id
         if(count($results) > 0){
            // aqui ele ta colocando em uma variavel o primeiro array dentro do array maior que nesse caso é uma linha
            $row = $results[0];
            
            //aqui ele ta enviando os dados dessa subarray que na verdade é uma linha para o atributo 
            $this -> setIdusuario($row['idusuario']);
            $this -> setDeslogin($row['deslogin']);
            $this -> setDessenha($row['dessenha']);
            //envia para o atributo um objeto dateTime 
            $this -> setDtcadastro(new DateTime($row['dtcadastro']));
         }
     }



     //método mágico tostring que escreve algo na tela quando da um echo no objeto
     public function __toString(){

        //ele vai retorna um dado json criado com um array formado dos atributos 
         return json_encode(array(
             "idusuario"=> $this -> getIdusuario(),
             "deslogin"=> $this -> getDeslogin(),
             "dessenha"=> $this -> getDessenha(),
             // o valor do atributo dtcadastro é um objeto que tem o valor e 
             //um método nativo datetime então da pra estanciar de novo esse valor para formatar como eu quiser 
             "dtcadastro"=> $this -> getDtcadastro() -> format("d/m/y H:i:s")
         ));
     }
}
?>