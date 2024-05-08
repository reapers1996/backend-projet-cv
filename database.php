<?php
function connect()
{
  $host = "";
  $dbname = "";
  $username = "";
  $password = "";

  try {
    // $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db = new PDO("sqlite:./database.sqlite");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $exception) {
    die("Erreur : " . $exception->getMessage());
  }

  return $db;
}


function init($db)
{
  echo "Init database ...<br>";
  try {
    $db->query("CREATE TABLE IF NOT EXISTS Profile ( ID INTEGER PRIMARY KEY AUTOINCREMENT, FirstName VARCHAR(100) NOT NULL, LastName VARCHAR(100) NOT NULL, Address VARCHAR(255), Email VARCHAR(255), Phone VARCHAR(20), DateOfBirth DATE, CVTitle VARCHAR(255));");
    $db->query("CREATE TABLE IF NOT EXISTS Experiences ( ID INTEGER PRIMARY KEY AUTOINCREMENT,Title VARCHAR(255) NOT NULL, StartDate DATE NOT NULL, EndDate DATE, Description TEXT);");
    $db->query(" CREATE TABLE IF NOT EXISTS AcademicDegrees ( ID INTEGER PRIMARY KEY AUTOINCREMENT, Title VARCHAR(255) NOT NULL, Institution VARCHAR(255) NOT NULL, StartDate DATE, EndDate DATE, Description TEXT);");
    $db->query("CREATE TABLE IF NOT EXISTS Hobbies ( ID INTEGER PRIMARY KEY AUTOINCREMENT,  HobbyName VARCHAR(255) NOT NULL, Description TEXT);");
    $db->query("CREATE TABLE IF NOT EXISTS Skills ( ID INTEGER PRIMARY KEY AUTOINCREMENT, SkillName VARCHAR(255) NOT NULL, SkillLevel INTEGER CHECK (SkillLevel >= 1 AND SkillLevel <= 10));");
    $db->query("INSERT INTO Profile (ID, FirstName, LastName, Address, Email, Phone, DateOfBirth, CVTitle) SELECT 1, 'John', 'Doe', '123 Fake Street', 'john.doe@example.com', '1234567890', '1970-01-01', 'Experienced Web Developer' WHERE NOT EXISTS ( SELECT 1 FROM Profile WHERE ID = 1);");
    echo "<br>Finished.";

  } catch (\Exception $ex) {
    echo "Can’t create database tables<br>";
    echo $ex->getMessage();
  }
}
