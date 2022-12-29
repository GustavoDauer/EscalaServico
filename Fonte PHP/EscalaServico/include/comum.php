<?php
session_start();

function isLoggedIn() {
    return (isset($_SESSION["id"]) && isset($_SESSION["login"]));
}

function isAdmin() {
    return isLoggedIn() && ($_SESSION["login"] == 'brigada' || $_SESSION["login"] == 's1');
}

function isUserAdmin($login) {
    return ($login == 'brigada' || $login == 'scmt');
}

function redirectToLogin() {
    header("Location: ../Visao/view_usuario_login.php?error=1");
}

function getResult($erro, $url, $aguarde, $sucesso, $problema, $mensagemErro, $tempo) {
    if ($erro == false) {
        ?>
        <h2 style="font-size: 25px; font-family: sans-serif; color: orange; margin: 7px; text-align: center;" id="sucesso"><?= $aguarde ?></h2>
        <h2 style="font-size: 20px; font-family: sans-serif; color: blue; margin: 7px; text-align: center; visibility: hidden;" id="redirecionamento">Redirecionando em <span id="segundos"></span>...</h2>      
        <script type="text/javascript">
            function sucesso() {
                document.getElementById("sucesso").innerHTML = "<?= $sucesso ?>";
                document.getElementById("sucesso").style.color = "darkgreen";
                document.getElementById("redirecionamento").style.visibility = "visible";
            }

            setInterval(sucesso, 1000);
        </script>
        <?php
    } else {
        ?>
        <h2 style="font-size: 25px; font-family: sans-serif; color: red; margin: 7px; text-align: center;"><?= $problema ?></h2>
        <p style="font-size: 16px; font-family: sans-serif; color: red; margin: 7px; text-align: center;"><?= $mensagemErro ?></p>
        <h2 style="font-size: 20px; font-family: sans-serif; color: blue; margin: 7px; text-align: center;">Redirecionando em <span id="segundos"></span>...</h2>                
        <?php
    }
    ?>
    <script type="text/javascript">
        i = <?= $tempo ?>;

        function contagem() {
            if (i == 0) {
                document.location = "<?= $url ?>";
            }

            document.getElementById("segundos").innerHTML = i;
            i--;
        }

        contagem();
        setInterval(contagem, 1000);
    </script>
    <?php
}
?>
