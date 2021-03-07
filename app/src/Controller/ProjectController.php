<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/projet", name="project_")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/nouveau", name="create")
     */
    public function create(): Response
    {
        return $this->render('project/create.html.twig');
    }
}
