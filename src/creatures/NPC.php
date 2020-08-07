<?php

class NPC extends AbstractCreature {
    public function performAttack(AbstractCreature $defender) {
        $this->giveDamage($defender);
    }
    public function getHit($strength) {
        $this->takeDamage($strength);
    }
}