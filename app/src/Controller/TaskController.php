<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
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

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
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
    * @Route("/supprimer/{id}", name="delete", requirements={"id"="\d+"})
    */
    public function delete($id): Response
    {
        $task = $this->em->getRepository(Task::class)->find($id);

        $this->em->remove($task);
        $this->em->flush();

        $this->addFlash('success',"La tâche a bien été supprimée.");

        return $this->redirectToRoute('main_home', array(
            'task' => $task
        ));
    }
}
