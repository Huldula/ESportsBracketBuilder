<?php

use ESportsBracketBuilder\Entities\Bracket;
use ESportsBracketBuilder\Api\Actions\EntityManagerProvider;
use ESportsBracketBuilder\Entities\Player;
use ESportsBracketBuilder\Entities\Game;

class BracketManager extends EntityManagerProvider {

    public function create(string $name, array $players) {
        shuffle($players);

        $bracket = new Bracket();
        $bracket->setName($name);


        foreach ($players as $pl) {
            $player = new Player();
            $player->setName($pl->name);
            $player->setBracket($bracket);
        }

        for ($i = 0; $i < sizeof($players) / 2; $i++) {
            $game = new Game();
            $game->setBracket($bracket);
            $game->setPlayer1($players[$i*2]);
            $game->setPlayer2($players[$i*2 + 1]);
            $game->setRoundIndex(0);
            $game->setPositionIndex($i);
        }

        $this->entityManager->persist($bracket);
        $this->entityManager->flush();
    }

    public function delete(int $id) {
        $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
        ->findOneBy(array( 'id' => $id ));

        $this->entityManager->remove($bracket);
        $this->entityManager->flush();
    }

    public function rename(int $id, string $name) {
        $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
            ->findOneBy(array( 'id' => $id ));

        $bracket->setName($name);
        $this->entityManager->flush();
    }

    public function get(int $id): object {
        $bracket = $this->entityManager->getRepository('ESportsBracketBuilder\Entities\Bracket')
            ->findOneBy(array( 'id' => $id ));

        return $bracket;
    }
}