<?php 
session_start();
function conn(){
    $server = "localhost";
    // $user = "vpq2n7pdmowf";
    // $password = "FrNaRFoj$1Fc";
    $user = "root";
    $password = "1234567";
    $database = "coolersdb";
    // $database = "coolers_delight";

    $conn = new mysqli($server,$user,$password,$database);

    if ($conn->connect_error > 0) {

        die("Connection error");

    }else{
		
        return $conn;
        
    }


}


// class connect{
// 	private $servername = "localhost";
// 	private $username = "root";
// 	private $password = "1234567";
// 	private $database = "coolers_delight";
		
// 	protected function conn(){
		
// 		$conn = new mysqli($servername, $username,$password,$database);
// 		if($conn->connect_errorno > 0){
// 			trigger_error("Mysqli connection error");
// 		}else{
// 			return $conn;
// 		}
// 	}
	
// }

error_reporting(E_ALL);
ini_set("display_errors", 0);
function ErrorHandler($errno, $errstr, $errfile, $errline){
	$message = "Error: [$errno] $errstr - $errfile:$errline ";
	error_log($message . PHP_EOL, 3, "error_log.txt" );
}

set_error_handler("ErrorHandler");



