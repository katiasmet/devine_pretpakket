<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'phpass' . DS . 'Phpass.php';

class OrdersController extends Controller {

	function __construct() {
		require_once WWW_ROOT . 'dao/PackageDAO.php';
		require_once WWW_ROOT . 'dao/OrderDAO.php';
		require_once WWW_ROOT . 'dao/OrderItemDAO.php';
		require_once WWW_ROOT . 'dao/UserDAO.php';

		$this->packageDAO = new PackageDAO(); 
		$this->orderDAO = new OrderDAO(); 
		$this->orderItemDAO = new OrderItemDAO(); 
		$this->userDAO = new UserDAO(); 
	}

	public function cart() {

		if(!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = array();
		}
		if(!empty($_GET['action'])) {
			if($_GET['action'] == 'change') {
				$this->_handleChange();
			}
		}

		$items = array();
		if(!empty($_SESSION['cart'])) {
			foreach($_SESSION['cart'] as $packageId => $amount) {
				if($package = $this->packageDAO->selectById($packageId)) {
					$item = array(
						'package' => $package,
						'amount' => $amount
					);
					$items[] = $item;
				}
			}
		}

		$this->set('items', $items);
	}

	public function add_package() {
		if(!empty($_GET['id'])) {
			if($package = $this->packageDAO->selectById($_GET['id'])) {
				if(!isset($_SESSION['cart'])) {
					$_SESSION['cart'] = array();
				}
				if(isset($_SESSION['cart'][$package['id']])) {
					$_SESSION['cart'][$package['id']]++;
				} else {
					$_SESSION['cart'][$package['id']] = 1;
				}
				$_SESSION['info'] = 'Dit pretpakket is toegevoegd aan jouw winkelwagen.';
				$this->redirect('index.php?page=pakket_detail&id=' . $_GET['id']);
			}
		}
		$this->redirect('index.php');
	}

	public function place_order() {
		if(!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = array();
		}
		if(!empty($_GET['action'])) {
			if($_GET['action'] == 'change') {
				$this->_handleChange();
			}
		}

		$items = array();
		if(!empty($_SESSION['cart'])) {
			foreach($_SESSION['cart'] as $packageId => $amount) {
				if($package = $this->packageDAO->selectById($packageId)) {
					$item = array(
						'package' => $package,
						'amount' => $amount
					);
					$items[] = $item;
				}
				if(!empty($_POST)) {
					if($_POST['action'] == 'plaats bestelling') {
						$this->_handleOrder($items);
					}
				}
			}
		}

		$this->set('items', $items);
	}

	private function _handleOrder($items) {
		$orderData = array();
		$orderData['creation_date'] = date('Y-m-d H:i:s');

		if(empty($_SESSION['user'])) {
			$errors = array();
			if(empty($_POST['e_mail'])) {
				$errors['e_mail'] = 'Geef je e-mailadres op.';
			} else {
				$existing = $this->userDAO->selectByEmail($_POST['e_mail']);
				if(!empty($existing)) {
					$errors['e_mail'] = 'Het e-mailadres is al in gebruik.';
				}
			}
			if(empty($_POST['password'])) {
				$errors['password'] = 'Geef een wachtwoord op.';
			}
			if($_POST['confirm_password'] != $_POST['password']) {
				$errors['confirm_password'] = 'Wachtwoorden komen niet overeen.';
			}

			if(empty($_POST['first_name'])) {
				$errors['first_name'] = 'Vul je voornaam in.';
			}
			if(empty($_POST['last_name'])) {
				$errors['last_name'] = 'Vul je achternaam in.';
			}
			if(empty($_POST['adres'])) {
				$errors['adres'] = 'Vul je straat en huisnummer in.';
			}
			if(empty($_POST['postal_code'])) {
				$errors['postal_code'] = 'Vul je postcode in.';
			}
			if(empty($_POST['city'])) {
				$errors['city'] = 'Vul je gemeente in.';
			}
			
			if(empty($errors)) {
				$hasher = new \Phpass\Hash;
				$data = array(
					'e_mail' => $_POST['e_mail'],
					'password' => $hasher->hashPassword($_POST['password']),
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'adres' => $_POST['adres'],
					'postal_code' => $_POST['postal_code'],
					'city' => $_POST['city']
				);

				if(!empty($_POST['visible_map'])) {
					$data['visible_map'] = $_POST['visible_map'];
				} else {
					$data['visible_map'] = 0;
				}
				if(!empty($_POST['contact_possible'])) {
					$data['contact_possible'] = $_POST['contact_possible'];
				} else {
					$data['contact_possible'] = 0;
				}

				$inserteduser = $this->userDAO->insert($data);
				if(!empty($inserteduser)) {
					$orderData['user_id'] = $inserteduser['id'];
					$_SESSION['user'] = $inserteduser;
					
				} else {
					$errors['registratie'] = 'Er ging iets mis met je registratie.';
				}
			}	
		} else {
			$orderData['user_id'] = $_SESSION['user']['id'];
		}

		$insertOrder = $this->orderDAO->insert($orderData);
		$insertOrderItem = 0;
		foreach($items as $item) {
			$orderItemData = array(
				'order_id' => $insertOrder['id'],
				'package_id' => $item['package']['id'],
				'amount' => $item['amount'] 
			);

			$insertOrderItem = $this->orderItemDAO->insert($orderItemData);
		}

		if(!empty($insertOrder) && !empty($insertOrderItem)) {
			$_SESSION['info'] = 'Bedankt voor jouw bestelling. We bezorgen jouw bestelling zo spoedig mogelijk.';
			unset($_SESSION['cart']);
			$this->redirect('index.php?page=mijnprofiel');
        	
		} else {
			$errors = $this->orderDAO->getValidationErrors($orderData);
			$this->set('errors', $errors);
			print_r($errors);
			$_SESSION['error'] = 'Er ging iets mis met je bestelling. Probeer opnieuw.';
			
		}
	}

	private function _handleChange() {
		if(!empty($_GET['id']) && isset($_GET['amount']) && isset($_SESSION['cart'][$_GET['id']])) {
			$_SESSION['cart'][$_GET['id']] = $_GET['amount'];
			if($_GET['amount'] == 0) {
				unset($_SESSION['cart'][$_GET['id']]);
			}
		}
	}

}