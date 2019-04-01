<?php

namespace ESportsBracketBuilder\Api;

require_once "vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use ESportsBracketBuilder\Api\Actions\BracketManager;

class Api {

    private $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        header("content-type: application/json");
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData);
        $this->processApi($data);

    }

    public function processApi(object $params) {
        $bracketManager = new BracketManager($this->entityManager);
        $resp = new \StdClass();

        if (!isset($params->action)) {
            $resp->error = 'action is not defined';
            $this->respond(400, $resp);
        }

        switch ($params->action) {
            case 'create':
                $resp = $bracketManager->create($params->name, $params->size);
                break;
            case 'delete':
                $resp = $bracketManager->delete($params->id);
                break;
            case 'rename':
                $resp = $bracketManager->rename($params->id, $params->name);
                break;
            case 'get':
                $resp = $bracketManager->get($params->id);
                break;
            default:
                $resp->error = 'action "' . $params->action . '" does not exist';
                break;
        }

        $this->respond(200, $resp);
    }

    private function respond(int $code, object $resp) {
        http_response_code(200);
        $out = array(
            'status' => 'success',
            'response' => $resp
        );
        echo json_encode($out);
        exit();
    }
}