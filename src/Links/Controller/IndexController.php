<?php

namespace App\Links\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    //Used by default by the view, display data content
    public function listAction(Request $request, Application $app)
    {
        $links = $app['repository.link']->getAll();
        return $app['twig']->render('links.list.html.twig', array('links' => $links));
    }
    //Delete link
    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.link']->delete($parameters['id']);

        return $app->redirect($app['url_generator']->generate('link.list'));
    }
    //Edit link
    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $link = $app['repository.link']->getById($parameters['id']);

        return $app['twig']->render('links.form.html.twig', array('link' => $link));
    }
    //Save into DB my link
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
