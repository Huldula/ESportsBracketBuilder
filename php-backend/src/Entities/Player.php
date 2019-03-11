<?php

namespace ESportsBracketBuilder\Entities;

/**
 * @Entity @Table(name="players")
 */
class Player
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $firstName;

    /** @Column(type="string") **/
    protected $lastName;




    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }


}