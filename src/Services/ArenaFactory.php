<?php
/**
 * Created by PhpStorm.
 * User: Macbookpro
 * Date: 11/10/2019
 * Time: 14:35
 */

namespace App\Services;


class ArenaFactory
{
    /**
     * Allows us to create an instance of the service using the parameters required
     * @return mixed
     */
    public static function createArena(string $type = 'HumanArena')
    {
        $arena = null;

        switch ($type){
            case  'HumanArena':
                $arena = new ArenaService();
                break;
            case 'GoblinArena':
                // $arena = new GoblinArenaService();
                break;
            default :
                $arena = new ArenaService();
                break;
        }

        return $arena;
    }

}