<?php require_once '../include/header.php'; ?>
<?php require_once '../include/menu.php'; ?>
<div align="center" class="fundo">
    <h1 class="titulo">Previsão da Escala de Serviço</h1>
    <h2 class="subtitulo"><?= strtoupper($object->getLogin()) ?></h2>
    <iframe id="escala" src='data:<?= $object->getMime() ?>;base64,<?= base64_encode($object->getEscala()) ?>' width='800' height='340' style="border:0;"></iframe>        
</div>
</div>
<script>
    var _theframe = document.getElementById("escala");
    _theframe.contentWindow.location.href = _theframe.src;
</script>
<?php
require_once '../include/footer.php';



