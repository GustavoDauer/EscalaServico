<?php

class Usuario {

    private $id, $login, $senha, $escala, $mime;

    function __construct($idOrRow = 0) {
        if (is_int($idOrRow)) {
            $this->id = $idOrRow;
        } else if (is_array($idOrRow)) {
            $this->id = $idOrRow["id"];
            $this->login = $idOrRow["login"];
            $this->senha = $idOrRow["senha"];
            $this->escala = $idOrRow["escala"];
            $this->mime = $idOrRow["mime"];
        }
    }

    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getEscala() {
        return $this->escala;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setEscala($escala) {
        $this->escala = $escala;
    }

    function getMime() {
        return $this->mime;
    }

    function setMime($mime) {
        $this->mime = $mime;
    }

}
