<?php

namespace App\Controller;

use App\Entity\MetaCreate;
use phpbrowscap\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Link;
use App\Entity\MetaAccess;

class AppController extends AbstractController
{
    private function getRndString($l) {
        $charset = '0123456789abcdefghijklmnoprstuvxyz';
        $rndString = '';

        for( $i = 0; $i < $l; $i++ ) {
            $index = rand(0, strlen($charset) - 1);
            $rndString .= $charset[$index];
        }

        return $rndString;
    }

    /**
     * @Route("/", name="app")
     */
    public function index(Request $request)
    {
        $link = new Link();

        $form = $this->createFormBuilder($link)
            ->add('longLink', TextType::class)
            ->add('protocol', HiddenType::class, ['empty_data' => 'http://', 'mapped' => false])
            ->add('submit', SubmitType::class, ['label' => 'Get Short Link!'])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $link = $form->getData();
            $protocol = $form['protocol']->getData();
            $longLink = $form['longLink']->getData();
            $link->setLongLink($protocol.$longLink);
            $link->setShortLink($this->getRndString(6));

            $metaCreate = new MetaCreate();
            $now = new \DateTime();
            $metaCreate->setDateTime($now);
            $metaCreate->setIp($_SERVER['REMOTE_ADDR']);
            $metaCreate->setLink($link);

            $em = $this->getDoctrine()->getManager();
            $em->persist($link);
            $em->persist($metaCreate);
            $em->flush();

            return $this->render('app/shortLink.html.twig', [
                'shortLink' => $link->getShortLink(),
            ]);
        }

        return $this->render('app/index.html.twig', [
            'form' => $form->createView(),
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
