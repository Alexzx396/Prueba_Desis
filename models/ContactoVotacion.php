<?php
// require "Conexion.php";

/**
 * Clase ContactoVotacion
 *
 * Esta clase maneja las operaciones relacionadas con los contactos de los votantes.
 */
class ContactoVotacion extends Conexion
{
    /**
     * Constructor de la clase.
     * Inicializa la conexión a la base de datos.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Inserta los medios de contacto para un votante.
     *
     * @param object $datos Datos que incluyen los medios de contacto.
     * @param array $votante Información del votante.
     * @return array|null Resultados de la inserción o null si hay un error.
     */
    public function insertarContactoVotacion($datos, $votante)
    {
        $listaContactos = '';
        foreach ($datos->checkBoxEnviar as $medioComunica) {
            $listaContactos .= "(''," . (int)$medioComunica . "," . (int)$votante['id'] . "),";
        }
        $listaContactos = rtrim($listaContactos, ',');

        try {
            $sql = 'INSERT INTO `contacto_votacion`(`id`, `id_medio_contacto`, `id_votante`) VALUES ' . $listaContactos;
            $consulta = $this->conexion_db->query($sql);
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejo adecuado del error
            error_log('Error de conexión: ' . $e->getMessage());
            return null;
        }

        return $resultado;
    }
}
