<?php
/**
 * Created by PhpStorm.
 * User: Roussiere
 * Date: 30/11/2015
 * Time: 19:23
 */

namespace aroussie\PictureshopBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FiltersController extends Controller
{

    public function grayscaleAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);

        //We look if the picture has the format jpeg or png because the treatment is not the same

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_GRAYSCALE);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_GRAYSCALE);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }

    }

    public function embossAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_EMBOSS);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_EMBOSS);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }

    }

    public function edgeDetectAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_EDGEDETECT);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_EDGEDETECT);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }

    }


    public function negateAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_NEGATE);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_NEGATE);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }

    }

    public function gravureAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_EDGEDETECT);
            imagefilter($picture_copy, IMG_FILTER_EMBOSS);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_EDGEDETECT);
            imagefilter($picture_copy, IMG_FILTER_EMBOSS);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }

    }

    public function monochromeAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            Imagefilter ($picture_copy, IMG_FILTER_GRAYSCALE);
            imagefilter ( $picture_copy , IMG_FILTER_NEGATE );
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            Imagefilter ($picture_copy, IMG_FILTER_GRAYSCALE);
            imagefilter ( $picture_copy , IMG_FILTER_NEGATE );
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }

    }

    public function rotateAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            $picture_copy = imagerotate($picture_copy, 90, 0);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            $picture_copy = imagerotate($picture_copy, 90, 0);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }

    }



    public function darkAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);
        $value = -100;

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_BRIGHTNESS, $value);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_BRIGHTNESS,$value);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }


    }

    public function lightAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');


        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);
        $value = 100;

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_BRIGHTNESS, $value);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_BRIGHTNESS,$value);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }

    }

    public function contrastAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);
        $value = -100;

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_CONTRAST, $value);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_CONTRAST,$value);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }

    }

    public function orangeAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);

        $r=100;
        $v=0;
        $b=-50;

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_COLORIZE, $r , $v , $b);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_COLORIZE,$r , $v , $b);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }

    }

    public function purpleAction($id){

        //We get the repository
        $rep = $this->getDoctrine()
            ->getManager()
            ->getRepository('aroussiePictureshopBundle:Picture');

        //We find the picture thanks to its id
        $picture_initial = $rep->find($id);

        $r=0;
        $v=-100;
        $b=0;

        if ($picture_initial->getExtension() === 'jpeg') {
            header('Content-type: image/jpeg');
            $picture_copy = imagecreatefromjpeg($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_COLORIZE, $r , $v , $b);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagejpeg($picture_copy) ));


        } else {
            header('Content-type: image/png');
            $picture_copy = imagecreatefrompng($picture_initial->getWebPath());
            imagefilter($picture_copy, IMG_FILTER_COLORIZE,$r , $v , $b);
            return $this->render('aroussiePictureshopBundle:Filters:filterView.html.twig', array('picture' => imagepng($picture_copy) ));

        }

    }

}