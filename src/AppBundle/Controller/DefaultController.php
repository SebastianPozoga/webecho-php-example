<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $msg = null;

        $echoForm = $this->createFormBuilder()
            ->add('action', 'text')
            ->add('message', 'text')
            ->add('save', 'submit', array('label' => 'Send'))
            ->getForm();

        if ($request->isMethod('POST')) {
            $echoForm->handleRequest($request);

            if ($echoForm->isValid()) {
                $data = $echoForm->getData();
                $echo = $this->get('webecho')->getWebecho()->emitEcho();
                $echo->setAction($data['action']);
                $echo->setData([
                    'message' => $data['message']
                ]);
                $echo->send();
                $msg = "Your request is sended";
            }
        }

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'msg' => $msg,
            'echo_form' => $echoForm->createView()
        ));
    }
}
