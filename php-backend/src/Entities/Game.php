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
     * @ManyToOne(targetEntity="Player")
     * @JoinColumn(name="player1_id", referencedColumnName="id")
     */
    protected $player1;

    /**
     * @ManyToOne(targetEntity="Player")
     * @JoinColumn(name="player2_id", referencedColumnName="id")
     */
    protected $player2;

    /**
     * @ManyToOne(targetEntity="Bracket", inversedBy="assignedGame")
     **/
    protected $bracket;

    /**
     * @var int
     * @Column(type="integer")
     */
    protected $roundInBracket;

    /**
     * @var int
     * @Column(type="integer")
     */
    protected $positionInRound;

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

    public function getPlayer1Points(): int
    {
        return $this->player1Points;
    }

    public function setPlayer1Points(int $player1Points): void
    {
        $this->player1Points = $player1Points;
    }

    public function getPlayer2Points(): int
    {
        return $this->player2Points;
    }

    public function setPlayer2Points(int $player2Points): void
    {
        $this->player2Points = $player2Points;
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

    public function getRoundInBracket(): int
    {
        return $this->roundInBracket;
    }

    public function setRoundInBracket(int $roundInBracket): void
    {
        $this->roundInBracket = $roundInBracket;
    }

    public function getWinner(): Player {
        if($this->player1Points == null || $this->player2Points == null) {
            return null;
        }
        if($this->player1Points == $this->player2Points) {
            return rand(0,1) < 0.5 ? $this->player1 : $this->player2;
        }
        return $this->player1Points < $this->player2Points ? $this->player2 : $this->player1;
    }

    public function getPositionInRound(): int
    {
        return $this->positionInRound;
    }

    public function setPositionInRound(int $positionInRound): void
    {
        $this->positionInRound = $positionInRound;
    }

    public function jsonSerialize(): array
    {
        return array(
            'id' => $this->id,
            'player1' => $this->player1,
            'player2' => $this->player2,
            'player1Points' => $this->player1Points,
            'player2Points' => $this->player2Points,
            'roundInBracket' => $this->roundInBracket,
            'positionInRound' => $this->positionInRound
        );
    }
}
