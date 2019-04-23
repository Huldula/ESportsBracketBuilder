<?php

namespace ESportsBracketBuilder\Entities;

/**
 * @Entity @Table(name="players")
 **/
class Player implements \JsonSerializable
{
    /**
     * @var int
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $name;

    /**
     * @ManyToOne(targetEntity="Bracket", inversedBy="assignedPlayer")
     **/
    protected $bracket;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setBracket(Bracket $bracket)
    {
        $this->bracket = $bracket;
    }

    public function getBracket(): Bracket
    {
        return $this->bracket;
    }

    public function jsonSerialize(): array
    {
       return array(
           'id' => $this->id,
           'name' => $this->name
       );
    }
}
