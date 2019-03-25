<?php

namespace ESportsBracketBuilder\Api;

class Api {

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        header("content-type: application/json");
        $rawData = file_get_contents('php://input');
        $this->processApi($parsedRequestData);
    }
}