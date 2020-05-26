<?php 

//criar a função nativa auto load (ela pega o nome depois do NEW do USE e troca pela variavel $nomeClass que é o parametro)
// 
spl_autoload_register(function($nomeClass){
    //variavel com o nome da pasta
    $dirClass = "class";
    
    //variavel com o caminho que o requeri vai usar 
    $fileName = $dirClass . DIRECTORY_SEPARATOR .$nomeClass . ".php";
    if ( file_exists($fileName) ) {
        require_once ($fileName);
    }
})

?>