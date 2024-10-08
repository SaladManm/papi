<?php

namespace App\Controller;

namespace App\Controller;

use App\Entity\TypeBatterie;
use App\Form\TypeBatterieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeBatterieController extends AbstractController
{
    #[Route('/admin-liste-typebatterie', name: 'liste_typebatterie')]
    public function listeTypeBatterie(EntityManagerInterface $entityManager): Response
    {
        $batteries = $entityManager->getRepository(TypeBatterie::class)->findAll();
        return $this->render('type_batterie/liste.html.twig', [
            'batteries' => $batteries,
        ]);
    }

    #[Route('/admin-modifier-typebatterie/{id}', name: 'modifier_typebatterie')]
    public function modifierTypeBatterie(TypeBatterie $batterie, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeBatterieType::class, $batterie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            return $this->redirectToRoute('liste_typebatterie');
        }

        return $this->render('type_batterie/modifier.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    

    #[Route('/admin-supprimer-typebatterie/{id}', name: 'supprimer_typebatterie')]
    public function supprimerTypeBatterie(Request $request, TypeBatterie $batterie, EntityManagerInterface $entityManager): Response {
        if ($batterie != null) {
            $entityManager->remove($batterie);
            $entityManager->flush();
            $this->addFlash('notice', 'type supprimé');
        }
        return $this->redirectToRoute('liste_typebatterie');
    }
    
}
