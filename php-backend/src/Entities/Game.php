<?php

namespace ESportsBracketBuilder\Entities;
/**
 * @Entity @Table(name="games")
 */
class Game implements \JsonSerializable
{

    /**
     * @var int
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Player", cascade={"persist", "remove"})
     * @JoinColumn(name="player1_id", referencedColumnName="id")
     */
    protected $player1;

    /**
     * @ManyToOne(targetEntity="Player", cascade={"persist", "remove"})
     * @JoinColumn(name="player2_id", referencedColumnName="id")
     */
    protected $player2;

    /**
     * @ManyToOne(targetEntity="Player", cascade={"persist", "remove"})
     * @JoinColumn(name="winner_id", referencedColumnName="id")
     */
    protected $winner;

    /**
     * @ManyToOne(targetEntity="Bracket", inversedBy="assignedGame")
     **/
    protected $bracket;

    /**
     * @var int
     * @Column(type="integer")
     */
    protected $roundIndex;

    /**
     * @var int
     * @Column(type="integer")
     */
    protected $positionIndex;

    public function getId(): int
    {
        return $this->id;
    }

    public function getPlayer1(): Player
    {
        return $this->player1;
    }

    public function setPlayer1(Player $player1): void
    {
        $this->player1 = $player1;
    }

    public function getPlayer2(): Player
    {
        return $this->player2;
    }

    public function setPlayer2(Player $player2): void
    {
        $this->player2 = $player2;
    }

    public function getWinner()
    {
        return $this->winner;
    }

    public function setWinner(Player $winner): void
    {
        $this->winner = $winner;
    }

    public function setBracket(Bracket $bracket)
    {
        $bracket->assignedGame($this);
        $this->bracket = $bracket;
    }

    public function getBracket(): Bracket
    {
        return $this->bracket;
    }

    public function getRoundIndex(): int
    {
        return $this->roundIndex;
    }

    public function setRoundIndex(int $roundIndex): void
    {
        $this->roundIndex = $roundIndex;
    }

    public function getPositionIndex(): int
    {
        return $this->positionIndex;
    }

    public function setPositionIndex(int $positionIndex): void
    {
        $this->positionIndex = $positionIndex;
    }

    public function jsonSerialize(): array
    {
        return array(
            'id' => $this->id,
            'player1' => $this->player1,
            'player2' => $this->player2,
            'winner' => $this->winner,
            'roundIndex' => $this->roundIndex,
            'positionIndex' => $this->positionIndex
        );
    }
}
