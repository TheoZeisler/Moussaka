<?php

namespace App\Artists\Infrastructure\Symfony\Controller;

use App\Artists\Infrastructure\Symfony\Model\Album;
use App\Artists\Domain\Repository\AlbumRepository;
use App\Artists\Infrastructure\Symfony\Form\AlbumType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/album')]
class AlbumController extends AbstractController{

    #[Route('/', name: 'app_album_index', methods: ['GET'])]
    public function index(AlbumRepository $albumRepository): Response
    {
        return $this->render('album/index.html.twig', [
            'albums' => $albumRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_album_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ARTIST')]
    public function new(Request $request, AlbumRepository $albumRepository, EntityManagerInterface $em): Response{

        /*$artistRepo = $em->getRepository(Artist::class);
        dd($artistRepo->findOneBy(["user" => $this->getUser()]));
        $artistRepo = new ArtistRepository();
        $artist = new Artist();
        $artist = $artistRepo->findOneBy(['id' => $this->getUser()->getId()]);
        dd($artist);
        $album = new Album($artist);*/
        $album = new \App\Artists\Domain\Entity\Album();
        $form = $this->createForm(AlbumType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $album = new Album(
                $this->getUser()
            );
            $albumRepository->save($album, true);

            return $this->redirectToRoute('app_album_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('album/new.html.twig', [
            'album' => $album,
            'form' => $form,
        ]);

        return $this->render('album/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_album_show', methods: ['GET'])]
    public function show(Album $album): Response
    {
        return $this->render('album/show.html.twig', [
            'album' => $album,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_album_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ARTIST')]
    public function edit(Request $request, Album $album, AlbumRepository $albumRepository): Response
    {
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $albumRepository->save($album, true);

            return $this->redirectToRoute('app_album_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('album/edit.html.twig', [
            'album' => $album,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_album_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ARTIST')]
    public function delete(Request $request, Album $album, AlbumRepository $albumRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$album->getId(), $request->request->get('_token'))) {
            $albumRepository->remove($album, true);
        }

        return $this->redirectToRoute('app_album_index', [], Response::HTTP_SEE_OTHER);
    }

}