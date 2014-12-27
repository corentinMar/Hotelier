<?php

namespace SanAuth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use SanAuth\Form;

class AuthController extends AbstractActionController {

    protected $form;
    protected $storage;
    protected $authservice;

    public function getAuthService() {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()
                    ->get('AuthService');
        }

        return $this->authservice;
    }

    public function getSessionStorage() {
        if (!$this->storage) {
            $this->storage = $this->getServiceLocator()
                    ->get('SanAuth\Model\MyAuthStorage');
        }

        return $this->storage;
    }

    public function getForm() {
        if (!$this->form) {
            $this->form = new Form\AuthForm();
        }

        return $this->form;
    }

    public function loginAction() {
        //if already login, redirect to success page 
        if ($this->getAuthService()->hasIdentity()) {
            return $this->redirect()->toRoute('success');
        }

        $form = $this->getForm();

        return array(
            'form' => $form,
            'messages' => $this->flashmessenger()->getMessages()
        );
    }

    public function authenticateAction() {
        $form = $this->getForm();
        $redirect = 'login';

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                //check authentication...
                $this->getAuthService()->getAdapter()
                        ->setIdentity($request->getPost('username'))
                        ->setCredential($request->getPost('password'));

                $result = $this->getAuthService()->authenticate();
                foreach ($result->getMessages() as $message) {
                    //save message temporary into flashmessenger
                    $this->flashmessenger()->addMessage($message);
                }

                if ($result->isValid()) {
                    $redirect = 'success';
                    //check if it has rememberMe :
                    if ($request->getPost('rememberme') == 1) {
                        $this->getSessionStorage()
                                ->setRememberMe(1);
                        //set storage again 
                        $this->getAuthService()->setStorage($this->getSessionStorage());
                    }
                    $this->getAuthService()->getStorage()->write($request->getPost('username'));
                }
            } else {
                $this->flashmessenger()->addMessage("Erreur : Nom ou Mot de passe incorrect !");
            }
        }

        return $this->redirect()->toRoute($redirect);
    }

    public function logoutAction() {
        //Si l'utilisateur est déjà connecté
        if ($this->getAuthService()->hasIdentity()) {

            $this->getSessionStorage()->forgetMe();
            $this->getAuthService()->clearIdentity();

            $this->flashmessenger()->addMessage("Vous avez été déconnecté.");
        }
        return $this->redirect()->toRoute('login');
    }
}
