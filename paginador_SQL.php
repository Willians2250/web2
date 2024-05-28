<?php
define ('LIMITE_RESULTADO',10);
$hostDB='Chinook_Sqlite.sqlite';
$hostPDO="sqlite:$hostDB";
$miPDO=new PDO ($hostPDO);
$miPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES,FALSE);
$resultados=[];
$paginaActual=isset($_REQUEST['pagina'])? (int) $_REQUEST['pagina']:1;
$miConsulta=$miPDO->prepare('SELECT Name,(SELECT COUNT(*)FROM Artist)as cantidad FROM Artist ORDER BY Name ASC LIMIT :pagina,:limite;');
$miConsulta->execute([
    'pagina'=>($paginaActual-1)* LIMITE_RESULTADO,
    'limite'=>LIMITE_RESULTADO
]);
$resultados=$miConsulta->fetchALL();
$cantidad=$resultados[0]['cantidad'];
$esPrimera=$paginaActual===1;
$esUltima=(int)ceil($cantidad/LIMITE_RESULTADO)===$paginaActual;
?>
<html>
    <body>
        <?php foreach($resultados as $columna):?>
            <div>
                <h1><?=$columna['Name']?></h1>
                <hr>
            </div>
            <?php endforeach;?>
            <?php if(!$esPrimera):?>
                <a href="paginador_SQL.php?pagina=<?=$paginaActual-1?>">Anterior</a>
            <?php endif;?>
            <?php if (!$esUltima): ?>
            <a href="paginador_SQL.php?pagina=<?=$paginaActual+1?>">Siguiente</a>
            <?php endif;?>
    </body>
</html>