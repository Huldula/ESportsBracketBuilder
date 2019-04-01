<?php

namespace ESportsBracketBuilder\Api\Actions;

use ESportsBracketBuilder\Entities\Bracket;
use ESportsBracketBuilder\Entities\Player;
use ESportsBracketBuilder\Entities\Game;

class BracketManager extends EntityManagerProvider {

    public function create(string $name, int $size): object {
        $resp = new \StdClass();
        $bracketWithName = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
            ->findBy(array(
                'name' => $name
            ));

        if($bracketWithName != null) {
            $resp->error = 'name already exists';
            return $resp;
        }

        $sizeTest = $size;
        while ($sizeTest > 1) {
            $sizeTest = $sizeTest / 2;
        }
        if ($sizeTest != 1) {
            $resp->error =  'size must me a potency of two';
            return $resp;
        }

        $bracket = new Bracket();
        $bracket->setName($name);

        $players = [];
        for ($i = 0; $i < $size; $i++) {
            $player = new Player();
            $player->setName('Player ' . $i);
            $player->setBracket($bracket);
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


        return $resp;
    }

    public function delete(int $id): object {
        $resp = new StdClass();
        $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
        ->findOneBy(array( 'id' => $id ));

        if($bracket == null) {
            $resp->error = 'bracket id does not exist';
            return $resp;
        }

        $this->entityManager->remove($bracket);
        $this->entityManager->flush();

        return $resp;
    }

    public function rename(int $id, string $name): object {
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

    public function get(int $id): object {
        $resp = new StdClass();
        $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
            ->findOneBy(array( 'id' => $id ));

        if ($bracket == null) {
            $resp->error = 'bracket id does not exist';
            return $resp;
        }

        $resp->response = $bracket;

        return $resp;
    }
}