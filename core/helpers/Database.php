<?php
/**
 * class Database
 * Clase para el manejo de base de datos MySQL. Hereda de mysqli y agrega metodos avanzados de consulta.
 * @author: Leandro Morrone
 */
class Database extends mysqli {

    public $statement;

    /**
     * Database constructor.
     */
    public function __construct() {

        // Obtengo los datos de conexion
        $hostname = Config::getParam("database", "hostname");
        $username = Config::getParam("database", "username");
        $password = Config::getParam("database", "password");
        $database = Config::getParam("database", "database");

        // Llamo al contructor de mysqli
        parent::__construct($hostname, $username, $password, $database);

        // Verifico si hubo errores de conexion
        if ($this->connect_errno) {
            new Error("Database.php -> constructor", "Error al conectar con la base de datos.",
                $this->connect_error, true, true);
        }
    }


    /**
     * Ejecuta una consulta y devuelve la primera fila encontrada.
     * @param string $sql Consulta MySQL con formato para preparar (? como param).
     * @param string $types Tipos de datos utilizados en bindParams.
     * @param array[string] array de parametros a utilizar en bindParams.
     * @return array|null Primera fila encontrada o null si no hay resultados.
     */
    public function query_row($sql, $types = null,$params = null) {

        $result = $this->execute_statement($sql, $types ,$params) ;

        return $result && count($result) > 0 ? $result[0]: null;
    }


    /**
     * Ejecuta una consulta y devuelve un array de resultados.
     * @param string $sql Consulta MySQL con formato para preparar (? como param).
     * @param string $types Tipos de datos utilizados en bindParams.
     * @param array[string] array de parametros a utilizar en bindParams.
     * @return array Tabla de resultados en formato array.
     */
    public function query_table($sql, $types =null,$params = null) {

        $result = $this->execute_statement($sql, $types ,$params) ;
        return $result ? $result : array();
    }


    /**
     * Ejecuta una consulta y devuelve el primer valor encontrado.
     * @param string $sql Consulta MySQL con formato para preparar (? como param).
     * @param string $types Tipos de datos utilizados en bindParams.
     * @param array[string] array de parametros a utilizar en bindParams.
     * @return mixed Valor del primer campo del registro.
     */
    public function query_field($sql, $types=null ,$params =null) {

        $result = $this->execute_statement($sql, $types ,$params) ;

        $value = null;
        if( $result && count($result) > 0){
            $value = array_shift($result[0]);
        }
        return $value;
    }

    /**
     * Ejecuta una sentencia MySQL sin resultados (ej: INSERT, DELETE, UPDATE).
     * @param string $sql Consulta MySQL con formato para preparar (? como param).
     * @param string $types Tipos de datos utilizados en bindParams.
     * @param array[string] array de parametros a utilizar en bindParams.
     */
    public function exec($sql, $types = null ,$params = null) {
        $this->execute_statement($sql, $types ,$params);
    }


    public function get_affected_rows(){
        $rows = 0;
        if($this->statement != null){
            $rows = $this->statement->affected_rows;
        }
        return $rows;
    }


    /**
     * Ejecuta una consulta mysqli en modo de objetos, utilizando el objeto stmt
     * @param string $sql Consulta MySQL Preparada
     * @param string $types Tipos de datos utilizados en bindParams
     * @param array[string] array de parametros a utilizar en bindParams
     * @return mixed misqli_result
     */
    private function execute_statement($sql, $types, $params) {

        $result = null;
        $statement = $this->stmt_init();

        if($statement->prepare ($sql)){

            if( $types && $params ){
                $bind_names[] = $types;
                for ($i=0; $i<count($params);$i++)
                {
                    $bind_name = 'bind' . $i;
                    $$bind_name = stripslashes($params[$i]);
                    $bind_names[] = &$$bind_name;
                }

                if( !call_user_func_array(array( $statement, 'bind_param'), $bind_names ) ){
                    Log::error("Database.php -> bind_param",
                        "Error al hacer bind de parametros.",
                        "Error:" . $statement->errno . " - " . $statement->error . "\n".
                        "Query: " . $sql .  "\n".
                        "Types: " . $types .  "\n".
                        "Params:" . json_encode($params) . "\n");
                }
            }

            if( !$statement->execute() ){
                Log::error("Database.php -> execute_statement",
                    "Error al ejecutar consulta en la base de datos.",
                    "Error:" . $statement->errno . " - " . $statement->error . "\n".
                    "Query: " . $sql .  "\n".
                    "Types: " . $types .  "\n".
                    "Params:" . json_encode($params) . "\n");

                $statement->close();
                $this->close();
                die("UPS! Estamos sufriendo algunos problemas, por favor intente luego :)");
            } else {
                $result = $this->get_result($statement);
            }

        } else {

            Log::error("Database.php -> execute_statement",
                "Error al preparar la consulta SQL.",
                "Error:" . $statement->errno . " - " . $statement->error . "\n".
                "Query: " . $sql .  "\n".
                "Types: " . $types .  "\n".
                "Params:" . json_encode($params) . "\n");

            $statement->close();
            $this->close();
            die("UPS! Estamos sufriendo algunos problemas, por favor intente luego :)");

        }

        return $result;
    }

    private function get_result($statement ) {
        $result = array();
        $statement->store_result();
        for ($i = 0; $i < $statement->num_rows; $i++ ) {
            $metadata = $statement->result_metadata();
            $params = array();
            while ( $field = $metadata->fetch_field() ) {
                $params[] = &$result[ $i ][ $field->name ];
            }
            call_user_func_array( array( $statement, 'bind_result' ), $params );
            $statement->fetch();
        }

        $this->statement = $statement;
        return $result;
    }

}
