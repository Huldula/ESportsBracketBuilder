<?php

namespace ESportsBracketBuilder\Entities;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="users")
 **/
class User
{
    /**
     * @var int
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $password;

    /**
     * @var string
     * @Column(type="string", unique=true, nullable=false)
     */
    protected $email;

    /**
     * @OneToMany(targetEntity="Bracket", mappedBy="user")
     **/
    protected $brackets;

    public function __construct()
    {
        $this->brackets = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = hash('sha256', $password);
    }

    public function checkPassword(string $password): bool {
        return $this->password == hash('sha256', $password);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function assignedBracket(Bracket $bracket)
    {
        $this->brackets[] = $bracket;
    }

    public function getBrackets(): ArrayCollection
    {
        return $this->brackets;
    }

}
