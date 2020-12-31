<?php

class FluxGateway
{
    private $_con;

    public function __construct($con) {
        $this->_con = $con;
    }

    public function TabFlux($res){
        $array =array();
        foreach ($res as $flux) {
            $array[] = new Flux($flux['titre'], $flux['description'], $flux['lien']);
        }
        return $array;
    }

    public function findAllFlux(): array{
        $query = "SELECT * FROM flux";
        $this->_con->executeQuery($query);
        $res = $this->_con->getResults();
        return $this->TabFlux($res);
    }

    public function insertFlux($titre, $description, $lien){
        $query = "INSERT INTO `flux`(`titre`,`description`,`lien`) VALUES (:titre,:description,:lien)";
        $this->_con->executeQuery($query, array(
            ':titre' => array($titre,PDO::PARAM_STR),
            ':description' => array($description,PDO::PARAM_STR),
            ':lien' => array($lien,PDO::PARAM_STR)));
    }

    public function delFlux($titre){
        $query='DELETE FROM flux WHERE titre=:titre';
        $this->_con->executeQuery($query,array(':titre'=>array($titre,PDO::PARAM_STR)));
    }

    public function nbFlux() : int{
        $query = "SELECT count(*) FROM flux";
        $this->_con->executeQuery($query, array());
        $results = $this->_con->getResults();
        return $results[0]["count(*)"];
    }

    public function fluxExiste($titre): bool{
        $query="SELECT count(*) FROM flux WHERE titre=:titre";
        $this->_con->executeQuery($query,array(':titre'=>array($titre,PDO::PARAM_STR)));
        $results = $this->_con->getResults();
        $nb=$results[0]["count(*)"];
        if($nb==1){
            return true;
        }else{
            return false;
        }
    }
}