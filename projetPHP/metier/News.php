<?php

class News {

    private $_titre;
    private $_description;
    private $_lien;
    private $_date;

    public function __construct( $titre, $description, $lien, $date) {
        $this->_titre = $titre;
        $this->_description = $description;
        $this->_lien = $lien;
        $this->_date = $date;
    }

    public function get_Titre() {
        return $this->_titre;
    }

    function get_Description() {
        return $this->_description;
    }

    function get_Lien() {
        return $this->_lien;
    }

    function get_Date() {
        return $this->_date;
    }


}
