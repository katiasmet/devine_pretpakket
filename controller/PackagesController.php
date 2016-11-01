<?php

require_once WWW_ROOT . 'controller/Controller.php'; 

class PackagesController extends Controller { 

	function __construct() { 
		require_once WWW_ROOT . 'dao/PackageDAO.php';
		require_once WWW_ROOT . 'dao/PackageItemDAO.php';
		require_once WWW_ROOT . 'dao/ReviewDAO.php';
		require_once WWW_ROOT . 'dao/OrderDAO.php';


		$this->packageDAO = new PackageDAO(); 
		$this->packageItemDAO = new PackageItemDAO(); 
		$this->reviewDAO = new ReviewDAO(); 
		$this->orderDAO = new OrderDAO(); 
	}

	public function index(){
		$packages = $this->packageDAO->selectAllPromo(PDO::FETCH_ASSOC); 
		$this->set('packages', $packages);
	}

	public function overview() {
		$packages = $this->packageDAO->selectAll(PDO::FETCH_ASSOC);
		$mostViewed = $this->packageDAO->selectMostViewed(); 
		$this->set('mostViewed', $mostViewed); 
		$this->set('packages', $packages); 
	}

	public function detail() {
		$package = $this->packageDAO->selectById($_GET['id']); 
		$this->packageDAO->update($_GET['id'], $package['views']+1 ); 
		
		$this->set('package', $package);

		$packageItems = $this->packageItemDAO->selectByPackageId($_GET['id']); 
		$this->set('packageItems', $packageItems); 
	}

	public function neighbourhood() {
		$reviews = $this->reviewDAO->selectLast();
		$this->set('reviews', $reviews); 

		if(!empty($_SESSION['user']['id'])) {
			$orders = $this ->orderDAO->selectByUserId($_SESSION['user']['id']); 
			$this->set('orders', $orders);

			$userReviews = $this->reviewDAO->selectByUser($_SESSION['user']['id']);
			$this->set('userReviews', $userReviews); 
		}
		
		if(!empty($_POST['action'])) {
			if($_POST['action'] = 'voeg mijn ervaring toe') {
				$this->_handleReview();
			}
		}

		if(!empty($_GET['action'])) {
			if($_GET['action'] == 'delete-review') {
				$this->_handleDeleteReview();
			}
		}

		$userMapReviews = $this->reviewDAO->selectAllVisibleMap();
		$this->set('userMapReviews', $userMapReviews); 
	}

	public function search() {
		$searchResults = array();
		if(!empty($_GET['search_term'])) {
			$searchResults = $this->packageDAO->selectBySearch($_GET['search_term']);
			if(empty($searchResults)) {
				$_SESSION['error'] = "Er werden geen pakketten gevonden.";
			} 
		}
		$this->set('searchResults', $searchResults); 
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
			$this->redirect('index.php?page=pretinjouwbuurt');
		} else {
			$_SESSION['error'] = 'Er ging iets mis bij het verwijderen van je ervaring. Probeer opnieuw.';
		}
	}

}
