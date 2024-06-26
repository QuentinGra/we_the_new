<?php

namespace App\Controller\Backend;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/users', name: 'admin.users')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UserRepository $userRepository
    ) {
    }

    #[Route('', name: '.index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        return $this->render('Backend/Users/index.html.twig', [
            'users' => $this->userRepository->findPaginateOrderByDate(
                $request->query->getInt('limit', 9),
                $request->query->getInt('page', 1),
                $request->query->get('search')
            ),
        ]);
    }

    #[Route('/{id}/edit', name: '.edit', methods: ['GET', 'POST'])]
    public function edit(?User $user, Request $request): Response|RedirectResponse
    {
        if (!$user) {
            $this->addFlash('danger', 'Utilisateur non trouvé.');

            return $this->redirectToRoute('admin.users.index');
        }

        $form = $this->createForm(UserType::class, $user, ['isAdmin' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            $this->addFlash('success', 'Utilisateur modifié avec succès.');

            return $this->redirectToRoute('admin.users.index');
        }

        return $this->render('Backend/Users/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: '.delete', methods: ['POST'])]
    public function delete(?User $user, Request $request): RedirectResponse
    {
        if (!$user) {
            $this->addFlash('danger', 'Utilisateur non trouvé.');

            return $this->redirectToRoute('admin.users.index');
        }

        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('token'))) {
            $this->em->remove($user);
            $this->em->flush();

            $this->addFlash('success', 'Utilisateur supprimé avec succès.');
        } else {
            $this->addFlash('danger', 'Jeton CSRF invalide.');

            return $this->redirectToRoute('admin.users.index');
        }

        return $this->redirectToRoute('admin.users.index');
    }
}
