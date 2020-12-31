<?php

class ModelA{

    public function validerConnexion($pseudo,$password) {
        global $user, $pass, $dsn;
        $gateway = new AdminGateway(new Connection($dsn, $user, $pass));

        if ($gateway->validerConnexion($pseudo, $password)) {
            $_SESSION['login'] = $pseudo;
            $_SESSION['role'] = 'admin';
        } else {
            throw new Exception("Le mot de passe ou le pseudo sont pas bon");
        }
    }

    public static function isAdmin() : bool {
        if(isset($_SESSION['login']) && isset($_SESSION['role']) && $_SESSION['role']=='admin') {
            return true;
        }else{
            return false;
        }
    }

    public function get_Flux() : array{
        global $user, $pass, $dsn;
        $gateway= new FluxGateway(new Connection($dsn, $user, $pass));
        return $gateway->findAllFlux();
    }

    public function ajouterFlux($channel){
        global $user, $pass, $dsn;
        $gateway= new FluxGateway(new Connection($dsn, $user, $pass));
        foreach ($channel as $c) {
            $titre=$c->title;
            $description=$c->description;
            $lien=$c->link;
            $bool=$gateway->fluxExiste($titre);
            if($bool){
                throw new Exception("Le flux a ajouter existe déja !");
            }else{
                $gateway->insertFlux($titre, $description, $lien);
            }
        }
    }

    public function supprimerFlux($channel){
        global $user, $pass, $dsn;
        $gatewayNews= new NewsGateway(new Connection($dsn, $user, $pass));
        $gatewayFlux= new FluxGateway(new Connection($dsn, $user, $pass));
        foreach ($channel as $c) {
            $titre = $c->title;
            $bool=$gatewayFlux->fluxExiste($titre);
            if($bool){
                $gatewayFlux->delFlux($titre);
            }else{
                throw new Exception("Le flux a supprimer n'existe pas !");
            }
        }
        foreach ($channel->xpath('//item') as $item) {
            $titre = $item->title;
            $gatewayNews->delNews($titre);
        }
    }

    public function changerNbNews($nb){
        global $user, $pass, $dsn;
        $gateway= new NewsGateway(new Connection($dsn, $user, $pass));
        $nbAncien=$gateway->getNbNewsParPage();
        $gateway->changerNbNews($nbAncien,$nb);
    }

    public function getNbNews(){
        global $user, $pass, $dsn;
        $gateway= new NewsGateway(new Connection($dsn, $user, $pass));
        return $gateway->getNbNewsParPage();
    }

    public function getNbFlux(){
        global $user, $pass, $dsn;
        $gateway= new FluxGateway(new Connection($dsn, $user, $pass));
        return $gateway->nbFlux();
    }
}

