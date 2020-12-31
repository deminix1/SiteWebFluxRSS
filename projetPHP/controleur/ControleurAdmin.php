<?php

class ControleurAdmin
{
    function __construct($action) {
        //Utilisation des variables globales
        global $rep,$vues;
        //Initialisation tableau d'erreurs
        $VueErreur = array ();
        try{
            //Validation::val_action($action,$VueErreur);

            switch ($action) {

                case 'PageAdmin':
                    $this->afficherFlux();
                    break;

                case 'deconnecter':
                    $this->deconnexion();
                    break;

                case 'supprimerFlux':
                    $this->supprimerFlux();
                    break;

                case 'ajouterFlux':
                    $this->ajouterFlux();
                    break;

                case 'changerNbNews':
                    $this->changerNbNews();
                    break;

                default:
                    throw new Exception('Page demandée N EXISTE PAS');
            }

        } catch (PDOException $e){
            $VueErreur[]="Erreur inattendue PDOException!!! ";
            require ($rep.$vues['erreur']);

        }
        catch (Exception $e2){
            $VueErreur[]="Erreur inattendue!!! ";
            require ($rep.$vues['erreur']);
        }
        exit(0);
    }

    private function deconnexion(){
        unset($_SESSION['login']);
        unset($_SESSION['role']);
        header("Location: ./?action=afficherNews");
        exit ;
    }

    private function afficherFlux(){
        global $rep, $vues;
        $model=new ModelA();
        $tabFlux=$model->get_Flux();
        require ($rep.$vues['PageAdmin']);
    }

    private function ajouterFlux(){
        $URL = $_POST['url'];
        Validation::val_url($URL);
        $modelA=new ModelA();
        $modelCookie=new ModelCookie();
        $modelCookie->nbFoisAjouterFlux();
        $channel = new SimpleXMLElement($URL, NULL, TRUE);
        $modelA->ajouterFlux($channel);
        $model=new Model();
        $model->newNews($channel);
        header("Location: ./?action=PageAdmin");
        exit ;
    }

    private function supprimerFlux(){
        $URL = $_POST['url'];
        Validation::val_url($URL);
        $modelCookie=new ModelCookie();
        $modelCookie->nbFoisSupprimerFlux();
        $channel = new SimpleXMLElement($URL, NULL, TRUE);
        $model=new ModelA();
        $model->supprimerFlux($channel);
        header("Location: ./?action=PageAdmin");
        exit ;
    }

    private function changerNbNews(){
        $nb = $_POST['nbnews'];
        Validation::val_Page($nb);
        $model=new ModelA();
        $model->changerNbNews($nb);
        header("Location: ./?action=PageAdmin");
        exit ;
    }
}