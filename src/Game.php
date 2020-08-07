<?php

class Game {
    private $duration;
    private $turn;
    private $p1;
    private $p2;
    public function __construct($duration) {
        $this->duration = $duration;
    }
    public function setPlayers(AbstractCreature $p1, AbstractCreature $p2) {
        $this->p1 = $p1;
        $this->p2 = $p2;
    }
    public function symulateGame() {
        $firstFighter = $this->selectFirstFighter($this->p1,$this->p2);
        $secFighter = null;
        if($firstFighter == $this->p1)
            $secFighter = $this->p2;
        else
            $secFighter = $this->p1;
        $this->turn=1;
        while ($this->turn <= $this->duration) {
            if(!$this->playTurn($firstFighter, $secFighter))
                return;
            if(!$this->playTurn($secFighter, $firstFighter))
                return;
            $this->turn++;
        }
        $this->finishGame();
    }
    private function playTurn(AbstractCreature $player, AbstractCreature $target) {
        Utils::log("TURN: ".$this->turn .") ".$player->name." attack ". $target->name);
        $player->performAttack($target);
        if (!$target->isAlive()) {
            $this->finishGame($player);
            return false;
        }
        return true;
    }
    private function finishGame(AbstractCreature $winner = null) {
        if($winner == null)  {
            if($this->p1->getHealth() > $this->p2->getHealth())
                $winner = $this->p1;
            else if($this->p1->getHealth() < $this->p2->getHealth())
                $winner = $this->p2;
        }
        if($winner == null) {
            Utils::log("DRAW: ".$this->p1->getHealth."HP ".$this->p1->getHealth."HP");
        } else {
            Utils::log("Winner: ".$winner->name. " with: ". $winner->getHealth()."HP");
        }
    }
    private function selectFirstFighter(AbstractCreature $p1, AbstractCreature $p2) {
        $players = null;
        if($p1->getAttackSpeed() != $p2->getAttackSpeed()) {
            $val1 = $p1->getAttackSpeed();
            $val2 = $p2->getAttackSpeed();
        } else if($p1->getLuck() != $p2->getLuck()) {
            $val1 = $p1->getLuck();
            $val2 = $p2->getLuck();
        } else return $p1;
        $players = [
            $val1 => $p1,
            $val2 => $p2,
        ];
        return $players[max($val1,$val2)];
    }
}
