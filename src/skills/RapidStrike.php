<?php


class RapidStrike extends AbstractSkill
{
    use ModifiersSkillTrait;
    private $modifier;
    private $duration;
    public function __construct($chance, $modifier, $duration)
    {
        parent::__construct($chance);
        $this->name = "RapidStrike";
        $this->type = "attack";
        $this->duration = $duration;
        $this->modifier = $modifier;
    }
    public function use()
    {
        if($this->tryUse())
            $this->modifyStats($this->owner->attackCountMod["actual"], $this->owner->attackCountMod["time"], '*');
    }
}