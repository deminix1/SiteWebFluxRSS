<?php

class Validation{

    static function val_action($action){
        if (!isset($action)){
            throw new Exception("Il n'y a pas d'action");
        }
        if ($action = !filter_var($action, FILTER_SANITIZE_STRING)) {
            throw new Exception("Tentative de piratage en injectant du code par l'action");
        }
        return $action;
    }

    static function val_Page($page){
        if (!isset($page) || $page == "") {
            throw new Exception("Problème page vide");
        }
        if ($page!=filter_var($page, FILTER_VALIDATE_INT)) {
            throw new Exception("Injection de code par le numéro de page");
        }
    }

    static function val_string($string) {
        if(!isset($string) || $string == "") {
            throw new Exception("Le string est vide");
        }
        if ($string = !filter_var($string, FILTER_SANITIZE_STRING)) {
            throw new Exception("Tentative de piratage en injectant du code par un string");
        }
    }

    static function val_url($url) {
        if(!isset($url) || $url == ""){
            throw new Exception("URL non saisi");
        }
        if ($url=!filter_var($url, FILTER_SANITIZE_URL)) {
            throw new Exception("Tentative de piratage en injectant du code par l'URL");
        }
    }

    static function val_form(string $nom, string $mdp){
        //Validation du nom d'utilisateur
        if (!isset($nom)||$nom==""){
            throw new Exception("Veuillez remplir le champs du nom d'utilisateurs");
        }

        if ($nom!=filter_var($nom, FILTER_SANITIZE_STRING)){
            throw new Exception("Tentative de piratage en injectant du code par le nom d'utilisateur");
        }

        if ($nom!=filter_var($nom, FILTER_SANITIZE_SPECIAL_CHARS)){
            throw new Exception("Vous ne pouvez pas mettre de caractères spéciaux dans le nom d'utilisateur");
        }

        //Validation du mot de passe
        if (!isset($mdp)||$mdp==""){
            throw new Exception("Veuillez remplir le champs du mot de passe");
        }

        if ($mdp!=filter_var($mdp, FILTER_SANITIZE_STRING)){
            throw new Exception("Tentative de piratage en injectant du code par le mot de passe");
        }

        if (strlen($mdp)<3){
            throw new Exception("Le mot de passe est trop court il doit contenir au minimum 3 caractères");
        }
    }
}

