<?php

namespace hacfi\WorkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class AuthController extends Controller
{

    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        $error = '';
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            /** @Ignore */
            $error = $this->get('translator')->trans($request->attributes->get(SecurityContext::AUTHENTICATION_ERROR)->getMessage());
        } elseif ($session->get(SecurityContext::AUTHENTICATION_ERROR) instanceof BadCredentialsException) {
            /** @Ignore */
            $error = $this->get('translator')->trans($session->get(SecurityContext::AUTHENTICATION_ERROR)->getMessage());
        }

        return $this->render(
            'hacfiWorkBundle:Auth:login.html.twig',
            array(
                'last_email' => $session->get(SecurityContext::LAST_USERNAME),
                'error'      => $error,
            )
        );
    }
}
