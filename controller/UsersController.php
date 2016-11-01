<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'phpass' . DS . 'Phpass.php';

class UsersController extends Controller {

	function __construct() {
		require_once WWW_ROOT . 'dao/UserDAO.php';
		require_once WWW_ROOT . 'dao/OrderDAO.php';
		require_once WWW_ROOT . 'dao/WorkshopSubscriptionsDAO.php';
		require_once WWW_ROOT . 'dao/ReviewDAO.php';
		require_once WWW_ROOT . 'dao/NewsletterSubscriptionsDAO.php';

		$this->userDAO = new UserDAO();
		$this->orderDAO = new OrderDAO();
		$this->workshopSubscriptionsDAO = new WorkshopSubscriptionsDAO(); 
		$this->reviewDAO = new ReviewDAO();
		$this->newsletterSubscriptionsDAO = new NewsletterSubscriptionsDAO();
	}

	public function login() {
		if(!empty($_POST)) {
			if(!empty($_POST['e_mail']) && !empty($_POST['password'])) {
				$existing = $this->userDAO->selectByEmail($_POST['e_mail']);
				if(!empty($existing)) {
					$hasher = new \Phpass\Hash;
					if ($hasher->checkPassword($_POST['password'], $existing['password'])) {
						$_SESSION['user'] = $existing;
					} else {
						$_SESSION['error'] = 'Onbekende gebruikersnaam of wachtwoord.';
					}
				} else {
					$_SESSION['error'] = 'Onbekende gebruikersnaam of wachtwoord.';
				}
			} else {
				$_SESSION['error'] = 'Onbekende gebruikersnaam of wachtwoord.';
			}
		}
		$this->redirect('index.php');
	}

	public function logout() {
		if(!empty($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		$_SESSION['info'] = 'Je bent afgemeld.';
		$this->redirect('index.php');
	}

	public function newsletter() {
		if(!empty($_POST)) {
			if($_POST['action'] == 'subscribe-newsletter') {
				$existing = $this->newsletterSubscriptionsDAO->selectByEmail($_POST['e_mail']);
				if(!empty($existing)) {
					$_SESSION['error'] = 'Je bent al ingeschreven op de nieuwsbrief.';
				} else {
					$this->_handleNewsletterSubscription();
				}
			} 
		}
		$this->redirect('index.php');
	}

	public function register() {
		if(!empty($_POST)) {
			if($_POST['action'] == 'registreer mij') {

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
						$_SESSION['info'] = 'Bedankt voor je registratie!';
						$this->redirect('index.php');
					}
				}

				$_SESSION['error'] = 'Er ging iets mis met je registratie.';
				$this->set('errors', $errors);
			
			} 
		}
	}

	public function edit() {
		if(!empty($_POST)) {
			if($_POST['action'] == 'wijzig mijn gegevens') {

				$errors = array();
				if(empty($_POST['e_mail'])) {
					$errors['e_mail'] = 'Geef je e-mailadres op.';
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

					$inserteduser = $this->userDAO->update($_SESSION['user']['id'],$data);
					if(!empty($inserteduser)) {
						$_SESSION['info'] = 'Jouw gegevens werden gewijzigd.';
						$this->redirect('index.php');
					}
				}

				$_SESSION['error'] = 'We konden je gegevens niet wijzigen.';
				$this->set('errors', $errors);
			
			} 
		}
	}

	public function account() {
		$orders = $this ->orderDAO->selectByUserId($_SESSION['user']['id']); 
		$this->set('orders', $orders);

		if(!empty($_POST['action'])) {
			if($_POST['action'] = 'voeg mijn ervaring toe') {
				$this->_handleReview();
			}
		}

		$workshops = $this->workshopSubscriptionsDAO->selectByUserId($_SESSION['user']['id']); 
		$this->set('workshops', $workshops); 

		$reviews = $this->reviewDAO->selectByUser($_SESSION['user']['id']);
		$this->set('reviews', $reviews);  

		$emptyReviews = $this->reviewDAO->selectEmptyByUser($_SESSION['user']['id']);
		$this->set('emptyReviews', $emptyReviews);

		if(!empty($_GET['action'])) {
			if($_GET['action'] == 'unsubscribe') {
				$this->_handleUnsubsribe();
			}
			if($_GET['action'] == 'delete-review') {
				$this->_handleDeleteReview();
			}
		}
	}

	private function _handleNewsletterSubscription() {
		$insert = $this->newsletterSubscriptionsDAO->insert($_POST['e_mail']); 
		if(!empty($insert)) {
			$_SESSION['info'] = 'Je bent ingeschreven op de nieuwsbrief.';
			$this->redirect('index.php');
		} else {
			$_SESSION['error'] = 'Er ging iets mis bij de inschrijving. Probeer opnieuw.';
			$errors = $this->newsletterSubscriptionsDAO->getValidationErrors($_POST['e_mail']); 
			$this->set('errors', $errors);
		}
	}

	private function _handleUnsubsribe() {
		if($this->workshopSubscriptionsDAO->delete($_SESSION['user']['id'],$_GET['workshop-id'])) {
			$_SESSION['info'] = 'Je bent uitgeschreven voor de workshop.';
			$this->redirect('index.php?page=mijnprofiel');
		} else {
			$_SESSION['error'] = 'Er ging iets mis tijdens het uitschrijven. Probeer opnieuw.';
		}
	}

	private function _handleReview() {
		$data = array(
			'user_id' => $_SESSION['user']['id'],
			'package_id' => $_POST['package_id'],
			'creation_date' => date('Y-m-d H:i:s'),
			'review' => $_POST['review']
		);

		$insert = $this->reviewDAO->insert($data); 
		if(!empty($insert)) {
			$_SESSION['info'] = 'Je ervaring is toegevoegd.';
			$this->redirect('index.php?page=mijnprofiel');
		} else {
			$_SESSION['error'] = 'Er ging iets mis bij het toevoegen van je ervaring.';
			$errors = $this->reviewDAO->getValidationErrors($data); 
			$this->set('errors', $errors);
		}
	}

	private function _handleDeleteReview() {
		if($this->reviewDAO->delete($_GET['review-id'])) {
			$_SESSION['info'] = 'Je ervaring werd verwijderd.';
			$this->redirect('index.php?page=mijnprofiel');
		} else {
			$_SESSION['error'] = 'Er ging iets mis bij het verwijderen van je ervaring. Probeer opnieuw.';
		}
	}

}