<?php

namespace AppBundle\Controller;

use AppBundle\Form\Army\UploadPhotoFigurineType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Army\FigurineArmy;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Army\PhotoFigurine;
use AppBundle\Form\Army\PhotoFigurineType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PhotoFigurineController extends Controller
{
    // Gestion d'ajout d'une photo Figurine
    public function addAction(Request $request, FigurineArmy $figurineArmy)
    {
        // On vérifie si le visiteur est le proprio de la figurine
        if($figurineArmy->getArmy()->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous n\'avez pas les droits suffisants pour ajouter une photo à cette figurine !');
        }
        $em = $this->getDoctrine()->getManager();

//        // On crée une instance de photoFigurine lié à la figurine
//        $photo = new PhotoFigurine();
//        $photo->setFigurine($figurineArmy);
//
//        $form = $this->createForm(PhotoFigurineType::class, $photo);
//
//        $form->add('save', SubmitType::class);
            $form = $this->createForm(UploadPhotoFigurineType::class);
        if ($request->isMethod('POST') && $form->handleRequest($request)) {
            $data = $form->getData();
            $files = $data['files'];
            foreach ($files as $file) {
                $photo = new PhotoFigurine();
                $photo->setFile($file)
                    ->setFigurine($figurineArmy);
                $em->persist($photo);
            }
            $em->flush();

            return $this->redirectToRoute('army_view', array('slug' => $figurineArmy->getArmy()->getSlug()));
        }

        return $this->render('AppBundle:PhotoFigurine:add.html.twig', array('form' => $form->createView(), 'figurine' => $figurineArmy));
    }

    // Gestion de suppresion des photos de figurine
    public function deleteAction(Request $request, PhotoFigurine $photoFigurine)
    {
        // On vérifie si le visiteur est le proprio de la figurine
        if($photoFigurine->getFigurine()->getArmy()->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous n\'avez pas les droits suffisants pour ajouter une photo à cette figurine !');
        }
        $em = $this->getDoctrine()->getManager();

        $em->remove($photoFigurine);
        $em->flush();

        $this->addFlash('info', 'Votre photo a bien été supprimée.');

        return $this->redirectToRoute('army_view', array('slug' => $photoFigurine->getFigurine()->getArmy()->getSlug()));

    }
}
