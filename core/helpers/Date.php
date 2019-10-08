<?php
/**
 * Class Date
 * Funciones para la obtencion y formateo de fechas.
 * @author: Equipo Miel
 */
class Date {

    /**
     * Devuelve la fecha actual segun el formato indicado.
     * @param string $length Longitud de la fecha
     *     L:  fecha en formato largo
     *     S:  fecha en formato corto (dd/mm/yyyy)
     *     ST: fecha y hora en formato corto (dd/mm/yyyy hh:mm:ss)
     *     I:  fecha invertida (yyyy-mm-dd) usada para archivos de log
     *     IT: fecha invertida y hora (yyyy-mm-dd hh:mm:ss) usada para SQL
     *     IC: fecha invertida y hora comprimidas (yyyymmddhhmmss)
     * @return string Fecha actual
     */
    public static function now($length = "") {

        switch ($length) {
            case "L":
                $dateOrig = date('d \d\e F \d\e Y');
                $engMonths = array('January', 'February', 'March', 'April', 'May', 'June', 'July',
                    'August', 'September', 'October', 'November', 'December');
                $spaMonths = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio',
                    'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                $date = str_replace($engMonths, $spaMonths, $dateOrig);
                return $date;
                break;
            case "S":
                return date('d/m/Y');
                break;
            case "ST":
                return date('d/m/Y H:i:s');
                break;
            case "I":
                return date('Y-m-d');
                break;
            case "IT":
                return date('Y-m-d H:i:s');
                break;
            case "IC":
                return date('YmdHis');
                break;
            case "day":
                return date("d");
                break;
            case "month":
                $dateOrig = date('M');
                $engMonths = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                $spaMonths = array('ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic');
                $date = strtoupper( str_replace($engMonths, $spaMonths, $dateOrig) );
                return $date;
                break;
            default:
                return date('d/m/Y');
                break;
        }
    }


    /**
     * Convierte una fecha en formato dd/mm/aaaa (vista) a aaaa-mm-dd (mysql).
     * @param string $date  Fecha en formato dd/mm/aaaa
     * @return string       Fecha en formato aaaa-mm-dd
     */
    public static function dmy2ymd($date) {
        if ($date != '') {
            list($day, $month, $year) = explode('/', $date);
            $newDate = "$year-$month-$day";
            return date('Y-m-d', strtotime($newDate));
        }
        return "";
    }

    /**
     * Convierte una fecha en formato aaaa-mm-dd (mysql) a dd/mm/aaaa (vista).
     * @param string $date  Fecha en formato aaaa-mm-dd
     * @return string       Fecha en formato dd/mm/aaaa
     */
    public static function ymd2dmy($date) {
        if ($date != null && $date != '0000-00-00') {
            return date('d/m/Y', strtotime($date));
        }
        return "";
    }

    /**
     * Convierte una fecha y hora en formato aaaa-mm-dd hh:mm:ss (mysql) a dd/mm/aaaa hh:mm:ss (vista).
     * @param string $date  Fecha y hora en formato aaaa-mm-dd hh:mm:ss
     * @return string       Fecha y hora en formato dd/mm/aaaa hh:mm:ss
     */
    public static function ymdt2dmyt($date) {
        if ($date != null) {
            return date('d/m/Y H:i:s', strtotime($date));
        }
        return "";
    }
}