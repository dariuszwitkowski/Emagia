<?php


abstract class AbstractSkill
{
    public $name;
    protected $owner;
    public $type;
    protected $chance;
    public function __construct($chance)
    {
        $this->chance = $chance;
    }
    public function setOwner(AbstractCreature $owner) {
        $this->owner = $owner;
    }
    public abstract function use();
}