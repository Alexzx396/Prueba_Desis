<?php
// require "Conexion.php";

/**
 * Clase Medio_comunica
 *
 * Esta clase representa un medio de comunicación y proporciona métodos para interactuar
 * con la base de datos para obtener información de los medios de comunicación.
 */
class Medio_comunica extends Conexion
{
    private $id;
    private $descripcion;

    /**
     * Establece el ID del medio de comunicación.
     *
     * @param mixed $valor El valor del ID.
     */
    public function setId($valor)
    {
        $this->id = $valor;
    }

    /**
     * Obtiene el ID del medio de comunicación.
     *
     * @return mixed El ID del medio de comunicación.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Establece la descripción del medio de comunicación.
     *
     * @param string $valor La descripción del medio de comunicación.
     */
    public function setDescripcion($valor)
    {   
        $this->descripcion = $valor;
    }

    /**
     * Obtiene la descripción del medio de comunicación.
     *
     * @return string La descripción del medio de comunicación.
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Constructor de la clase.
     * Inicializa la conexión a la base de datos.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Obtiene todos los medios de comunicación de la base de datos.
     *
     * @return array Una lista de objetos Medio_comunica.
     */
    public function getMedio_comunica()
    {
        $objetos = [];
        try {
            $sql = 'SELECT * FROM medio_contacto';
            $stmt = $this->conexion_db->prepare($sql);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $medio_comunica) {
                $objeto = new Medio_comunica();
                $objeto->setId($medio_comunica['id']);
                $objeto->setDescripcion($medio_comunica['descripcion']);
                $objetos[] = $objeto;
            }
        } catch (PDOException $e) {
            // Manejo adecuado del error
            error_log('Error de conexión: ' . $e->getMessage());
            return [];
        }

        return $objetos;
    }
}
