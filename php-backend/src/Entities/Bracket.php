<?php

namespace ESportsBracketBuilder\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="brackets")
 **/
class Bracket implements \JsonSerializable
{
    /**
     * @var int
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @OneToMany(targetEntity="Game", mappedBy="bracket", cascade={"persist", "remove"})
     **/
    protected $games;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $name;

    /**
     * @var int
     * @Column(type="integer")
     */
    protected $playerCount;

    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

    public function assignedGame(Game $game)
    {
        $this->games[] = $game;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getGames()
    {
        return $this->games;
    }

    public function setPlayerCount(int $playerCount): void
    {
        $this->playerCount = $playerCount;
    }

    public function getPlayerCount(): int
    {
        return $this->playerCount;
    }

    public function jsonSerialize(): array
    {
       return array(
           'id' => $this->id,
           'name' => $this->getName(),
           'games' => $this->getGames()->toArray(),
           'playerCount' => $this->getPlayerCount()
       );
    }

}
