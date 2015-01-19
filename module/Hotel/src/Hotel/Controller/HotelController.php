<?php

namespace Hotel\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Hotel\Model\Hotel;
use Hotel\Model\Proprietaire;
use Hotel\Form\HotelForm;
use Application\Module;
use Zend\Json\Json;

class HotelController extends AbstractActionController {

    protected $hotelTable;
    protected $proprietaireTable;

    public function indexjsonAction() {
        $json = Json::encode($this->getHotelTable()->fetchAll());

        return new ViewModel(array(
            'hotels' => $json,
        ));
        //exit(0);
    }

    public function indexAction() {
        //L'utilisateur est admin ou non ?
        if (Module::$utilisateur->administrateur) {
            //Admin
            //On récupère les noms des propriétaires
            $hotels = $this->getHotelTable()->fetchAll();
            foreach ($hotels as $hotel) {
                $listeProprietaire[$hotel->idAdministrateur] = $this->getProprietaireTable()->getProprietaire($hotel->idAdministrateur)->nom;
            }
            return new ViewModel(array(
                'hotels' => $this->getHotelTable()->fetchAll(),
                'listeProprietaire' => $listeProprietaire,
            ));
        } else {
            //Non admin
            //On récupère le nom du propriétaire
            $listeProprietaire[Module::$utilisateur->id] = Module::$utilisateur->nom;
            return new ViewModel(array(
                'hotels' => $this->getHotelTable()->getListeHotel(Module::$utilisateur->id),
                'listeProprietaire' => $listeProprietaire,
            ));
        }
    }

    // Add content to this method:
    public function addAction() {
        $form = new HotelForm();
        //On pré-rempli le champ idAdminsitrateur
        $form->get('idAdministrateur')->setValue(Module::$utilisateur->id);
        if (!Module::$utilisateur->administrateur) {
            //Si ce n'est pas un admin, alors il ne peut pas changer le champ idAdministrateur
            $form->get('idAdministrateur')->setAttribute('readonly', 'readonly');
        }
        $form->get('submit')->setValue('Ajouter');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $hotel = new Hotel();
            $form->setInputFilter($hotel->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $hotel->exchangeArray($form->getData());
                //On vérifie que l'identifiant du propriétaire existe bien déjà
                $existe = false;
                $listeProprietaire = $this->getProprietaireTable()->fetchAll();
                foreach ($listeProprietaire as $proprietaire) {
                    if ($proprietaire->id == $hotel->idAdministrateur) {
                        $existe = true;
                    }
                }
                if ($existe) {
                    $this->getHotelTable()->saveHotel($hotel);

                    // Redirect to list of hotels
                    return $this->redirect()->toRoute('hotel');
                } else {
                    //Le propriétaire n'existe pas
                    $form = new HotelForm();
                    //On pré-rempli le champ idAdminsitrateur
                    $form->get('idAdministrateur')->setValue(Module::$utilisateur->id);
                    return array('form' => $form, 'message' => 'Erreur : Le propriétaire n\'existe pas.');
                }
                return array('form' => $form);
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $idHotel = (int) $this->params()->fromRoute('idHotel', 0);
        if (!$idHotel) {
            return $this->redirect()->toRoute('hotel', array(
                        'action' => 'add'
            ));
        }

        // Get the Hotel with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $hotel = $this->getHotelTable()->getHotel($idHotel);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('hotel', array(
                        'action' => 'index'
            ));
        }

        $form = new HotelForm();
        $form->bind($hotel);
        if (!Module::$utilisateur->administrateur) {
            //Si ce n'est pas un admin, alors il ne peut pas changer le champ idAdministrateur
            $form->get('idAdministrateur')->setAttribute('readonly', 'readonly');
        }
        $form->get('submit')->setAttribute('value', 'Modifier');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($hotel->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                //On vérifie que l'identifiant du propriétaire existe bien déjà
                $existe = false;
                $listeProprietaire = $this->getProprietaireTable()->fetchAll();
                foreach ($listeProprietaire as $proprietaire) {
                    if ($proprietaire->id == $hotel->idAdministrateur) {
                        $existe = true;
                    }
                }
                if ($existe) {
                    $this->getHotelTable()->saveHotel($hotel);

                    // Redirect to list of hotels
                    return $this->redirect()->toRoute('hotel');
                } else {
                    //Le propriétaire n'existe pas
                    return array('idHotel' => $idHotel, 'form' => $form, 'message' => 'Erreur : Le propriétaire n\'existe pas.');
                }
            }
        }

        return array(
            'idHotel' => $idHotel,
            'form' => $form,
        );
    }

    public function deleteAction() {
        $idHotel = (int) $this->params()->fromRoute('idHotel', 0);
        if (!$idHotel) {
            return $this->redirect()->toRoute('hotel');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $idHotel = (int) $request->getPost('idHotel');
                $this->getHotelTable()->deleteHotel($idHotel);
            }

            // Redirect to list of hotels
            return $this->redirect()->toRoute('hotel');
        }

        return array(
            'idHotel' => $idHotel,
            'hotel' => $this->getHotelTable()->getHotel($idHotel),
            'proprietaire' => $this->getProprietaireTable()->getProprietaire($this->getHotelTable()->getHotel($idHotel)->idAdministrateur)->nom,
        );
    }

    public function getHotelTable() {
        if (!$this->hotelTable) {
            $sm = $this->getServiceLocator();
            $this->hotelTable = $sm->get('Hotel\Model\HotelTable');
        }
        return $this->hotelTable;
    }

    public function getProprietaireTable() {
        if (!$this->proprietaireTable) {
            $sm = $this->getServiceLocator();
            $this->proprietaireTable = $sm->get('Hotel\Model\ProprietaireTable');
        }
        return $this->proprietaireTable;
    }

}
