<?php

namespace ESportsBracketBuilder\Api\Actions;

use ESportsBracketBuilder\Entities\Bracket;
use ESportsBracketBuilder\Entities\Player;
use ESportsBracketBuilder\Entities\Game;
use StdClass;

class BracketManager extends EntityManagerProvider {

    public function create(string $name, int $size): StdClass {
        $resp = new StdClass();
        $bracketWithName = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
            ->findBy(array(
                'name' => $name
            ));

        if($bracketWithName != null) {
            $resp->error = 'cannot create bracket. Name "' . $name . '"" already exists';
            return $resp;
        }

        $sizeTest = $size;
        while ($sizeTest > 1) {
            $sizeTest = $sizeTest / 2;
        }
        if ($sizeTest != 1) {
            $resp->error =  'size must me a potency of two. got ' . $size;
            return $resp;
        }

        $bracket = new Bracket();
        $bracket->setName($name);

        $players = [];
        for ($i = 0; $i < $size; $i++) {
            $player = new Player();
            $player->setName('Player #' . $i);
            $player->setBracket($bracket);
            $players[$i] = $player;
        }

        for ($i = 0; $i < $size / 2; $i++) {
            $game = new Game();
            $game->setBracket($bracket);
            $game->setPlayer1($players[$i*2]);
            $game->setPlayer2($players[$i*2 + 1]);
            $game->setRoundIndex(0);
            $game->setPositionIndex($i);
        }

        $this->entityManager->persist($bracket);
        $this->entityManager->flush();

        $resp->response = $bracket;

        return $resp;
    }

    public function delete(int $id): StdClass {
        $resp = new StdClass();
        $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
        ->findOneBy(array( 'id' => $id ));

        if($bracket == null) {
            $resp->error = 'Bracket id does not exist. Got ' . $id;
            return $resp;
        }

        $this->entityManager->remove($bracket);
        $this->entityManager->flush();

        return $resp;
    }

    public function rename(int $id, string $name): StdClass {
        $resp = new StdClass();
        $bracketWithName = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
            ->findBy(array(
                'name' => $name
            ));

        if($bracketWithName != null) {
            $resp->error = 'name already exists';
            return $resp;
        }


        $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
            ->findOneBy(array( 'id' => $id ));

        $bracket->setName($name);
        $this->entityManager->flush();

        return $resp;
    }

    public function get($params): StdClass {
        $resp = new StdClass();
        if (isset($params->id)) {
            $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
                ->findOneBy(array( 'id' => $params->id ));
        } else if (isset($params->name)) {
            $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
                ->findOneBy(array( 'name' => $params->name ));
        } else {
            $resp->error = 'Id and name are not set. At least one of them has to be set';
            return $resp;
        }

        if ($bracket == null) {
            $resp->error = 'bracket id does not exist';
            return $resp;
        }

        $resp->response = $bracket;

        return $resp;
    }

    public function getAll(): StdClass {
        $resp = new StdClass();

        $brackets = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
            ->findBy(array());

        if ($brackets == null) {
            $resp->response = [];
        }

        $resp->response = $brackets;

        return $resp;
    }
}