<?php
require_once '../include/conexao.php';
require_once '../include/header.php';
require_once '../include/menu.php';
?>        
<div align="center" class="fundo">
    <h1 class="titulo">Previsão da Escala de Serviço</h1>
    <h2 class="subtitulo">Oficiais, Sargentos e Cabos</h2>
    <form action="../Controlador/UsuarioController.php?acao=usuarioEdit" method="post">          
        <table border="0" cellpadding="7" cellspacing="0">
            <tr>
                <td colspan="2">
                    <select name="idUsuario">
                        <?php
                        if (isset($objectList)) {
                            foreach ($objectList as $usuario):
                                ?>                            
                                <option value="<?= $usuario->getId() ?>"><?= $usuario->getLogin() ?></option>                                                    
                                <?php
                            endforeach;
                        }
                        ?>
                    </select>
                </td>                
            </tr>
            <tr>
                <td class="form-label">Nova senha:</td>
                <td><input type="password" name="senha" style="color: blue;" maxlength="25"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Editar"></td>
            </tr>
        </table>                    
    </form>
</div>
<?php
require_once '../include/footer.php';



