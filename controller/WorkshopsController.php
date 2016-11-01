<?php

require_once WWW_ROOT . 'controller/Controller.php'; 

class WorkshopsController extends Controller { 

	function __construct() { 
		require_once WWW_ROOT . 'dao/WorkshopDAO.php';
		require_once WWW_ROOT . 'dao/WorkshopSubscriptionsDAO.php';
		require_once WWW_ROOT . 'dao/OrderDAO.php';

		$this->workshopDAO = new WorkshopDAO(); 
		$this->workshopSubscriptionsDAO = new WorkshopSubscriptionsDAO(); 
		$this->orderDAO = new OrderDAO(); 

	}

	public function overview() {
		$workshops = $this->workshopDAO->selectAll(PDO::FETCH_ASSOC); 

		foreach($workshops as &$workshop) {
			$workshop_subscriptions = $this->workshopSubscriptionsDAO->selectByWorkshopId($workshop['id']);
			$workshop['subscriptions'] = $workshop_subscriptions['subscriptions']; 
		}

		$this->set('workshops', $workshops); 
	}

	public function detail() {
		$workshop = $this->workshopDAO->selectById($_GET['id']); 
		$this->set('workshop', $workshop); 

		$workshop_subscriptions = $this->workshopSubscriptionsDAO->selectByWorkshopId($_GET['id']);
		$this->set('workshop_subscriptions', $workshop_subscriptions); 

		if(!empty($_POST['action'])) {
			if($_POST['action'] == 'bevestig mijn deelname') {
				if($_POST['workshop_subscribe'] == 0) {
					$_SESSION['error'] = 'Er ging iets mis bij je inschrijving.';
					$errors['workshop_subscribe'] = 'Vink de checkbox aan om je deelname te bevestigen.';
					$this->set('errors', $errors);
				} else
					$this->_handleSubscription($workshop);
				}
			}
		if(!empty($_SESSION['user'])) {
			$workshop_subscribed = $this->workshopSubscriptionsDAO->selectWorkshopByUser($_SESSION['user']['id'],$_GET['id']);
			$this->set('workshop_subscribed', $workshop_subscribed);
		}
	}

	private function _handleSubscription($workshop) {
		if(empty($_SESSION['user'])) {
			$_SESSION['error'] = 'Enkel geregistreerde gebruikers kunnen inschrijven.';
			$this->redirect('index.php?page=workshop_detail&amp;&id=' . $workshop['id'] . '');
		} else {
			$data = array(
				'user_id' => $_SESSION['user']['id'],
				'workshop_id' => $workshop['id'],
			);

			$ownerPrice = $this ->orderDAO->selectByPackage($_SESSION['user']['id'], $workshop['title']); 
			if(!empty($ownerPrice)) {
				$data['owner_price'] = 1;
			} else {
				$data['owner_price'] = 0;
			}

			$insert = $this->workshopSubscriptionsDAO->insert($data); 
			if(!empty($insert)) {
				$_SESSION['info'] = 'Je bent ingeschreven voor deze workshop.';
				$this->redirect('index.php?page=workshop_detail&amp;&id=' . $workshop['id'] . '');
			} else {
				$_SESSION['error'] = 'Er ging iets mis bij je inschrijving.';
				$errors = $this->workshopSubscriptionsDAO->getValidationErrors($data); 
				$this->set('errors', $errors);
			}
		}	
	}

}
