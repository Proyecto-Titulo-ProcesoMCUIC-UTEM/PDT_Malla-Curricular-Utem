<?php
session_start();
require_once '../../config/database.php';
require_once '../../src/models/MatrizCoherencia.php';
require_once '../../src/models/Asignatura.php';
require_once '../../src/models/Carrera.php';
require_once '../../includes/functions.php';

verificarSesion();

$db = new Database();
$conexion = $db->conectar();
$asignatura = new Asignatura($conexion);
$carrera = new Carrera($conexion);
$matriz = new MatrizCoherencia($conexion);

$error = '';
$success = '';

// Obtener lista de asignaturas para el select
$carreras = $carrera->obtenerTodas();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
        'asignatura_id' => (int)limpiarDatos($_POST['asignatura_id']),
        'dominio' => limpiarDatos($_POST['dominio']),
        'competencia' => limpiarDatos($_POST['competencia']),
        'resultado_aprendizaje' => limpiarDatos($_POST['resultado_aprendizaje']),
        'criterios_logro' => limpiarDatos($_POST['criterios_logro']),
        'contenidos' => limpiarDatos($_POST['contenidos']),
        'bibliografia' => limpiarDatos($_POST['bibliografia']),
        'metodologias' => limpiarDatos($_POST['metodologias']),
        'evaluacion' => limpiarDatos($_POST['evaluacion']),
        'evidencias' => limpiarDatos($_POST['evidencias']),
        'sct_chile' => (int)limpiarDatos($_POST['sct_chile'])
    ];

    if ($matriz->crear($datos)) {
        $success = "Matriz de coherencia creada exitosamente.";
    } else {
        $error = "Error al crear la matriz de coherencia.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Agregar Matriz de Coherencia - UTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../../includes/header.php'; ?>
    
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>Nueva Matriz de Coherencia Curricular</h2>
                            <a href="matrices.php" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (!empty($error)) echo mostrarMensaje($error, 'error');
                        if (!empty($success)) echo mostrarMensaje($success, 'success');
                        ?>
                        
                        <form method="POST" action="" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="asignatura_id" class="form-label">Carrera</label>
                                <select class="form-select" id="asignatura_id" name="asignatura_id" required onchange="cargarAtributos()">
                                    <option value="">Seleccione una carrera</option>
                                    <?php foreach ($carreras as $carr): ?>
                                        <option value="<?php echo $carr['id']; ?>">
                                            <?php echo htmlspecialchars($carr['nombre']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dominio" class="form-label">Dominio</label>
                                    <select class="form-select" id="dominio" name="dominio" required disabled>
                                    <option value="">Seleccione un dominio</option>
                                    <?php foreach ($dominios as $d): ?>
                                        <option value="<?php echo $d['id']; ?>"><?php echo $d['descripcion']; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="competencia" class="form-label">Competencia</label>
                                    <select class="form-select" id="competencia" name="competencia" required disabled>
                                    <option value="">Seleccione una competencia</option>
                                    <?php foreach ($competencias as $c): ?>
                                        <option value="<?php echo $c['id']; ?>"><?php echo $c['descripcion']; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                </div>
                                <div class="mb-3">
                                <label for="resultado_aprendizaje" class="form-label">Resultados de Aprendizaje</label>
                                <select class="form-select" id="resultado_aprendizaje" name="resultado_aprendizaje" required disabled>
                                    <option value="">Seleccione un resultado de aprendizaje</option>
                                    <?php foreach ($resultados as $r): ?>
                                    <option value="<?php echo $r['id']; ?>"><?php echo $r['descripcion']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="criterios_logro" class="form-label">Criterios de Logro</label>
                                <textarea class="form-control" id="criterios_logro" name="criterios_logro" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="contenidos" class="form-label">Contenidos/Saberes</label>
                                <textarea class="form-control" id="contenidos" name="contenidos" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="bibliografia" class="form-label">Bibliografía</label>
                                <textarea class="form-control" id="bibliografia" name="bibliografia" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="metodologias" class="form-label">Metodologías Activas</label>
                                <textarea class="form-control" id="metodologias" name="metodologias" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="evaluacion" class="form-label">Evaluación</label>
                                <textarea class="form-control" id="evaluacion" name="evaluacion" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="evidencias" class="form-label">Evidencias</label>
                                <textarea class="form-control" id="evidencias" name="evidencias" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="sct_chile" class="form-label">SCT-Chile</label>
                                <input type="number" class="form-control" id="sct_chile" name="sct_chile" min="0">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Crear Matriz</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function cargarAtributos() {
    const asignaturaId = document.getElementById('asignatura_id').value;
    const dominioSelect = document.getElementById('dominio');
    const competenciaSelect = document.getElementById('competencia');
    const resultadoSelect = document.getElementById('resultado_aprendizaje');

    // Enable the selectors
    dominioSelect.disabled = false;
    competenciaSelect.disabled = false;
    resultadoSelect.disabled = false;

    // Fetch attributes based on the selected course
    fetch(`../../src/api/atributos.php?asignatura_id=${asignaturaId}`)
        .then(response => response.json())
        .then(data => {
            // Update the select options
            dominioSelect.innerHTML = '<option value="">Seleccione un dominio</option>';
            data.dominios.forEach(dominio => {
                const option = document.createElement('option');
                option.value = dominio.descripcion;
                option.text = dominio.descripcion;
                dominioSelect.add(option);
            });

            competenciaSelect.innerHTML = '<option value="">Seleccione una competencia</option>';
            data.competencias.forEach(competencia => {
                const option = document.createElement('option');
                option.value = competencia.descripcion;
                option.text = competencia.descripcion;
                competenciaSelect.add(option);
            });

            resultadoSelect.innerHTML = '<option value="">Seleccione un resultado de aprendizaje</option>';
            data.resultados.forEach(resultado => {
                const option = document.createElement('option');
                option.value = resultado.descripcion;
                option.text = resultado.descripcion;
                resultadoSelect.add(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar los atributos:', error);
        });
}
    </script>
</body>
</html>