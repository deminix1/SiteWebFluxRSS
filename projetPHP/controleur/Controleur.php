<?php

class Controleur {

    function __construct($action) {
        //Utilisation des variables globales
        global $rep,$vues;

        try{
            switch($action) {

                case NULL:
                case "afficherNews":
                    $this->parDefaut();
                    break;

                case "seConnecter":
                    $this->ValidationFormulaire();
                    break;

                case "pageConnexion":
                    $this->Connexion();
                    break;

                case "rafraichir":
                    $this->rafraichir();
                    break;

                default:
                    throw new Exception('Page demandée inconnue page principal');
            }

        } catch (PDOException $e)
        {
            $VueErreur[] =	"Erreur inattendue PDOException!!! ";
            require ($rep.$vues['erreur']);

        }
        catch (Exception $e2)
        {
            $VueErreur[] =	"Erreur inattendue!!! ";
            require ($rep.$vues['erreur']);
        }
        exit(0);
    }

    function parDefaut(){
        global $rep, $vues;
        $model=new Model();
        $modelA=new ModelA();
        $nbNewsParPage=$modelA->getNbNews();
        if($nbNewsParPage==0){
            $nbNewsParPage=4;
        }
        $total=$model->nbNews();
        $nbPage=ceil($total/$nbNewsParPage);
        $page=(isset($_GET['page'])) ? abs(intval($_GET['page'])) : 1;
        $page= ($page==0) ? 1 : $page;
        Validation::val_Page($page);
        $premiereNews=($page-1)*$nbNewsParPage;
        $nbNews=$nbNewsParPage;
        $tabNews=$model->get_Newsdemande($premiereNews,$nbNews);
        require ($rep.$vues['PagePrincipal']);
    }

    function ValidationFormulaire() {
        $login = $_POST['login'];
        Validation::val_string($login);
        $password =$_POST['password'];
        Validation::val_string($password);
        Validation::val_form($login,$password);
        $model= new ModelA();
        $model->validerConnexion($login,$password);
        header("Location: ./?action=PageAdmin");
        exit ;
    }

    function Connexion(){
        global $rep, $vues;
        require ($rep.$vues['PageConnexion']);
    }

    private function rafraichir(){
        $modelA=new ModelA();
        $model=new Model();
        $tabFlux=$modelA->get_Flux();
        foreach ($tabFlux as $flux){
            $url=$flux->getLien();
            $channel = new SimpleXMLElement($url, NULL, TRUE);
            $model->newNews($channel);
        }
        $model->suppNewsEnTrop();
        header("Location: ./?action=afficherNews");
        exit ;
    }
}

