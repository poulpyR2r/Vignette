<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Photo;
use App\Form\PhotoFormType;
use App\Repository\PhotoRepository;





class UploadController extends AbstractController
{
    #[Route('/upload/photo', name: 'app_upload_photo')]
    public function index( Request $request ,PhotoRepository $photoRepository): Response
    {
        $photo  = new Photo();
       
        $form = $this->createForm(PhotoFormType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photoRepository->save($photo, true);

            // return $this->redirectToRoute('app_profile_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('upload/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
