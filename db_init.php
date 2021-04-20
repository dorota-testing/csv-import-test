<?php
/*
 * SETTINGS!
 */
$arrConfig = json_decode(file_get_contents('config.json'), true);
$databaseName = $arrConfig['database_name'];
$databaseUser = $arrConfig['database_user'];
$databasePassword = $arrConfig['database_password'];

/*
 * CREATE THE DATABASE
 */
$pdoDatabase = new PDO('mysql:host=localhost', $databaseUser, $databasePassword);
$pdoDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdoDatabase->exec('CREATE DATABASE IF NOT EXISTS '.$databaseName);

/*
 * CREATE THE TABLE
 */
$pdo = new PDO('mysql:host=localhost;dbname='.$databaseName, $databaseUser, $databasePassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// initialize the table
$pdo->exec('DROP TABLE IF EXISTS tblProductData;');

$pdo->exec("CREATE TABLE tblProductData (
  intProductDataId int(10) unsigned NOT NULL AUTO_INCREMENT,
  strProductName varchar(50) NOT NULL,
  strProductDesc varchar(255) NOT NULL,
  strProductCode varchar(10) NOT NULL,
  dtmAdded datetime DEFAULT NULL,
  dtmDiscontinued datetime DEFAULT NULL,
  stmTimestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (intProductDataId),
  UNIQUE KEY (strProductCode)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stores product data'");

//rename the table
$pdo->exec('DROP TABLE IF EXISTS tbl_product_data;');
$pdo->exec('RENAME TABLE tblProductData TO tbl_product_data');

//amend table
$pdo->exec('ALTER TABLE tbl_product_data  ADD intStock INT(11) NOT NULL  AFTER strProductCode,  ADD decPrice DECIMAL(11,2) NOT NULL  AFTER intStock');

echo "Database was prepared.\n";
