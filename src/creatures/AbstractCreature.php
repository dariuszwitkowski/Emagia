<?php

abstract class AbstractCreature {
    public $name;
    protected $health;
    protected $strength;
    protected $defence;
    protected $attackSpeed;
    public $attackCountMod;
    public $damageTakenMod;
    private $luck;
    public function __construct($name, $stats) {
        $this->name = $name;
        $this->health = $stats["health"];
        $this->strength = $stats["strength"];
        $this->defence = $stats["defence"];
        $this->attackSpeed = $stats["attackSpeed"];
        $this->luck = $stats["luck"];
        $this->attackCountMod["default"] = $stats["attackCountMod"];
        $this->attackCountMod["actual"] = $stats["attackCountMod"];
        $this->attackCountMod["restoreTime"] = 0;
        $this->damageTakenMod["default"] = $stats["damageTakenMod"];
        $this->damageTakenMod["actual"] = $stats["damageTakenMod"];
        $this->damageTakenMod["restoreTime"] = 0;
    }
    public abstract function performAttack(AbstractCreature $defender);
    public abstract function getHit($strength);

    public function giveDamage(AbstractCreature $target) {
        $attacks = $this->attackCountMod["actual"];
        for($i = 0; $i<$attacks; $i++)
            $target->getHit($this->strength);
        $this->restoreModifier($this->attackCountMod);
    }
    public function takeDamage($strength) {
        if($this->tryDodge())
            return;
        $damage = ($strength-$this->defence)*$this->damageTakenMod["actual"];
        $this->health -= $damage;
        if ($this->health < 0)
            $this->health = 0;
        Utils::log($this->name." Recived ". $damage . "DMG. " . $this->health . "HP Left");
        $this->restoreModifier($this->damageTakenMod);
    }
    public function getAttackSpeed() :int {
        return $this->attackSpeed;
    }
    public function getLuck() :int {
        return $this->attackSpeed;
    }
    public function isAlive() :bool {
        return $this->health > 0;
    }
    public function getHealth() :int {
        return $this->health;
    }
    protected function tryDodge() : bool {
        if(Utils::tryLuck($this->luck)) {
            Utils::log($this->name . " Successfully dodged incoming attack");
            return true;
        }
        return false;
    }
    protected function restoreModifier(&$modifier) {
        if($modifier == -1)
            return;
        if($modifier["restoreTime"]!=0) {
            $modifier["restoreTime"]--;
        } else {
            $modifier["actual"] = $modifier["default"];
        }
    }


}