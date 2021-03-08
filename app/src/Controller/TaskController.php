<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Service\TaskService;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/tache", name="task_")
 */
class TaskController extends AbstractController
{
    private $em;
    private $taskService;

    public function __construct(EntityManagerInterface $em, TaskService $taskService)
    {
        $this->em = $em;
        $this->taskService = $taskService;
    }

    /**
     * @Route("/nouveau", name="create")
     */
    public function create(Request $request): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($task);
            $this->em->flush();

            $this->addFlash('success',"La tâche a bien été créée.");

            return $this->redirectToRoute('main_home');
        }

        return $this->render('task/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
    * @Route("/modifier/{id}", name="update", requirements={"id"="\d+"})
    */
    public function update(Request $request, $id): Response
    {
        $task = $this->taskService->getOne($id);

        return $this->redirectToRoute('main_home');
    }

    /**
    * @Route("/supprimer/{id}", name="delete", requirements={"id"="\d+"})
    */
    public function delete($id): Response
    {
        $task = $this->taskService->getOne($id);

        $this->em->remove($task);
        $this->em->flush();

        $this->addFlash('success',"La tâche a bien été supprimée.");

        return $this->redirectToRoute('main_home', array(
            'task' => $task
        ));
    }
}
