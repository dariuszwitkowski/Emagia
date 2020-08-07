<?php

;

class Symulation
{
    public static function symulateOneGame() {
        $ordeus = self::prepareOrdeus();
        $beast = self::prepareBeast();
        $game = new Game(20);
        $game->setPlayers($ordeus, $beast);
        $game->symulateGame();
    }
    private static function prepareOrdeus() {
        $rapidStrike = new RapidStrike(10,2,1);
        $magicShield = new MagicShield(20, 2, 1);
        return new Player("Ordeus",[
            "health" => rand(70, 100),
            "strength" => rand(70, 80),
            "defence" => rand(45, 55),
            "attackSpeed" => rand(40, 50),
            "luck" => rand(10, 30),
            "attackCountMod" => 1,
            "damageTakenMod" => 1,
        ], [$rapidStrike, $magicShield]);
    }
    private static function prepareBeast() {
        return new NPC("Beast",[
            "health" => rand(60, 90),
            "strength" => rand(60, 90),
            "defence" => rand(40, 60),
            "attackSpeed" => rand(40, 60),
            "luck" => rand(25, 40),
            "attackCountMod" => 1,
            "damageTakenMod" => 1,
        ]);
    }
}