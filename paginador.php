<?php
$personajes=[
    'Abelar Hightower',
    'Addamm',
    'Addamm Osgrey',
    'Adamm Marband',
    'Addison hill',
    'Aegon balckfyre',
    'Aegon frey(son of aenys',
    'Abelar Hightower 2',
    'Addamm 2',
    'Addamm Osgrey 2',
    'Adamm Marband 2',
    'Addison hill 2',
    'Aegon balckfyre 2'
];
define('LIMITE_RESULTADOS',5);
$paginaActual=isset($_REQUEST['pagina'])? $_REQUEST['pagina']:1;
$personajesPagina=array_splice($personajes, ($paginaActual-1)*LIMITE_RESULTADOS,LIMITE_RESULTADOS);
$esPrimera=$paginaActual==1;
$esUltima=ceil(count($personajes)/ LIMITE_RESULTADOS)==$paginaActual;


?>
<html>
    <body>
        <?php foreach ($personajesPagina as $personaje):?>
            <div>
                <h1><?=$personaje?></h1>
            </div>
            <?php endforeach;?>
            <?php if (!$esUltima): ?>
            <a href="paginador.php?pagina=<?=$paginaActual+1?>">Siguiente</a>
            <?php endif;?>
            <?php if (!$esPrimera): ?>
            <a href="paginador.php?pagina=<?=$paginaActual-1?>">Anterior</a>
            <?php endif;?>
    </body>
</html>