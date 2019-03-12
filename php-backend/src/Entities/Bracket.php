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
     * @OneToMany(targetEntity="Player", mappedBy="bracket", cascade={"persist", "remove"})
     **/
    protected $players;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="assignedBracket")
     **/
    protected $user;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $name;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    public function setUser(User $user)
    {
        $user->assignedBracket($this);
        $this->user = $user;
    }

    public function assignedGame(Game $game)
    {
        $this->games[] = $game;
    }

    public function assignedPlayer(Player $player)
    {
        $this->players[] = $player;
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

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function getPlayersArray(): array {
        return $this->players->toArray();
    }

    public function jsonSerialize(): array
    {
       return array(
           'id' => $this->id,
           'name' => $this->getName(),
           'games' => $this->getGames()->toArray()
       );
    }

}
