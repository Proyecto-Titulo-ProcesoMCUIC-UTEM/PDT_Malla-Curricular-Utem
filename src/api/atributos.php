<?php
session_start();
require_once '../../config/database.php';
require_once '../../src/models/Atributo.php';

$db = new Database();
$atributo = new Atributo($db->conectar());

$asignaturaId = $_GET['asignatura_id'];
$dominios = $atributo->obtenerDominios($asignaturaId);
$competencias = $atributo->obtenerCompetencias($asignaturaId);
$resultados = $atributo->obtenerResultados($asignaturaId);

header('Content-Type: application/json');
echo json_encode([
    'dominios' => $dominios,
    'competencias' => $competencias,
    'resultados' => $resultados
]);