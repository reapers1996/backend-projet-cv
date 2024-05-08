<?php
require_once "./database.php";

function router()
{
    $db = connect();

    $action = $_GET['action'] ?? null;
    $id = $_GET['id'] ?? null;
    $method = $_SERVER['REQUEST_METHOD'];

    if ($id !== null && !is_numeric($id)) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }

    switch ($method) {
        case "GET":
            switch ($action) {
                case null:
                    require_once "./home.php";
                    break;
                case "init":
                    require_once "./database.php";
                    $db = connect();
                    init($db);
                    break;
                case "profile":
                    require_once "./profile-controller.php";
                    echo json_encode(get($db));
                    break;
                case "experience":
                    require_once "./experience-controller.php";
                    echo json_encode(get($db, $id));
                    break;
                case "experiences":
                    require_once "./experience-controller.php";
                    echo json_encode(getAll($db));
                    break;
                case "academicDegree":
                    require_once "./academicDegreeController.php";
                    echo json_encode(get($db, $id));
                    break;
                case "academicDegrees":
                    require_once "./academicDegreeController.php";
                    echo json_encode(getAll($db));
                    break;
                case "hobby":
                    require_once "./hobby-controller.php";
                    echo json_encode(get($db, $id));
                    break;
                case "hobbies":
                    require_once "./hobby-controller.php";
                    echo json_encode(getAll($db));
                    break;
                case "skill":
                    require_once "./skill-controller.php";
                    echo json_encode(get($db, $id));
                    break;
                case "skills":
                    require_once "./skill-controller.php";
                    echo json_encode(getAll($db));
                    break;
            }
            break;

        case "POST":
            switch ($action) {
                case "set-profile":
                    require_once "./profile-controller.php";
                    echo json_encode(set($db));
                    break;
                case "insert-experience":
                    require_once "./experience-controller.php";
                    echo json_encode(insert($db));
                    break;
                case "update-experience":
                    require_once "./experience-controller.php";
                    echo json_encode(update($db, $id));
                    break;
                case "insert-academicDegree":
                    require_once "./academicDegreeController.php";
                    echo json_encode(insert($db));
                    break;
                case "update-academicDegree":
                    require_once "./academicDegreeController.php";
                    echo json_encode(update($db, $id));
                    break;
                case "insert-hobby":
                    require_once "./hobby-controller.php";
                    echo json_encode(insert($db));
                    break;
                case "update-hobby":
                    require_once "./hobby-controller.php";
                    echo json_encode(update($db, $id));
                    break;
                case "insert-skill":
                    require_once "./skill-controller.php";
                    echo json_encode(insert($db));
                    break;
                case "update-skill":
                    require_once "./skill-controller.php";
                    echo json_encode(update($db, $id));
                    break;
            }
            break;
    }
}

function disableCors()
{
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
}

disableCors();
router();
