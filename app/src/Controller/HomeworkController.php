<?php
/**
 * Created by PhpStorm.
 * User: sergii
 * Date: 19.02.18
 * Time: 9:10
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeworkController extends Controller
{
    public function welcome()
    {
        return new Response('Welcome to Symfony');
    }

    public function showTemplate($name)
    {
        return $this->render('hello.html.twig', ['name' => $name]);
    }

    /**
     * @Route("/age/{number}", name="age_array", defaults={"number" : 33}, requirements={"number" : "\d+"})
     */
    public function ageArray($number)
    {
        return new JsonResponse(['age' => $number]);
    }

    /**
     * @Route("/user/{name}", name="user_name", defaults={"name" : "username"})
     */
    public function userName($name, SessionInterface $session)
    {
        $session->set('username', $name);
        return $this->forward('App\Controller\HomeworkController::forwardMethod');
    }

    /**
     * @Route("/get_session", name="get_session")
     */
    public function forwardMethod(SessionInterface $session)
    {
        $username = $session->get('username') ?? 'undefined';
        return $this->render('session.html.twig', ['sessionData' => $username]);
    }

    public function googleSearch($query)
    {
        return $this->redirect("https://www.google.com/search?q=$query");
    }

    public function yahooSearch($query)
    {
        return $this->redirect("https://search.yahoo.com/search?p=$query");
    }

    /**
     * @Route("/post/page/{number}", methods={"GET"}, requirements={"number" : "^[1-9]|[1-9]\d$"})
     */
    public function pageNumber($number)
    {
        return $this->render('page.html.twig', ['number' => $number]);
    }
}
