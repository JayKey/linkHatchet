<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Link;

class AppController extends AbstractController
{
    /**
     * @Route("/{code}", name="app")
     */
    public function index($code)
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

        return $this->redirect('http://'.$longLink->getLongLink());
    }
}
