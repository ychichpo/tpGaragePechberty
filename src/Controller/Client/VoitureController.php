<?php

namespace App\Controller\Client;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client')]
class VoitureController extends AbstractController
{

    #[Route('/mesVoitures', name: 'app_client_voiture_index', methods: ['GET'])]
    public function index(VoitureRepository $voitureRepository): Response
    {
        //$voitures=$voitureRepository->findBy(["user"=>$this->getUser()]);

        return $this->render('client/voiture/index.html.twig', [
            'voitures' => $this->getUser()->getVoitures()
        ]);
    }
    #[Route('/{id}', name: 'app_client_voiture_show', methods: ['GET'])]
    public function show(Voiture $voiture): Response
    {
        if($voiture->getUser() !==$this->getUser()){
            throw $this->createNotFoundException();
        }
        return $this->render('client/voiture/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }
    #[Route('/new', name: 'app_client_voiture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('app_client_voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }
}
