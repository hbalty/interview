<?php
/**
 * Created by PhpStorm.
 * User: Macbookpro
 * Date: 09/10/2019
 * Time: 23:24
 */

namespace App\Services;


use App\Entity\FightInterface;

class ArenaService implements ArenaInterface
{
    public function fight(FightInterface $fighter1, FightInterface $fighter2): int
    {
        if ($fighter1->calculatePowerLevel() > $fighter2->calculatePowerLevel()){
            return 1;
        }elseif ($fighter1->calculatePowerLevel() < $fighter2->calculatePowerLevel()){
            return -1;
        }else {
            return 0;
        }
    }
}