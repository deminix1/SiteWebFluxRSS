<?php

require 'metier/News.php';

class NewsGateway {

    private $_con;

    public function __construct($con) {
        $this->_con = $con;
    }

    public function nbNews() : int{
        $query = "SELECT count(*) FROM news";
        $this->_con->executeQuery($query, array());
        $results = $this->_con->getResults();
        return $results[0]["count(*)"];
    }

    public function TabNews($res){
        $array =array();
        foreach ($res as $news) {
            $array[] = new News( $news['titre'], $news['description'], $news['lien'], $news['date']);
        }
        return $array;
    }

    public function findAllNews():array{
        $query = "SELECT * FROM news";
        $this->_con->executeQuery($query);
        $res = $this->_con->getResults();
        return $this->TabNews($res);
    }

    public function getNewsPage($first,$newsByPage){
        $res=array();
        $query="SELECT * FROM news ORDER BY date desc limit :first, :last";
        $this->_con->executeQuery($query,array(
            ':first'=>array($first,PDO::PARAM_INT),
            ':last'=>array($newsByPage,PDO::PARAM_INT)));
        $res=$this->_con->getResults();
        return $this->TabNews($res);
    }

    public function insertNews(News $news){
        $date=new DateTime($news->get_Date());
        $query = "INSERT INTO `news`(`titre`,`description`,`lien`,`date`) VALUES (:titre,:description,:lien,:date)";
        $this->_con->executeQuery($query, array(
            ':titre' => array($news->get_Titre(),PDO::PARAM_STR),
            ':description' => array($news->get_Description(),PDO::PARAM_STR),
            ':lien' => array($news->get_Lien(),PDO::PARAM_STR),
            ':date' => array($date->format("Y-m-d H:i:s"),PDO::PARAM_STR)));
    }

    public function delNews($titre){
        $query='DELETE FROM news WHERE titre=:titre';
        $this->_con->executeQuery($query,array(':titre'=>array($titre,PDO::PARAM_STR)));
    }

    public function changerNbNews($nbAncien,$nbNouveau){
        $query='UPDATE `autre` SET `nbNews`=:nbNouveau WHERE `nbNews`=:nbNews';
        $this->_con->executeQuery($query,array(
            ':nbNews'=>array($nbAncien,PDO::PARAM_INT),
            ':nbNouveau'=>array($nbNouveau,PDO::PARAM_INT),
        ));
    }

    public function getNbNewsParPage() : int{
        $query='SELECT nbNews FROM autre';
        $this->_con->executeQuery($query);
        $res=$this->_con->getResults();
        return $res[0]['nbNews'];
    }

    public function newsExiste($titre): bool{
        $query="SELECT count(*) FROM news WHERE titre=:titre";
        $this->_con->executeQuery($query,array(':titre'=>array($titre,PDO::PARAM_STR)));
        $results = $this->_con->getResults();
        if($results[0]["count(*)"]==1){
            return true;
        }else{
            return false;
        }
    }

    public function suppNewsPlusAncienne(){
        $query="DELETE FROM news ORDER BY date LIMIT 1";
        $this->_con->executeQuery($query);
    }
}
