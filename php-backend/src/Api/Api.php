<?php

namespace ESportsBracketBuilder\Api;

require_once "vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use ESportsBracketBuilder\Api\Actions\BracketManager;
use StdClass;

class Api {

    private $entityManager;

    public function __construct(EntityManager $entityManager) {
        $resp = new StdClass();

        $this->entityManager = $entityManager;
        header("content-type: application/json");
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData);
        if ($data == null) {
            $resp->error = 'action is not defined';
            $this->respond(400, $resp);
        }
        $this->processAndRespond($data);

    }

    public function processAndRespond($params) {
        $bracketManager = new BracketManager($this->entityManager);
        $resp = new StdClass();

        if (!isset($params->action)) {
            $resp->error = 'Action is not defined';
            $this->respond(400, $resp);
        }

        switch ($params->action) {
            case 'create':
                $resp = $bracketManager->create($params);
                break;
            case 'delete':
                $resp = $bracketManager->delete($params);
                break;
            case 'rename':
                $resp = $bracketManager->rename($params);
                break;
            case 'shuffle':
                $resp = $bracketManager->shuffle($params);
                break;
            case 'setWinner':
                $resp = $bracketManager->setWinner($params);
                break;
            case 'get':
                $resp = $bracketManager->get($params);
                break;
            case 'getAll':
                $resp = $bracketManager->getAll();
                break;
            default:
                $resp->error = 'action "' . $params->action . '" does not exist';
                $this->respond(400, $resp);
                break;
        }

        $this->respond(200, $resp);
    }

    private function respond(int $code, StdClass $resp) {
        http_response_code($code);
        $out = array(
            'response' => $resp
        );
        echo json_encode($out);
        exit();
    }
}