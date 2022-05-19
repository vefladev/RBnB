<?php

namespace App\Controller;

use App\Entity\RoomLine;
use App\Form\RoomLineType;
use App\Repository\RoomLineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/room/line')]
class RoomLineController extends AbstractController
{
    #[Route('/', name: 'app_room_line_index', methods: ['GET'])]
    public function index(RoomLineRepository $roomLineRepository): Response
    {
        return $this->render('room_line/index.html.twig', [
            'room_lines' => $roomLineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_room_line_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RoomLineRepository $roomLineRepository): Response
    {
        $roomLine = new RoomLine();
        $form = $this->createForm(RoomLineType::class, $roomLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomLineRepository->add($roomLine, true);

            return $this->redirectToRoute('app_room_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('room_line/new.html.twig', [
            'room_line' => $roomLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_room_line_show', methods: ['GET'])]
    public function show(RoomLine $roomLine): Response
    {
        return $this->render('room_line/show.html.twig', [
            'room_line' => $roomLine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_room_line_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RoomLine $roomLine, RoomLineRepository $roomLineRepository): Response
    {
        $form = $this->createForm(RoomLineType::class, $roomLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomLineRepository->add($roomLine, true);

            return $this->redirectToRoute('app_room_line_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('room_line/edit.html.twig', [
            'room_line' => $roomLine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_room_line_delete', methods: ['POST'])]
    public function delete(Request $request, RoomLine $roomLine, RoomLineRepository $roomLineRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$roomLine->getId(), $request->request->get('_token'))) {
            $roomLineRepository->remove($roomLine, true);
        }

        return $this->redirectToRoute('app_room_line_index', [], Response::HTTP_SEE_OTHER);
    }
}
