<?php

namespace App\Controller;

use App\Entity\TMessages;
use App\Form\TMessagesType;
use App\Repository\TMessagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/messages')]
class MessagesController extends AbstractController
{
    #[Route('/', name: 'app_messages_index', methods: ['GET', 'POST'])]
    public function index(TMessagesRepository $tMessagesRepository): Response
    {
        return $this->json($tMessagesRepository->findBy([]));
    }

    #[Route('/new', name: 'app_messages_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TMessagesRepository $tMessagesRepository): Response
    {
        $data = json_decode($request->getContent(), true);

        if (trim($data['name']) === '' || trim($data['message']) === '') {
            return $this->json("error");
        }
        $tMessage = new TMessages();
        $tMessage->setName($data['name']);
        $tMessage->setMessage($data['message']);
        $tMessagesRepository->save($tMessage, true);
        return $this->json("Message sent.");
    }

    #[Route('/{id}', name: 'app_messages_show', methods: ['GET'])]
    public function show(TMessages $tMessage): Response
    {
        return $this->render('messages/show.html.twig', [
            't_message' => $tMessage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_messages_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TMessages $tMessage, TMessagesRepository $tMessagesRepository): Response
    {
        $form = $this->createForm(TMessagesType::class, $tMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tMessagesRepository->save($tMessage, true);

            return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('messages/edit.html.twig', [
            't_message' => $tMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_messages_delete', methods: ['POST'])]
    public function delete(Request $request, TMessages $tMessage, TMessagesRepository $tMessagesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tMessage->getId(), $request->request->get('_token'))) {
            $tMessagesRepository->remove($tMessage, true);
        }

        return $this->redirectToRoute('app_messages_index', [], Response::HTTP_SEE_OTHER);
    }
}
