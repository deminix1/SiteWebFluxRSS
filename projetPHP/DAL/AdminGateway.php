<?php

class AdminGateway {
    private $_con;

    public function __construct($con) {
        $this->_con = $con;
    }
    
    public function validerConnexion($login,$password) : bool{
        $query = "SELECT password FROM admin WHERE login=:login";
        $this->_con->executeQuery($query, array(
            ':login' => array($login,PDO::PARAM_STR)
        ));

        $res=$this->_con->getResults();
        if(isset($res[0]['password']) && password_verify($password,$res[0]['password'])){
            return true;
        }else{
            return false;
        }
    }

    public function reloadData($idSource){
        if($idSource == 0) return;
        $N = $this->getNbOfElementsKept();
        $source = $this->getSourceLinkFromId($idSource);
        $newsManager = new NewsGateway(Config::getDSN(), Config::$DBData["User"], Config::$DBData["Password"]);

        $parser = new RssParser($source);
        $articles = $parser->getNArticles($N);
        $newsManager->reloadNews($articles);
    }
}
