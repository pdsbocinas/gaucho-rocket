<?php
/**
 * class Log
 * Se encarga de escribir un mensaje en el archivo de log.
 * @author: Equipo Miel
 */
class Log {

    /**
     * @param string $from     Origen del mensaje (clase, funcion, etc)
     * @param string $message  Mensaje principal
     * @param string $error    Mensaje o codigo de error
     */
    public static function error($from, $message, $error = '') {

        self::logger($from, "ERROR", $message, $error);

    }

    /**
     * @param string $from     Origen del mensaje (clase, funcion, etc)
     * @param string $message  Mensaje principal
     * @param string $warning  Mensaje de advertencia
     */
    public static function warning($from, $message, $warning = '') {

        self::logger($from, "WARNING", $message, $warning);

    }

    /**
     * @param string $from     Origen del mensaje (clase, funcion, etc)
     * @param string $message  Mensaje informativo
     */
    public static function info($from, $message) {

        self::logger($from, "INFO", $message);

    }

    /**
     * Metodo privado que realiza efectivamente el log
     * @param string $from  Origen del mensaje (clase, funcion, etc)
     * @param string $type  Tipo de mensaje (Error,Warning,Info)
     * @param string $message  Mensaje principal
     * @param string $externalMessage   Mensaje brindado por otra fuente
     */
    private static function logger($from, $type, $message, $externalMessage = ''){

        $logMessage = sprintf("[%-19s] [%-7s] %s\n%s\n%s\n\n",
            Date::now("ST"), $type, $from, $message, $externalMessage);
        self::writeFile($logMessage);

    }

    /**
     * Escribe un mensaje en el archivo de log.
     * @param string $logMessage Mensaje de log.
     */
    private static function writeFile($logMessage) {

        $logFilePath = Path::getPath("logs") . Date::now("I") . ".log"  ;

        $file = fopen( $logFilePath , "a");

        fwrite($file, $logMessage);

        fclose($file);
    }


    public static function writeCustomLog($filename, $from, $message) {

        $logMessage = sprintf("[%-19s]\n%s\n%s\n\n", Date::now("ST"), $from, $message);

        $logFilePath = Path::getPath("logs") . $filename . "_" . Date::now("I") . ".log"  ;

        $file = fopen( $logFilePath , "a");

        fwrite($file, $logMessage);

        fclose($file);
    }

}