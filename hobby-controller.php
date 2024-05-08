<?php
require_once "./database.php";

function getAll($db)
{
  $data = $db->query("SELECT * FROM Hobbies ORDER BY HobbyName ASC");
  return $data->fetchAll(PDO::FETCH_OBJ);
}

function get($db, $id)
{
  try {
    $query = $db->prepare("SELECT * FROM Hobbies WHERE ID=:id");
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
  } catch (PDOException $e) {
    return ["error" => $e->getMessage()];
  }
}

function update($db, $id)
{
  try {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $query = $db->prepare("UPDATE Hobbies SET HobbyName=:HobbyName, Description=:Description WHERE ID=:id");
    $query->bindParam(':HobbyName', $data->HobbyName);
    $query->bindParam(':Description', $data->Description);
    $query->bindParam(':id', $id);
    $query->execute();
    if ($query->rowCount() == 1)
      return ["success" => true];
    else
      return ["success" => false];
  } catch (PDOException $e) {
    return ["error" => $e->getMessage()];
  }
}

function insert($db)
{
  try {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $query = $db->prepare("INSERT INTO Hobbies (HobbyName, Description) VALUES (:HobbyName, :Description)");
    $query->bindParam(':HobbyName', $data->HobbyName);
    $query->bindParam(':Description', $data->Description);
    $query->execute();
    return ["success" => true, "id" => $db->lastInsertId()];
  } catch (PDOException $e) {
    return ["error" => $e->getMessage()];
  }
}

function delete($db, $id)
{
  try {
    $query = $db->prepare("DELETE FROM Hobbies WHERE ID=:id");
    $query->bindParam(':id', $id);
    $query->execute();
    if ($query->rowCount() == 1)
      return ["success" => true];
    else
      return ["success" => false];
  } catch (PDOException $e) {
    return ["error" => $e->getMessage()];
  }
}
