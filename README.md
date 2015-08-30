webecho-php-example
===================

A Symfony project present example use of https://github.com/SebastianPozoga/webecho-php

#The most important code

## src/AppBundle/Controller/DefaultController.php
```
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
```
## src/AppBundle/Service/WebechoService.php

```
class WebechoService
{
    private $webecho = null;

    function __construct($host, $token)
    {
        $config = new \Webecho\WebechoConfig([
            'host' => $host,
            'token' => $token
        ]);
        $this->webecho = new \Webecho\Webecho($config);
    }

    function getWebecho()
    {
        return $this->webecho;
    }
}
```

# Install

```
git clone https://github.com/SebastianPozoga/webecho-php-example.git
cd webecho-php-example
composer install
php app/console server:run
```