<?php

trait ModifiersSkillTrait {
    public function modifyStats(&$stat, &$duration, $sign) {
        switch ($sign){
            case '*':
                $stat*=$this->modifier;
                break;
            case '+':
                $stat+=$this->modifier;
                break;
            case '-':
                $stat-=$this->modifier;
                break;
            case '/':
                $stat/=$this->modifier;
                break;
        }
        $duration = $this->duration;
    }
    private function tryUse():bool {
        if(Utils::tryLuck($this->chance)) {
            Utils::log($this->owner->name . " Used skill named '". $this->name ."'");
            return true;;
        }

        return false;
    }
}