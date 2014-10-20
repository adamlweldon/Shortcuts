<?php

// RECORDS CLASS
class Record{
	public static $___DATABASE = false;
    public static $___QUERIES = array();

    final public static function connection($connection) {
        self::$___DATABASE = $connection;
    }
    final public static function getConnection() {
        return self::$___DATABASE;
    }
    final public static function logQuery($sql) {
        self::$___QUERIES[] = $sql;
    }
    final public static function query($sql, $values=false) {
        self::logQuery($sql);

        if (is_array($values)) {
            $stmt = self::$___DATABASE->prepare($sql);
            $stmt->execute($values);
            return $stmt;
        }else {
            //return self::$___DATABASE->query($sql);
            echo '<h1>Your statement is not prepared. Please Fix</h1>';
        	echo '<pre>'; print_r(get_defined_vars()); echo '</pre>';
	        exit;
        }
    }
    
    final public static function lastid(){
	    return self::$___DATABASE->lastInsertId();
    }
    
    final public static function execute($sql, $values=false) {
        self::logQuery($sql);

        if (is_array($values)) {
            $stmt = self::$___DATABASE->prepare($sql);
            $stmt->execute($values);
            return true;
        } else {
            //return self::$___DATABASE->execute($sql);
            echo '<h1>Your statement is not prepared. Please Fix</h1>';
        	echo '<pre>'; print_r(get_defined_vars()); echo '</pre>';
	        exit;
        }
    }
}

// CONNECT TO DATABASE
try {
    $db = new PDO("mysql:host=localhost;dbname=pdo_login", 'root', 'root');
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
	// if(DEBUG){
	// 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// }
}
catch (PDOException $error) {
    die('DB Connection failed: '.$error->getMessage());
}
Record::connection($db);

?>