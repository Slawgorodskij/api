<?php

use App\Command\ReadPaging;
use App\Command\SearchNote;
use App\Config\Autoload;
use App\Config\Database;
use App\Entities\Note;
use App\Http\Request;

include "../Config/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$request = new Request(
    $_SERVER,
    $_POST,
    $_GET,
);
$database = new Database();
$note = new Note();

$path = $request->getPath();
$method = $request->getMethod();
$data = $request->getJsonBody();
$params = $request->getParams();
$page = $request->getPage();
$id = $path['id'] ?? null;


if (isset($params) && $path['path'] === 'notebook') {
    $search = new SearchNote();
    $search->searchNote($params);
    die();
}

if (isset($page) && $path['path'] === 'notebook') {
    $readPaging = new ReadPaging($database, $note, $page);
    $readPaging->readPaging();
    die();
}

switch ($path['path']) {
    case 'index':
        include_once '../vi/index.php';
        break;
    case 'notebook':
        include_once '../controller/controller.php';
        controller($database, $note, $method, $data, $id);
        break;
    default:
        http_response_code(404);
        echo json_encode(['message' => 'Такой страницы нет.'], JSON_UNESCAPED_UNICODE);
};







