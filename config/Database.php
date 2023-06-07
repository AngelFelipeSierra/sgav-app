<?php 
    namespace App;
    class Database{
        private $conn;
        protected static $settings = array(
            "mysql" => Array(
                'driver' => 'mysql', //driver => sgbd
                'host' => 'localhost', //servidor local
                'username' => 'campus', // usuario del sgbd
                'database' => 'viviendas', //nombre de la base de datos
                'password' => 'campus2023', // password del sgbd
                'collation' => 'utf8mb4_unicode_ci',// utilizacion de idiomas y caracteres especiales
                'flags' => [
                    // Turn off persistent connections
                    \PDO::ATTR_PERSISTENT => false, //Atributo con el valor false 
                    // Enable exceptions
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    // Emulate prepared statements
                    \PDO::ATTR_EMULATE_PREPARES => true,
                    // Set default fetch mode to array
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    // Set character set
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
                ],
                "pgsql" => Array(
                    'driver' => 'pgsql', //driver => pgsql
                    'host' => 'localhost', //servidor local
                    'username' => 'postgres', // usuario del sgbd
                    'database' => 'viviendas', //nombre de la base de datos
                    'password' => 'campus2023', // password del sgbd
                    'flags' => [
                        // Turn off persistent connections
                        \PDO::ATTR_PERSISTENT => false,
                        // Enable exceptions
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        // Set default fetch mode to array
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                        // Set character set
                        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
                    ]
                    
                )
            )
        );
        public function __construct($args = []){
            $this->conn = $args['conn'] ?? null;
        }
        public function getConection($dbKey){
            $dbConfig = self::$settings[$dbKey];
            $this->conn = null;
            $dsn = "{$dbConfig}['driver']}:host={$dbConfig}['host'];dbname={$dbConfig['database']}";
            try {
                $this->conn = new \PDO($dsn, $dbConfig['username'], $dbConfig['password'], $dbConfig['password'], $dbConfig['flags']);
                echo 'okkkkk';
            } catch (\PDOException $exception) {
                $error = [[
                    'error' => $exception->getMessage(),
                    'message' => 'Error al momento de establecer conexion'
                ]];
                return $error;
            }
            return $this->conn;
        }
    }
?>