<?php

use ESportsBracketBuilder\Api\Actions\BracketManager;
use PHPUnit\Framework\TestCase;


class BracketManagerTest extends TestCase
{

    public function testCreateWrongSize() {
        $this->assertFalse(BracketManager::isValidSize(3));
    }
}