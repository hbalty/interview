<?php
/**
 * Created by PhpStorm.
 * User: Macbookpro
 * Date: 10/10/2019
 * Time: 13:46
 */

namespace App\Services;


use App\Entity\Knight;
use App\Handler\HandlerInterface;
use App\Repository\KnightRepository;



final class KnightService implements HandlerInterface
{

    /**
     * @var knightRepository
     */
    private $knightRepository;


    public function __construct(KnightRepository $knightRepository)
    {
        $this->knightRepository = $knightRepository;
    }

    /**
     * Get a resource
     *
     * @param int $id
     * @return Object
     */
    public function get($id)
    {
        $knight = $this->knightRepository->find($id) ;
        return $knight ;
    }

    /**
     * Get a collection of resources
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function all($limit, $offset)
    {
        $knights = $this->knightRepository->all($limit, $offset);
        return $knights;
    }

    /**
     * Register a resource
     *
     * @param $resource
     * @return mixed
     */
    public function post($resource)
    {
        $this->knightRepository->save($resource);
    }
}