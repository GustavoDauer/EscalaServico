<?php

require_once '../Modelo/Usuario.php';
require_once '../include/conexao.php';

class UsuarioDAO {

    public function getAllList() {
        try {
            $c = connect();
            $sql = "SELECT * "
                    . " FROM Usuario";
            $result = $c->query($sql);
            while ($row = $result->fetch_assoc()) {
                $objectArray = $this->fillArray($row);
                $instance = new Usuario($objectArray);
                $lista[] = $instance;
            }
            $c->close();
            return isset($lista) ? $lista : null;
        } catch (Exception $e) {
            throw($e);
        }
    }

    public function escala($id) {
        try {
            $c = connect();
            $sql = "SELECT * "
                    . " FROM Usuario "
                    . " WHERE idUsuario = $id";
            $result = $c->query($sql);
            while ($row = $result->fetch_assoc()) {
                $objectArray = $this->fillArray($row);
                $instance = new Usuario($objectArray);
            }
            $c->close();
            if (isset($instance)) {
                return $instance;
            } else {
                throw new Exception("ID de usuário não corresponde!");
            }
        } catch (Exception $e) {
            throw($e);
        }
    }

    public function login($object) {         
        $instance = null;
        try {
            $c = connect();
            $sql = "SELECT * "
                    . " FROM Usuario "
                    . " WHERE login = '" . $object->getLogin() . "' AND senha = '" . $object->getSenha() . "';";
            $result = $c->query($sql);
            while ($row = $result->fetch_assoc()) {
                $objectArray = $this->fillArray($row);
                $instance = new Usuario($objectArray);
            }
            $c->close();
            if (isset($instance)) {
                return $instance;
            } else {
                throw new Exception("Usuário e/ou senha não correspondem!");
            }
        } catch (Exception $e) {
            throw($e);
        }
    }

    public function fillArray($row) {
        return array(
            "id" => $row["idUsuario"],
            "login" => $row["login"],
            "senha" => $row["senha"],
            "escala" => $row["escala"],
            "mime" => $row["mime"]
        );
    }

    public function editaPrevisaoEscala($object, $escala) {
        try {
            $c = connect();
            $fileData = addslashes(file_get_contents($escala["tmp_name"]));
            $type = $escala["type"];
            $sql = "UPDATE Usuario SET escala = '$fileData', mime = '$type' "
                    . " WHERE idUsuario = " . $object->getId();
            $stmt = $c->prepare($sql);
            $sqlOk = $stmt->execute();
            $c->close();
            return $sqlOk;
        } catch (Exception $e) {
            throw($e);
        }
    }

    public function update($object) {
        try {
            $c = connect();
            $sql = "UPDATE Usuario SET "
                    . "senha = '" . $object->getSenha() . "' "
                    . " WHERE idUsuario = " . $object->getId() . ";";
            $stmt = $c->prepare($sql);
            $sqlOk = $stmt->execute();
            $c->close();
            return $sqlOk;
        } catch (Exception $e) {
            throw($e);
        }
    }

}
