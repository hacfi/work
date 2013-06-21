<?php

namespace hacfi\WorkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render(
            'hacfiWorkBundle:Dashboard:index.html.twig',
            array(
                'name' => 'howdy'
            )
        );
    }
}
