<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tache", name="task_")
 */
class TaskController extends AbstractController
{
    /**
     * @Route("/nouveau", name="create")
     */
    public function create(): Response
    {
        return $this->render('task/create.html.twig');
    }
}
