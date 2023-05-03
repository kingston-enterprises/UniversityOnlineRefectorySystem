<?php

/** 
 * controls the sites functions that do not require special access or permissions
 *
 * @category controllers
 * @author kingston-5 <qhawe@kingston-enterprises.net>
 * @license For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
