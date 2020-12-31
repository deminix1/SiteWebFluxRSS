<?php
class Admin {
    private $_login;
    private $_role;

    public function __construct($login, $role) {
        $this->_login = $login;
        $this->_role = $role;
    }

    public function getLogin() {
        return $this->_login;
    }

    public function getRole() {
        return $this->_role;
    }
}
