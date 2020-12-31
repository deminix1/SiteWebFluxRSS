<?php


class ControleurFront{

     function __construct() {

        global $rep,$vues;
        $tabActions=['afficherFlux','ajouterFlux','supprimerFlux','deconnecter','changerNbNews','PageAdmin'];
        $VueErreur = array ();
        session_start();

        try {
            $m=new ModelA();
            $admin=$m->isAdmin();

            if (isset($_REQUEST['action'])){
                $action = $_REQUEST['action'];
                Validation::val_action($action);
            }else {
                $action = null;
            }

            if (in_array($action, $tabActions)){
                if ($admin==true){
                        new ControleurAdmin($action);
                }else{
                    new Controleur('pageConnexion');
                }
            }else{
                new Controleur($action);
            }
        }

        catch (PDOException $e){
            $VueErreur[] =	"Erreur inattendue PDOException!!! ";
            require ($rep.$vues['erreur']);
        }

        catch (Exception $e2){
            $VueErreur[] =	"Erreur inattendue!!! ";
            require ($rep.$vues['erreur']);
        }
        exit(0);
    }
}