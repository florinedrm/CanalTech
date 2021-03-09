<?php

namespace App\Controller;

use App\Service\TaskService;
use App\Service\ProjectService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    private $taskService;
    private $projectService;
    
    public function __construct(TaskService $taskService, ProjectService $projectService)

    {
         $this->taskService = $taskService;
         $this->projectService = $projectService;
    }

    /**
     * @Route("/", name="main_home")
     */
    public function home(Request $request): Response
    {
        // Filters
        $sortProject = $request->query->get('sortProject');
        $sortTime = $request->query->get('sortTime');

        // All tasks or by filters
        $tasks = $this->taskService->buildResult($sortProject, $sortTime);

        // Number of invoiced tasks
        $total = $this->taskService->getTotalInvoiced();

        // All projects
        $projects = $this->projectService->getAll();

        return $this->render('main/homepage.html.twig', array(
            'tasks' => $tasks,
            'total' => $total,
            'projects' => $projects
        ));
    }
}
