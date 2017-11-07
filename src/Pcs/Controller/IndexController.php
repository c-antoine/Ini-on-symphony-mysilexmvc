<?php

namespace App\Pcs\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function listAction(Request $request, Application $app)
    {
        $pcs = $app['repository.pc']->getAll();

        return $app['twig']->render('pcs.list.html.twig', array('pcs' => $pcs));
    }

    public function listByUserIdAction (Request $reqest, Application $app)
    {
        $parameters = $request->attributes->all();
        $pcs = $app['repository.pc']->getPcByUserId($parameters['id']);

        return $app['twig']->render('pcs.newList.html.twig', array('pcs' => $pcs));

    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.pc']->delete($parameters['id']);

        return $app->redirect($app['url_generator']->generate('pcs.list'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $pc = $app['repository.pc']->getById($parameters['id']);

        return $app['twig']->render('pcs.form.html.twig', array('pc' => $pc));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $pc = $app['repository.pc']->update($parameters);
        } else {
            $pc = $app['repository.pc']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('pcs.list'));
    }

    public function newAction(Request $request, Application $app)
    {
        return $app['twig']->render('pcs.form.html.twig');
    }


}
