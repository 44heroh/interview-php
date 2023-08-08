<?php
namespace App\Controller;

use App\Form\DataForm;
use App\Service\DataService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var DataService
     */
    private DataService $dataService;

    /**
     * DataController constructor.
     * @param EntityManagerInterface $entityManager
     * @param DataService $dataService
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        DataService $dataService
    )
    {
        $this->entityManager = $entityManager;
        $this->dataService = $dataService;
    }

    #[Route(path: '/find_range', name: 'find_range', methods: ['GET', 'POST'])]
    public function findRange(Request $request): Response
    {
        $form = $this->createForm(DataForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $this->dataService->getRangeId($form->getData()["number"]);
            return $this->render('/data/form/form.html.twig', [
                'form' => $form->createView(),
                'id' => $id,
            ]);
        } else {

            return $this->render('/data/form/form.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }
}