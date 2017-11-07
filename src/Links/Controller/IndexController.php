<?php

namespace App\Links\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function listAction(Request $request, Application $app)
    {
        $links = $app['repository.link']->getAll();
        return $app['twig']->render('links.list.html.twig', array('links' => $links));
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.link']->delete($parameters['id']);

        return $app->redirect($app['url_generator']->generate('link.list'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $link = $app['repository.link']->getById($parameters['id']);

        return $app['twig']->render('links.form.html.twig', array('link' => $link));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $link = $app['repository.link']->update($parameters);
        } else {
            $link = $app['repository.link']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('links.list'));
    }

    public function newAction(Request $request, Application $app)
    {
        return $app['twig']->render('links.form.html.twig');
    }


}
