<?php

require_once '../include/conexao.php';
require_once '../include/comum.php';
require_once '../Modelo/Usuario.php';
require_once '../DAO/UsuarioDAO.php';

class UsuarioController {

    private $instance, $instanceDAO;

    public function getFormData() {
        $this->instance = new Usuario();
        $this->instance->setId(filter_input(INPUT_POST, "idUsuario", FILTER_VALIDATE_INT));
        $this->instance->setLogin(filter_input(INPUT_POST, "login", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_SANITIZE_ADD_SLASHES));
        $this->instance->setSenha(!empty(filter_input(INPUT_POST, "senha", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_SANITIZE_ADD_SLASHES)) ? md5(filter_input(INPUT_POST, "senha", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_SANITIZE_ADD_SLASHES)) : null);
        $this->instance->setEscala(filter_input(INPUT_POST, "escala")); // TODO filtros
    }

    public function login() {
        try {
            $this->getFormData();
            $this->instanceDAO = new UsuarioDAO();
            $object = $this->instanceDAO->login($this->instance);
            if (isset($object)) {
                $_SESSION["id"] = $object->getId();
                $_SESSION["login"] = $object->getLogin();
                $_SESSION["escala"] = $object->getEscala();
                $_SESSION["mime"] = $object->getMime();
                header("Location: UsuarioController.php?acao=escala");
            } else {
                throw("Falha ao logar no sistema!");
            }
        } catch (Exception $e) {
            require_once '../Visao/view_error.php';
        }
    }

    public function logout() {
        $_SESSION["id"] = null;
        $_SESSION["login"] = null;
        $_SESSION["senha"] = null;
        $_SESSION["escala"] = null;
        $_SESSION["mime"] = null;
        session_destroy();
        header("Location: ../Visao/view_usuario_login.php");
    }

    public function verEscala() {
        try {
            if (isLoggedIn()) {
                if (isAdmin()) {
                    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                } else {
                    $id = $_SESSION["id"];
                }
                $id = isset($id) ? $id : $_SESSION["id"];
                $this->instance = new Usuario();
                $this->instanceDAO = new UsuarioDAO();
                if (isAdmin()) {
                    $objectList = $this->instanceDAO->getAllList();
                }
                $this->instance = $this->instanceDAO->escala($id);
                $object = $this->instance;
                require '../Visao/view_escala.php';
            } else {
                redirectToLogin();
            }
        } catch (Exception $e) {
            require_once '../Visao/view_error.php';
        }
    }

    public function editarEscala() {
        try {
            if (isAdmin()) {
                $id = filter_input(INPUT_POST, "idUsuario", FILTER_VALIDATE_INT);
                $this->instance = new Usuario();
                $this->instance->setId($id);
                $this->instanceDAO = new UsuarioDAO();
                $objectList = $this->instanceDAO->getAllList();
                if (!empty($_FILES["escala"]["tmp_name"])) {
                    if ($this->instanceDAO->editaPrevisaoEscala($this->instance, $_FILES["escala"])) {
                        $fileData = addslashes(file_get_contents($_FILES["escala"]["tmp_name"]));
                        $type = $_FILES["escala"]["type"];
                        $this->instance->setEscala($fileData);
                        $this->instance->setMime($type);
                        $object = $this->instance;
                        getResult(false, "UsuarioController.php?acao=escalaEdit", "Aguarde!", "Arquivo enviado com sucesso!<br><a href='UsuarioController.php?acao=escala&id=$id'>Visualizar</a>", "Problema!", "Ocorreu um problema na solicitação!", 5);
                        //header("Location: UsuarioController.php?acao=escalaEdit");
                    } else {
                        throw new Exception("Erro ao enviar o arquivo!");
                    }
                } else {
                    $usuarioList = $this->instanceDAO->getAllList();
                    require_once '../Visao/view_escala_edit.php';
                }
            } else {
                redirectToLogin();
            }
        } catch (Exception $e) {
            require_once '../Visao/view_error.php';
        }
    }

    public function editarSenhas() {
        try {
            if (isAdmin()) {
                $this->getFormData();
                $this->instanceDAO = new UsuarioDAO();
                if (!empty($this->instance->getSenha())) {
                    if ($this->instanceDAO->update($this->instance)) {
                        getResult(false, "UsuarioController.php?acao=usuarioEdit", "Aguarde!", "Senha atualizada com sucesso!", "Problema!", "Ocorreu um problema na solicitação!", 2);
                    } else {
                        throw new Exception("Problema ao atualizar a senha!");
                    }
                } else {
                    $objectList = $this->instanceDAO->getAllList();
                    require_once '../Visao/view_usuario_edit.php';
                }
            } else {
                throw new Exception("Sem permissão!");
            }
        } catch (Exception $e) {
            require_once '../Visao/view_error.php';
        }
    }

}

$acao = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_SANITIZE_ADD_SLASHES);
$controller = new UsuarioController();

switch ($acao) {
    case "login" : $controller->login();
        break;
    case "logout" : $controller->logout();
        break;
    case "escala" : $controller->verEscala();
        break;
    case "escalaEdit" : $controller->editarEscala();
        break;
    case "usuarioEdit" : $controller->editarSenhas();
        break;
}