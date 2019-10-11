<?php
/**
 * Created by PhpStorm.
 * User: Macbookpro
 * Date: 10/10/2019
 * Time: 13:25
 */

namespace App\Controller;
use App\Entity\Knight;
use App\Services\KnightService;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class KnightController extends AbstractFOSRestController
{
    /**
     * @var KnightService
     */
    private $knightService;


    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(KnightService $knightService, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->knightService = $knightService ;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }


    /**
     * Creates an knight
     * @Rest\Post("/knight")
     * @param Request $request
     * @return View
     */
    public function postKnight(Request $request) : View
    {

        $resource = $request->getContent();

        try{
            $knight = $this->serializer->deserialize($resource,Knight::class,'json',[
                'allow_extra_attributes' => false,
            ]);
        }catch (NotNormalizableValueException $exception){
            throw new \InvalidArgumentException('form is not valid',Response::HTTP_BAD_REQUEST);
        }

        $errors = $this->validator->validate($knight);

        if (count($errors) > 0){
            throw new \InvalidArgumentException('form is not valid',Response::HTTP_BAD_REQUEST);
        }

        $this->knightService->post($knight);
        return View::create('created',Response::HTTP_CREATED);
    }

    /**
     * gets a knight by id
     * @Rest\Get("/knight/{id}")
     * @param Request $request
     * @return View
     * @throws EntityNotFoundException
     */
    public function getKnight(Request $request, $id) : View
    {
        $knight = $this->knightService->get($id);
        if (!$knight){
            throw new EntityNotFoundException('Knight #'. $id .' not found.',Response::HTTP_NOT_FOUND);
        }
        return View::create($knight, Response::HTTP_OK);
    }

    /**
     * gets a knight by id
     * @Rest\Get("/knights")
     * @param Request $request
     * @return View
     * @throws EntityNotFoundException
     */
    public function getKnights(Request $request) : View
    {
        $offset = $request->query->get('offset');
        $limit = $request->query->get('limit');
        $knights = $this->knightService->all($offset,$limit) ;

        try{
            return View::create($knights, Response::HTTP_OK);
        }catch (NotNormalizableValueException $notNormalizableValueException){
            throw new \InvalidArgumentException('form is not valid');
        }


    }
}