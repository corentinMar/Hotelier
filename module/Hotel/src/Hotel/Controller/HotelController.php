<?php

namespace Hotel\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Hotel\Model\Hotel;
use Hotel\Form\HotelForm;

class HotelController extends AbstractActionController {

    protected $hotelTable;

    public function indexAction() {
        return new ViewModel(array(
            'hotels' => $this->getHotelTable()->fetchAll(),
        ));
    }

    // Add content to this method:
    public function addAction() {
        $form = new HotelForm();
        $form->get('submit')->setValue('Ajouter');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $hotel = new Hotel();
            $form->setInputFilter($hotel->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $hotel->exchangeArray($form->getData());
                $this->getHotelTable()->saveHotel($hotel);

                // Redirect to list of hotels
                return $this->redirect()->toRoute('hotel');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
     {
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
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('hotel', array(
                 'action' => 'index'
             ));
         }

         $form = new HotelForm();
         $form->bind($hotel);
         $form->get('submit')->setAttribute('value', 'Modifier');
        
         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($hotel->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getHotelTable()->saveHotel($hotel);

                 // Redirect to list of hotels
                 return $this->redirect()->toRoute('hotel');
             }
         }

         return array(
             'idHotel' => $idHotel,
             'form' => $form,
         );
     }

     public function deleteAction()
     {
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
             'hotel' => $this->getHotelTable()->getHotel($idHotel)
         );
     }

    public function getHotelTable() {
        if (!$this->hotelTable) {
            $sm = $this->getServiceLocator();
            $this->hotelTable = $sm->get('Hotel\Model\HotelTable');
        }
        return $this->hotelTable;
    }

}
