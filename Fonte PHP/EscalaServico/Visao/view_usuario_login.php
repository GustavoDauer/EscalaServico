<?php
require_once '../include/conexao.php';
require_once '../include/header.php';
if (isLoggedIn()) {
    session_destroy();
}
?>        
<div align="center" class="fundo">
    <h1 class="titulo">Previsão da Escala de Serviço</h1>
    <h2 class="subtitulo">Oficiais, Sargentos e Cabos</h2>
    <form action="../Controlador/UsuarioController.php?acao=login" method="post">   
        <table border="0" cellpadding="7" cellspacing="0">
            <tr>
                <td class="form-label">Login:</td>
                <td><input type="text" name="login" style="color: blue;" maxlength="250"></td>
            </tr>
            <tr>
                <td class="form-label">Senha:</td>
                <td><input type="password" name="senha" style="color: blue;" maxlength="250"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Entrar"></td>
            </tr>
        </table>                    
    </form>
</div>
<?php
require_once '../include/footer.php';



