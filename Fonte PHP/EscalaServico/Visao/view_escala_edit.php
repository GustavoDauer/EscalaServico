<?php require_once '../include/header.php'; ?>        
<?php require_once '../include/menu.php'; ?>   
<div align="center" class="fundo">
    <h1 class="titulo">Previsão da Escala de Serviço</h1>
    <h2 class="subtitulo">Oficiais, Sargentos e Cabos</h2>
    <form action="../Controlador/UsuarioController.php?acao=escalaEdit" method="post" enctype="multipart/form-data">   
        <table border="0" cellpadding="7" cellspacing="0">
            <tr>
                <td class="form-label">Usuário:</td>
                <td>
                    <select name="idUsuario">
                        <?php
                        if (isset($usuarioList)) {
                            foreach ($usuarioList as $usuario):
                                ?>                            
                                <option value="<?= $usuario->getId() ?>" <?= isUserAdmin($usuario->getLogin()) ? " disabled" : "" ?>><?= $usuario->getLogin() ?></option>                                                    
                                <?php
                            endforeach;
                        }
                        ?>
                    </select>
                </td>
            </tr>                
            <tr>
                <td class="form-label">Previsão:</td>
                <td><input type="file" name="escala" style="color: blue; font-weight: bold;"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Editar"></td>
            </tr>
        </table>                    
    </form>
</div>
<?php
require_once '../include/footer.php';



