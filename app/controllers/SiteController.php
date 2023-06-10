<?php


namespace kingstonenterprises\app\controllers;

use kingston\icarus\Controller;
use kingston\icarus\Application;
use kingston\icarus\Request;

use kingstonenterprises\app\models\User;

/**
 * controls the sites functions that do not require special 
 * access or permissions
 * 
 * @extends \kingston\icarus\Controller
 */
class SiteController extends Controller
{

    /**
     * render Home view
     *
     * @return string
     */
    public function home(Request $request)
    {

        $user = new User();
        
        if ($request->getMethod() === 'post') {
            $user->loadData($request->getBody());
            
            if ($user->loginValid()) {
            	$user = $user->findOne(['email' => $request->getBody()['email']]); 

            	Application::$app->session->set('user', $user->id);
                Application::$app->session->setFlash('success', 'Welcome ' . $user->getDisplayName());
                Application::$app->response->redirect('/dashboard');

            }
        }
        
        return $this->render('home', [
        	'title' => 'Online Refectory System',
            'model' => $user
        ]);
    }
}
