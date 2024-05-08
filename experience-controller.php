<?php
require_once "./database.php";

function getAll($db)
{
  $data = $db->query("select * from Experiences order by EndDate desc, StartDate desc");
  return $data->fetchAll(PDO::FETCH_OBJ);
}

function get($db, $id)
{
  try {
    $query = $db->prepare("select * from Experiences where ID=:id");
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
    $query = $db->prepare("update Experiences SET Title=:Title, StartDate=:StartDate, EndDate=:EndDate, Description=:Description where ID=:id");
    $query->bindParam(':Title', $data->Title);
    $query->bindParam(':StartDate', $data->StartDate);
    $query->bindParam(':EndDate', $data->EndDate);
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
    $query = $db->prepare("insert into Experiences ( Title, StartDate, EndDate, Description ) values (:Title,:StartDate,:EndDate,:Description)");
    $query->bindParam(':Title', $data->Title);
    $query->bindParam(':StartDate', $data->StartDate);
    $query->bindParam(':EndDate', $data->EndDate);
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
    $query = $db->prepare("delete from Experiences where ID=:id");
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
