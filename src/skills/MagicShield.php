<?php

class MagicShield extends AbstractSkill
{
    use ModifiersSkillTrait;
    private $modifier;
    private $duration;
    public function __construct($chance, $modifier, $duration)
    {
        parent::__construct($chance);
        $this->name = "MagicShield";
        $this->type = "defence";
        $this->duration = $duration;
        $this->modifier = $modifier;
    }
    public function use()
    {
        if($this->tryUse())
            $this->modifyStats($this->owner->damageTakenMod["actual"], $this->owner->damageTakenMod["time"], '/');
    }
}