<?php

namespace Utilisateur\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Utilisateur\Model\Utilisateur;
use Utilisateur\Form\UtilisateurForm;

class UtilisateurController extends AbstractActionController {

    protected $utilisateurTable;

    public function indexAction() {
        //return new ViewModel();
    }

    public function addAction() {
        // Creating html form for utilisateur insert
        $form = new UtilisateurForm();

        // Getting a request object
        $request = $this->getRequest();

        // If it is a form submission,
        // then request will be post
        if ($request->isPost()) {

            // Creating a Utilisateur object
            $utilisateur = new Utilisateur();

            // Setting data on form object from request object
            $form->setData($request->getPost());

            if ($form->isValid()) {

                // Setting data on utilisateur object from form object
                $utilisateur->exchangeArray($form->getData());

                //On vérifie que le nom n'existe pas déjà
                $existeDeja = false;
                $listeUtilisateurs = $this->getUtilisateurTable()->fetchAll();
                foreach ($listeUtilisateurs as $user) {
                    if ($utilisateur->nom == $user->nom) {
                        $existeDeja = true;
                    }
                }

                if (!$existeDeja) {

                    // Inserting utilisateur data in the datbase table
                    $this->getUtilisateurTable()->saveUtilisateur($utilisateur);

                    // Redirecting to index page
                    return $this->redirect()->toRoute('home');
                } else {
                    //Le nom exsite déjà
                    $form = new UtilisateurForm();
                    return array('form' => $form, 'message' => 'Erreur : Le nom existe déjà.');
                }
            }
        }

        // If it is form request,
        // then return the form
        return array('form' => $form);
    }

    public function getUtilisateurTable() {
        if (!$this->utilisateurTable) {
            $sm = $this->getServiceLocator();
            $this->utilisateurTable = $sm->get('Utilisateur\Model\UtilisateurTable');
        }
        return $this->utilisateurTable;
    }

}
