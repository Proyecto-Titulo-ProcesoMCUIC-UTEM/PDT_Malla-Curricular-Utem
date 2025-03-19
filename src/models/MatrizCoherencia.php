<?php
class MatrizCoherencia {
    private $conexion;
    private $tabla = 'matrices_coherencia';

    public function __construct($db) {
        $this->conexion = $db;
    }

    public function crear($datos) {
        try {
            $query = "INSERT INTO " . $this->tabla . " 
                    (asignatura_id, dominio, competencia, resultado_aprendizaje, 
                    actividad_curricular, criterios_logro, contenidos, bibliografia, 
                    metodologias, evaluacion, evidencias, sct_chile) 
                    VALUES 
                    (:asignatura_id, :dominio, :competencia, :resultado_aprendizaje,
                    :actividad_curricular, :criterios_logro, :contenidos, :bibliografia,
                    :metodologias, :evaluacion, :evidencias, :sct_chile)";
            
            $stmt = $this->conexion->prepare($query);
            
            $stmt->bindParam(':asignatura_id', $datos['asignatura_id'], PDO::PARAM_INT);
            $stmt->bindParam(':dominio', $datos['dominio']);
            $stmt->bindParam(':competencia', $datos['competencia']);
            $stmt->bindParam(':resultado_aprendizaje', $datos['resultado_aprendizaje']);
            $stmt->bindParam(':actividad_curricular', $datos['actividad_curricular']);
            $stmt->bindParam(':criterios_logro', $datos['criterios_logro']);
            $stmt->bindParam(':contenidos', $datos['contenidos']);
            $stmt->bindParam(':bibliografia', $datos['bibliografia']);
            $stmt->bindParam(':metodologias', $datos['metodologias']);
            $stmt->bindParam(':evaluacion', $datos['evaluacion']);
            $stmt->bindParam(':evidencias', $datos['evidencias']);
            $stmt->bindParam(':sct_chile', $datos['sct_chile']);

            if ($stmt->execute()) {
                return $this->conexion->lastInsertId();
            }
            return false;
        } catch(PDOException $e) {
            error_log("Error al crear matriz de coherencia: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPorAsignatura($asignatura_id) {
        try {
            $query = "SELECT * FROM " . $this->tabla . " WHERE asignatura_id = :asignatura_id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':asignatura_id', $asignatura_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error al obtener matriz por asignatura: " . $e->getMessage());
            return [];
        }
    }

    public function actualizar($id, $datos) {
        try {
            $query = "UPDATE " . $this->tabla . " SET 
                    dominio = :dominio,
                    competencia = :competencia,
                    resultado_aprendizaje = :resultado_aprendizaje,
                    actividad_curricular = :actividad_curricular,
                    criterios_logro = :criterios_logro,
                    contenidos = :contenidos,
                    bibliografia = :bibliografia,
                    metodologias = :metodologias,
                    evaluacion = :evaluacion,
                    evidencias = :evidencias,
                    sct_chile = :sct_chile
                    WHERE id = :id";

            $stmt = $this->conexion->prepare($query);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':dominio', $datos['dominio']);
            $stmt->bindParam(':competencia', $datos['competencia']);
            $stmt->bindParam(':resultado_aprendizaje', $datos['resultado_aprendizaje']);
            $stmt->bindParam(':actividad_curricular', $datos['actividad_curricular']);
            $stmt->bindParam(':criterios_logro', $datos['criterios_logro']);
            $stmt->bindParam(':contenidos', $datos['contenidos']);
            $stmt->bindParam(':bibliografia', $datos['bibliografia']);
            $stmt->bindParam(':metodologias', $datos['metodologias']);
            $stmt->bindParam(':evaluacion', $datos['evaluacion']);
            $stmt->bindParam(':evidencias', $datos['evidencias']);
            $stmt->bindParam(':sct_chile', $datos['sct_chile']);

            return $stmt->execute();
        } catch(PDOException $e) {
            error_log("Error al actualizar matriz: " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $query = "DELETE FROM " . $this->tabla . " WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch(PDOException $e) {
            error_log("Error al eliminar matriz: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPorId($id) {
        try {
            $query = "SELECT * FROM " . $this->tabla . " WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error al obtener matriz por ID: " . $e->getMessage());
            return null;
        }
    }
}