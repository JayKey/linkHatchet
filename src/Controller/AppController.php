<?php

namespace App\Controller;

use phpbrowscap\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Link;
use App\Entity\MetaAccess;

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
        $link = $em->getRepository(Link::class)->findOneBy(array(
            'shortLink' => $code
        ));

        if(!$link) {
            return $this->render('app/index.html.twig', [
                'controller_name' => 'AppController',
            ]);
        }

        $now = new \DateTime();

        $metaAccess = new MetaAccess();
        $metaAccess->setLink($link);
        $metaAccess->setDateTime($now);
        $metaAccess->setIp($_SERVER['REMOTE_ADDR']);

        $em->persist($metaAccess);
        $em->flush();

        return $this->redirect($link->getLongLink());
    }
}
