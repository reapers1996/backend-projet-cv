<?php
require_once "./database.php";

function getAll($db)
{
  $data = $db->query("SELECT * FROM Skills ORDER BY SkillName ASC");
  return $data->fetchAll(PDO::FETCH_OBJ);
}

function get($db, $id)
{
  try {
    $query = $db->prepare("SELECT * FROM Skills WHERE ID=:id");
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
    $query = $db->prepare("UPDATE Skills SET SkillName=:SkillName, SkillLevel=:SkillLevel WHERE ID=:id");
    $query->bindParam(':SkillName', $data->SkillName);
    $query->bindParam(':SkillLevel', $data->SkillLevel, PDO::PARAM_INT); // Ensure the level is treated as an integer
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
    $query = $db->prepare("INSERT INTO Skills (SkillName, SkillLevel) VALUES (:SkillName, :SkillLevel)");
    $query->bindParam(':SkillName', $data->SkillName);
    $query->bindParam(':SkillLevel', $data->SkillLevel, PDO::PARAM_INT); // Bind as integer
    $query->execute();
    return ["success" => true, "id" => $db->lastInsertId()];
  } catch (PDOException $e) {
    return ["error" => $e->getMessage()];
  }
}

function delete($db, $id)
{
  try {
    $query = $db->prepare("DELETE FROM Skills WHERE ID=:id");
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
