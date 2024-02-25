<?php

namespace App\Controller;

use App\Entity\Favlist;
use App\Form\FavlistType;
use App\Repository\FavlistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/favlist')]
class FavlistController extends AbstractController
{
    #[Route('/', name: 'app_favlist_index', methods: ['GET'])]
    public function index(FavlistRepository $favlistRepository): Response
    {
        return $this->render('favlist/index.html.twig', [
            'favlists' => $favlistRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_favlist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $favlist = new Favlist();
        $form = $this->createForm(FavlistType::class, $favlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($favlist);
            $entityManager->flush();

            return $this->redirectToRoute('app_favlist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('favlist/new.html.twig', [
            'favlist' => $favlist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favlist_show', methods: ['GET'])]
    public function show(Favlist $favlist): Response
    {
        return $this->render('favlist/show.html.twig', [
            'favlist' => $favlist,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_favlist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Favlist $favlist, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FavlistType::class, $favlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('favlist/edit.html.twig', [
            'favlist' => $favlist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favlist_delete', methods: ['POST'])]
    public function delete(Request $request, Favlist $favlist, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$favlist->getId(), $request->request->get('_token'))) {
            $entityManager->remove($favlist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_favlist_index', [], Response::HTTP_SEE_OTHER);
    }
}
