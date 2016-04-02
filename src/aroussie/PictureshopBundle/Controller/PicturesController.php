<?php
/**
 * Created by PhpStorm.
 * User: Roussiere
 * Date: 27/11/2015
 * Time: 23:44
 */

namespace aroussie\PictureshopBundle\Controller;

use aroussie\PictureshopBundle\Entity\Picture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PicturesController extends Controller
{
    public function viewAction($id)
    {
        //see if the user is logged in
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        //I get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We search the picture thanks the ID
        $picture=$rep->find($id);

        //If the picture doesn't exist we throw an exception with a message
        if(null === $picture){
            throw new NotFoundHttpException("There is no picture with the id " .$id);
        }

        //we send the picture to the view
        return $this->render('aroussiePictureshopBundle:Pictures:view.html.twig', array('picture' => $picture));
    }

    public function addAction(Request $request)
    {

        $picture = new Picture();

        //We create the form
        $form = $this->createFormBuilder($picture)
            ->add('name')
            ->add('file','file')
            ->add('upload', 'submit')
            ->getForm();


        //We take back the value put by the user
        $form->handleRequest($request);

        //if the form is valid we persist the picture
        if($form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($picture);
            $em->flush();
            //We redirect the user to the view page with the image he just uploaded
            return $this->redirect($this->generateUrl('aroussie_pictureshop_view',array('id' => $picture->getId())));

        }

        //The first time we go on the add page we show the form page
        return $this->render('aroussiePictureshopBundle:Pictures:add.html.twig',array('form' => $form->createView()));

    }


    public function deleteAction($id,Request $request){

        //First we get the entity Manager
        $em=$this->getDoctrine()->getManager();

        //Then we find the picture thanks to its id
        $picture = $em->getRepository('aroussiePictureshopBundle:Picture')
            ->find($id);

        //If the picture doesn't exist we throw an exception with a message
        if(null === $picture){
            throw new NotFoundHttpException("There is no picture with the id " .$id);
        }

        //If we came from a POST we delete the picture
        if($request->isMethod('POST')){
            $request->getSession()->getFlashBag()->add('info', 'Picture deleted.');
            $em->remove($picture);
            $em->flush();
            return $this->redirect($this->generateUrl('aroussie_pictureshop_home'));
        }

        //If not, we send the view to delete and ask the confirmation
        return $this->render('aroussiePictureshopBundle:Pictures:delete.html.twig',array('picture' => $picture));
    }

    public function indexAction()
    {

        //We get all the pictures from the Database
        $listPictures = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture')
            ->findAll();

        //We return the view of the index page and we send the list of all the pictures
        return $this->render('aroussiePictureshopBundle:Pictures:index.html.twig', array('listPictures' => $listPictures));
    }
}