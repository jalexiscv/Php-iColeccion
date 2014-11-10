<?php
require_once('librerias/iCollection.class.php');

/** Creación por definición **/
$animales=array('perro', 'gato', 'pato');
$coleccion1=new Coleccion($animales);

/** Creación por adhesión **/
$coleccion2= new Coleccion();
$coleccion2->set(1, $animales);
$coleccion2->set(2,array('leon','cocodrilo','coyote'));
/** Adhesión nuevos elementos
$coleccion2->set(3,'sapo');
$coleccion2->set(4,'pez');
/** Visualizar datos obtenidos por extracción **/
echo($coleccion2->get('3'));

/** Adhesión de una matriz **/
$usuarios=array(
      array('nombres'=>'Jose Alexis', 'apellidos'=>'Correa Valencia', 'edad'=>32),
      array('nombres'=>'Jhonny Alexander', 'apellidos'=>'Rivera Rojas', 'edad'=>32)
    );
$coleccion3->set(null,$usuarios);// Establecer por asignación
$coleccion3->set('2',array('nombres'=>'katherine', 'apellidos'=>'Arenas', 'age'=>22));// Establecer por auto creación
$coleccion3->set('3.nombres','Souza');// Establecer por ruta
$coleccion3->set('3.apellidos','Silva');// Establecer por ruta
$coleccion3->set('3.edad',20);// Establecer por ruta
/** Visualizar datos obtenidos por ruta**/
echo($coleccion3->get('1.nombres').' '.$coleccion3->get('1.apellidos').'');
echo($coleccion3->get('2.nombres'). ' '.$coleccion3->get('2.apellidos').'');
echo($coleccion3->get('3.nombres'). ' '.$coleccion3->get('3.apellidos').'');
/** Recorrer elemento **/
foreach ($coleccion3 as $dato) {
    echo($dato['nombres'].' '.$dato['apellidos'].' '.$dato['edad']);
}
/** Obtener como lista **/
$lista=$coleccion3->lists('nombres','edad'));
/** Maximo valor **/
echo($coleccion3->max('edad'));
/** Extracción **/
$extraccion=($coleccion3->extract('nombres'));
/** Unión **/
echo($coleccion3->extract('fname')->join(', '));
