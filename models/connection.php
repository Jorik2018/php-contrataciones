<?php

class Connection
{
    /**
     * informacion de la base de datos
     */

    static public function infoDatabase()
    {
        return include(__DIR__ . '../settings.php');
    }

    /**
     * conexion a la base de datos
     */

    static public function connect()
    {
        try {
            $link = new PDO(
                "mysql:host=www.dbasure.com;dbname=" . Connection::infoDatabase()["database"] . ";charset=utf8",
                Connection::infoDatabase()["user"],
                Connection::infoDatabase()["pass"]
            );

            //$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$link->exec("set names utf8");
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return $link;
    }


    static public function executeQuery($sql)
    {
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    static public function executeQueryAsoc($sql)
    {
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function executeQueryObject($sql)
    {
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    static public function executeQueryRowCount($sql)
    {
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * Validar existencia de una tabla en la DB
     */

    static public function getColumsData($table, $columns)
    {

        /**
         * traer el nombre de la DB
         */
        $database = Connection::infoDatabase()["database"];

        /**
         * trae todas las columnas de una tabla
         */
        $validate = Connection::connect()->query("SELECT COLUMN_NAME AS item FROM information_schema.columns WHERE table_schema = '$database' AND table_name = '$table'")->fetchAll(PDO::FETCH_OBJ);

        /**
         * valida la existencia de la tabla
         */
        if (empty($validate)) {
            return null;
        } else {
            /**
             * ajuste de solicitud a columnas globales
             */

            if ($columns[0] == "*") {
                array_shift($columns);
            }

            /**
             * valida la existencia de columnas
             */

            $sum = 0;
            foreach ($validate as $key => $value) {
                $sum += in_array($value->item, $columns);
            }

            return $sum == count($columns) ? $validate : null;
        }
    }
}
