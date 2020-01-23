<?php
namespace App\Controller;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $repository, EntityManagerInterface  $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response {

        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties'
        ]);

    }

    /**
     * @Route("/biens{slug-}{id}", name="property.index", requirements={"slug": [a-z0-9\-]*})
     * @return Response
     */
    public function show($slug, $id): Response
    {
        $property = $this->repository->find($id);
        return $this->render('property/show.html.twig',[
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }

}