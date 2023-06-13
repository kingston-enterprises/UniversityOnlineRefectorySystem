<?php

namespace kingstonenterprises\app\controllers;
use kingston\icarus\Application;
use kingston\icarus\Controller;
use kingston\icarus\Request;
use kingstonenterprises\app\models\User;
use kingstonenterprises\app\models\Permission;

class AuthController extends Controller
{
    public function login(Request $request) : string
    {
        $userModel = new User();
        $permissionModel = new Permission();

        
        if ($request->getMethod() === 'post') {
            $userModel->loadData($request->getBody());
            if ($userModel->loginValid()) {
                
            	$user = $userModel->findOne(['email' => $request->getBody()['email']]); 
            	$permission = $permissionModel->findOne(['user_id' => $user->id]); 
            	Application::$app->session->set('user', $user->id);
            	Application::$app->session->set('role', $permission->role_id);
                Application::$app->session->setFlash('success', 'Welcome ' . $user->getDisplayName());
                Application::$app->response->redirect('/dashboard');

            }
        }
        
        return $this->render('auth/login', [
        	'title' => 'Login',
            'model' => $userModel
        ]);
        
    }

    public function register(Request $request) : string
    {
    	
        $registerModel = new User();
        $permissionModel = new Permission();

        if ($request->getMethod() === 'post') {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->save()) {
                $user = $registerModel->findOne(['email' => $registerModel->email]);

                // Default permissions for normal user
                $permissionModel->user_id = $user->id;
                $permissionModel->role_id = 2;
                $permissionModel->save();

                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/auth/login');
                return 'Show success page';
            }

        }
        
        return $this->render('auth/register', [
        	'title' => 'Register',
            'model' => $registerModel
        ]);
    }

    public function logout() : void
    {
        Application::$app->session->remove('user');
        Application::$app->response->redirect('/');
        
    }
	
}
