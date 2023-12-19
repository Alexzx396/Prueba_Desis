<?php
require "Conexion.php";
// Incluye todos los modelos necesarios
include_once 'models/Region.php';
include_once 'models/Comuna.php';
include_once 'models/Candidato.php';
include_once 'models/Medio_comunica.php';
include_once 'models/Votante.php';
include_once 'models/ContactoVotacion.php';
include_once 'models/Votacion.php';

// Procesamiento de la votación
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData);

if (isset($data)) {
    $oVotante = new Votante();
    $votante = $oVotante->getVotante($data);
    
    if (count($votante) > 0) {
        echo "El votante ya existe";
    } else {
        $oVotante->crearVotante($data);
        $votanteCreado = $oVotante->getVotante($data)[0];
        $oContactoVotacion = new ContactoVotacion();
        $oContactoVotacion->insertarContactoVotacion($data, $votanteCreado);
        $oVotacion = new Votacion();
        $oVotacion->insertarVotacion($data, $votanteCreado);
        
        echo "Votación completa";
    }
}

// Carga de las regiones y comunas iniciales
$Oregiones = new Region();
$regiones = $Oregiones->getRegiones();

$Ocomunas = new Comuna();
$comunas = $Ocomunas->getComunas($regiones[0]->getId());

$Ocandidato = new Candidato();
$candidatos = $Ocandidato->getCandidatos();

$OmedioComunica = new Medio_comunica();
$medio_comunica = $OmedioComunica->getMedio_comunica();

// Carga dinámica de comunas basadas en la región seleccionada
if (isset($_POST["id_region_change"])) {
    $idRegion = $_POST["id_region_change"];
    $comunasPorRegion = $Ocomunas->getComunas($idRegion);
    echo json_encode($comunasPorRegion);
    exit;
}
?>
