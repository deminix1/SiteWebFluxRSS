<?php


class Flux
{
    private $_titre;
    private $_description;
    private $_lien;

    public function __construct($titre, $description, $lien) {
        $this->_titre = $titre;
        $this->_description = $description;
        $this->_lien = $lien;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->_titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @return mixed
     */
    public function getLien()
    {
        return $this->_lien;
    }


}