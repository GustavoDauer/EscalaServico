<?php require_once '../include/header.php'; ?>
<script type="text/javascript">
    function showInformacoesAdicionais() {
        var x = document.getElementById("informacoesAdicionais");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
<div class="container mt-3">
    <hr>    
    <?php if (isset($e)) { ?>
        <div class="alert alert-danger">
            <strong>ERRO</strong><hr> <?= $e->getMessage() ?> <br><br>            
        </div>
    <?php } ?>
    <a href="#" onclick="history.back(-1);">Retornar a página anterior</a>
</div>

<?php require_once '../include/footer.php'; ?>