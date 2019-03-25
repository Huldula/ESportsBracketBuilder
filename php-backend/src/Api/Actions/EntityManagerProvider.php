<?php

namespace ESportsBracketBuilder\Api\Actions;

use Doctrine\ORM\EntityManager;

class EntityManagerProvider
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
}