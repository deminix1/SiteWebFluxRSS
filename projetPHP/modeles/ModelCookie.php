<?php


class ModelCookie
{
    public function nbFoisAjouterFlux(){
        if(isset($_COOKIE["nbFoisAjouterFlux"])){
            $nb=filter_var($_COOKIE["nbFoisAjouterFlux"],FILTER_SANITIZE_NUMBER_INT);
            $nb=$nb+1;
        }else{
            $nb=1;
        }
        setcookie("nbFoisAjouterFlux",$nb,time()+3600*24);
    }

    public function nbFoisSupprimerFlux(){
        if(isset($_COOKIE["nbFoisSupprimerFlux"])){
            $nb=filter_var($_COOKIE["nbFoisSupprimerFlux"],FILTER_SANITIZE_NUMBER_INT);
            $nb=$nb+1;
        }else{
            $nb=1;
        }
        setcookie("nbFoisSupprimerFlux",$nb,time()+3600*24);
    }

    public static function getCookiesAjouter() :int {
        if (isset($_COOKIE["nbFoisAjouterFlux"])){
            $nb=$_COOKIE["nbFoisAjouterFlux"];
        }
        return $nb;
    }

    public static function getCookiesSupprimer(): int{
        if (isset($_COOKIE["nbFoisSupprimerFlux"])){
            $nb=$_COOKIE["nbFoisSupprimerFlux"];
        }
        return $nb;
    }
}