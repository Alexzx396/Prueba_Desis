<?php

/**
 * Clase Candidato
 *
 * Esta clase representa un candidato en el sistema. Extiende de la clase Conexion
 * para poder interactuar con la base de datos.
 */
class Candidato extends Conexion
{
    private $id;
    private $nombreCompleto;

    /**
     * Constructor de la clase.
     *
     * Inicializa la conexión a la base de datos llamando al constructor de la clase padre.
     */
    public function __construct()
    {
        parent::__construct();
    }

    // Setters y getters con documentación básica
    public function setId($valor)
    {
        $this->id = $valor;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNombreCompleto($valor)
    {
        $this->nombreCompleto = $valor;
    }

    public function getNombreCompleto()
    {
        return $this->nombreCompleto;
    }

    /**
     * Obtiene una lista de todos los candidatos.
     *
     * @return array Una lista de objetos Candidato.
     */
    public function getCandidatos()
    {
        $objetos = [];

        try {
            $sql = 'SELECT * FROM candidato';
            $stmt = $this->conexion_db->prepare($sql);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $candidato) {
                $oCandidato = new Candidato();
                $oCandidato->setId($candidato['id']);
                $oCandidato->setNombreCompleto($candidato['nombre_completo']);
                $objetos[] = $oCandidato;
            }
        } catch (PDOException $e) {
            // Manejo adecuado del error
            error_log('Error de conexión: ' . $e->getMessage());
            // Puede ser útil devolver un estado de error o lanzar una excepción
        }

        return $objetos;
    }

    /**
     * Obtiene un candidato específico por ID.
     *
     * @param mixed $datos Datos que incluyen el ID del candidato.
     * @return array|null Datos del candidato o null si no se encuentra.
     */
    public function getCandidatosUnico($datos)
    {
        try {
            // Preparar la consulta para evitar inyecciones SQL
            $stmt = $this->conexion_db->prepare('SELECT * FROM candidato WHERE id = :id');
            $stmt->bindParam(':id', $datos->id, PDO::PARAM_INT);
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error de conexión: ' . $e->getMessage());
            return null;
        }

        return $resultado;
    }
}
