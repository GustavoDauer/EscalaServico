<?php if (isLoggedIn()) { ?>
    <a href="UsuarioController.php?acao=logout">Sair</a><br>
<?php } ?>
<?php if (isAdmin()) { ?>
    <a href="UsuarioController.php?acao=escalaEdit">Editar previsões</a>
    | <a href="UsuarioController.php?acao=usuarioEdit">Editar senhas</a><br>
    Visualizar previsão de: 
    <?php
    foreach ($objectList as $usuario) {
        if (isUserAdmin($usuario->getLogin()))
            continue;
        ?>      
        <a href="UsuarioController.php?acao=escala&id=<?= $usuario->getId(); ?>"><?= $usuario->getLogin(); ?></a> |
        <?php
    }
    ?>
<?php } ?>   
<hr>