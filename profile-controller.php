<?php
require_once "./database.php";

function get($db)
{
  $data = $db->query("select * from Profile");
  return $data->fetchObject();
}

function set($db)
{
  try {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $query = $db->prepare("update Profile SET FirstName = :FirstName, LastName = :LastName, Address = :Address, Email = :Email, Phone = :Phone, DateOfBirth = :DateOfBirth, CVTitle = :CVTitle where ID=1");
    $query->bindParam(':FirstName', $data->FirstName);
    $query->bindParam(':LastName', $data->LastName);
    $query->bindParam(':Address', $data->Address);
    $query->bindParam(':Email', $data->Email);
    $query->bindParam(':Phone', $data->Phone);
    $query->bindParam(':DateOfBirth', $data->DateOfBirth);
    $query->bindParam(':CVTitle', $data->CVTitle);
    $query->execute();
    return ["success" => true];
  } catch (PDOException $e) {
    return ["error" => $e->getMessage()];
  }
}
