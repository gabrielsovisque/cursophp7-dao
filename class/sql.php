<?php

/*
------------- CLASS SQL DIVIDIDO POR BANCO ( 
                    retorna somente a execução de um comando com seus parâmatro(PREPARE, BINDPARAM E EXECUTE()
                )
                    -primeiro método magico( 
                        - faz uma conexão com o banco usando um método do pdo 
                    )
                    - segindo método query( 
                        - chama o método prepare
                        - chama o método params
                        - chama o execute 
                                          )
                    - terceiro método params(
                        - da um foreach no array de parametros passados para o método query 
                        - dentro de cada loço que o foreach executar ele chama outro método que é o parame
                        )
                    - quarto método o param(
                        - faz um bin_parame nos parametros passados pelo método parames que são chave e valor
                    )

) ---------------
*/
// class sql e tambem podendo usar o pdo dentro da class sem usar um objeto
class SQL extends PDO {
    //criando atributo que contem informações da conexão
    private $conn;

    //criando método mágico construct para a conexão
    public function __construct(){
        $this -> conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
    }

    //método que vai fazer o foreach pra poder chamar o método que vai usar o bin_param
    //ele recebe o parametro statment porque o bindParam usa ele
    private function params($stmt, $params = array()){
        foreach ($params as $key => $value) {
            $this -> param($stmt, $key, $value);
        }
    
    }

    // método que vai executar o bindParam
    private function param($stmt, $key, $value){
        $stmt -> bindParam($key, $value);
        
    }


    //método para executar uma query que que recebe o sqlBruto e os parâmetro
    //PREPARE EXECUTA 
    //BINDPARA PRECISA DE DOIS MÉTODOS, UM PARA 
    public function query($rawQuery, $params = array()){
        //defindo os comandos
        $stmt = $this -> conn -> prepare($rawQuery);
        $this -> params($stmt, $params );
        $stmt -> execute();

        //((((((((((((OBJETOS ESTANCIAM(possuem) OUTROS OBJETOS E OUTROS MÉTODOS E ATRIBUTOS))))))))))))

        // ((((((((((((((((((ESSE OBJETO $STMT  TEM  O OBJETO CONEXÃO(ESSA OBJETO CONEXÃO TEM O MÉTODO PREPARE E O MÉTODO CONEXÃO  
        //) E O MÉTODO BINDPARAM E O MÉTODO EXECUTE 
        //))))))))))))))))))
        return $stmt; // E AGORA EU ENVIO ESSE OBJETO
        
    }
//método que faz acrecenta um fetchall e bota isso tudo em um array e envia para o objeto
    public function select($rawQuery, $params = array()):array{
        $stmt = $this -> query($rawQuery, $params);
        
        //coloca em um array que tem arrays formados com linhas do banco de dados no caso só as linhas definidas com o id
       return $stmt -> fetchall(PDO::FETCH_ASSOC);

    }

    //public function select($rawQuery, $params = array()){
        //$this -> query($rawQuery, $params = array());
    
   // }
}

?>