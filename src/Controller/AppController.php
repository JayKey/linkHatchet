<?php

namespace App\Controller;

use phpbrowscap\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Link;

use phpbrowscap\Browscap;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app")
     */
    public function index()
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'lol',
        ]);
    }

    /**
     * @Route("/{code}", name="link")
     */
    public function link($code)
    {
        $em = $this->getDoctrine()->getManager();
        $longLink = $em->getRepository(Link::class)->findOneBy(array(
            'shortLink' => $code
        ));

        if(!$longLink) {
            return $this->render('app/index.html.twig', [
                'controller_name' => 'AppController',
            ]);
        }

        return $this->redirect($longLink->getLongLink());
    }
}
