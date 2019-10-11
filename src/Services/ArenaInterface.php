<?php
/**
 * Created by PhpStorm.
 * User: Macbookpro
 * Date: 10/10/2019
 * Time: 00:00
 */

namespace App\Services;


use App\Entity\FightInterface;

interface ArenaInterface
{
    public function fight(FightInterface $fighter1, FightInterface $fighter2): int;

}