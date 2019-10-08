<?php
class Config {

    private static $config;

    /**
     * Carga el archivo de configuracion.
     * @param string $configFile Ruta del archivo de configuracion.
     */
    public static function init($configFile) {
        self::$config = parse_ini_file($configFile, true);
    }

    /**
     * Devuelve el parametro de configuracion solicitado.
     * @param string $section Tipo de parametro (ej: database, mailing)
     * @param string $param   Nombre del parametro solicitado
     * @return string Valor del parametro
     */
    public static function getParam($section, $param) {
        return self::$config[$section][$param];
    }

    /**
     * Devuelve el parametro de configuracion solicitado guardado en la base de datos.
     * @param string $param Nombre del parametro solicitado
     * @return mixed Valor del parametro
     */
    public static function getParamFromDB($param) {
        $db = new Database();
        $sql = "SELECT valor FROM configuracion WHERE campo = '$param';";

        $valor = $db->query_field($sql);
        $db->close();
        return $valor;
    }
}