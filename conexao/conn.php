<?php
define('HOST','localhost');
define('DATABASENAME','calazzans');
define('USER','root');
define('PASSWORD','');

/*crio uma classe*/
class Connect{
    /*posso usar ele em herança */
    protected $connection;
    /*esse construct vai rodar assim q minha classe for chamada */
    function __construct()
    {   
        $this->connectDatabase();
    }
    function connectDatabase(){
        try {
            /*aqui tento uma conexao com o banco de dados */
            $this->connection = new PDO('mysql:host='.HOST.';dbname='.DATABASENAME, USER, PASSWORD);
        } catch (PDDException $th) {
            /*caso nao conectar, mostrar erro */
            echo"erro".$th->getMessage();
            die();
        }
    }
    
}
?>