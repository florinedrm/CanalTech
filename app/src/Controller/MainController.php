<?php

namespace App\Controller;

use App\Service\TaskService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    private $taskService;
    
    public function __construct(TaskService $taskService)

    {
         $this->taskService = $taskService;
    }

    /**
     * @Route("/", name="main_home")
     */
    public function home(Request $request): Response
    {
        // Filtres
        $sortProject = $request->query->get('sortProject');

        $tasks = $this->taskService->buildResult($sortProject);

        $total = $this->taskService->getTotalInvoiced();

        return $this->render('main/homepage.html.twig', array(
            'tasks' => $tasks,
            'total' => $total
        ));
    }
}
