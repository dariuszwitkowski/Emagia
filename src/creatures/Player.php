<?php



class Player extends AbstractCreature {
    public $skills;
    public function __construct($name, $stats, $skills)
    {
        parent::__construct($name, $stats);
        $this->skills = $skills;
        foreach ($this->skills as $skill) {
            $skill->setOwner($this);
        }
    }
    private function useSkills($skillType) {
        foreach($this->skills as $skill) {
            if($skill->type == $skillType)
                $skill->use();
        }
    }
    public function performAttack(AbstractCreature $defender) {
        $this->useSkills("attack");
        $this->giveDamage($defender);
    }
    public function getHit($strength) {
        $this->useSkills("defence");
        $this->takeDamage($strength);
    }
}