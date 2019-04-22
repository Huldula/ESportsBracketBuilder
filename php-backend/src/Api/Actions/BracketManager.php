<?php

namespace ESportsBracketBuilder\Api\Actions;

use ESportsBracketBuilder\Entities\Bracket;
use ESportsBracketBuilder\Entities\Player;
use ESportsBracketBuilder\Entities\Game;
use StdClass;

class BracketManager extends EntityManagerProvider {

    public function create($params): StdClass {
        $resp = new StdClass();
        if (!isset($params->name)) {
            return self::withError($resp, 'Cannot create bracket. Name has to be set');
        }
        if (!isset($params->size)) {
            return self::withError($resp, 'Cannot create bracket. Size has to be set');
        }

        $bracketWithName = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
            ->findBy(array(
                'name' => $params->name
            ));

        if($bracketWithName != null) {
            return self::withError($resp, 'Cannot create bracket. Name "' . $params->name . '"" already exists');
        }

        $sizeTest = $params->size;
        while ($sizeTest > 1) {
            $sizeTest = $sizeTest / 2;
        }
        if ($sizeTest != 1) {
            return self::withError($resp, 'Cannot create bracket. Size must me a potency of two. got ' . $params->size);
        }

        $bracket = new Bracket();
        $bracket->setName($params->name);

        $players = [];
        for ($i = 0; $i < $params->size; $i++) {
            $player = new Player();
            $player->setName('Player #' . $i);
            $player->setBracket($bracket);
            $players[$i] = $player;
        }

        shuffle($players);

        for ($i = 0; $i < $params->size / 2; $i++) {
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

    public function delete($params): StdClass {
        $resp = new StdClass();

        if (isset($params->id)) {
            $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
                ->findOneBy(array( 'id' => $params->id ));
        } else if (isset($params->name)) {
            $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
                ->findOneBy(array( 'name' => $params->name ));
        } else {
            return self::withError($resp, 'Cannot delete bracket. Name or id has to be set');
        }


        if($bracket == null) {
            return self::withError($resp, 'Cannot delete bracket. Id/name does not exist. 
            Got id: "' . $params->id . '"" name: "' . $params->name . '"');
        }

        $this->entityManager->remove($bracket);
        $this->entityManager->flush();

        return $resp;
    }

    public function rename($params): StdClass {
        $resp = new StdClass();

        if (!isset($params->name)) {
            return self::withError($resp, 'Cannot rename bracket. New name has to be set');
        }
        if (!isset($params->id)) {
            return self::withError($resp, 'Cannot rename bracket. Id has to be set');
        }

        $bracketWithName = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
            ->findBy(array(
                'name' => $params->name
            ));

        if($bracketWithName != null) {
            return self::withError($resp, 'Cannot rename bracket. Name already exists');
        }

        $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
            ->findOneBy(array( 'id' => $params->id ));

        if ($bracket == null) {
            return self::withError($resp, 'Cannot rename bracket. Id does not exist. Got ' . $params->id);
        }

        $bracket->setName($params->name);
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
            return self::withError($resp, 'Cannot get bracket. Name or id has to be set');
        }

        if ($bracket == null) {
            return self::withError($resp, 'Cannot get bracket. Id does not exist');
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


    // TODO does not work: $brackets->getPlayers() returns empty object
    public function shuffle($params): StdClass {
        $resp = new StdClass();
        if (isset($params->id)) {
            $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
                ->findOneBy(array( 'id' => $params->id ));
        } else if (isset($params->name)) {
            $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
                ->findOneBy(array( 'name' => $params->name ));
        } else {
            return self::withError($resp, 'Cannot shuffle bracket. Name or id has to be set');
        }

        if ($bracket == null) {
            return self::withError($resp, 'Cannot shuffle bracket. Id/name does not exist. 
            Got id: "' . $params->id . '" name: "' . $params->name . '"');
        }


        foreach ($bracket->getGames() as $game) {
            $this->entityManager->remove($game);
        }
        $players = $bracket->getPlayers();

        shuffle($players);

        for ($i = 0; $i < $params->size / 2; $i++) {
            $game = new Game();
            $game->setBracket($bracket);
            $game->setPlayer1($players[$i*2]);
            $game->setPlayer2($players[$i*2 + 1]);
            $game->setRoundIndex(0);
            $game->setPositionIndex($i);
        }

        return $resp;
    }

    public function setWinner($params): StdClass {
        $resp = new StdClass();



        return $resp;
    }


    private static function withError($resp, string $error) {
        $resp->error = $error;
        return $resp;
    }
}