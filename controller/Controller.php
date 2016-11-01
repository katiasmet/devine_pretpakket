<?php

class Controller {

	public $route;
	protected $viewVars = array();

	public function filter() {
		call_user_func(array($this, $this->route['action']));
	}

	public function render() {

		require_once WWW_ROOT . 'dao/PackageDAO.php';
		$this->packageDAO = new PackageDAO(); 

		$this->setSessionMessages();
		$this->createViewVarWithContent();

		//Cart op elke pagina
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
		
		$this->renderInLayout();
		$this->unsetSessionMessages();

		
	}

	private function _handleChange() {
		if(!empty($_GET['id']) && isset($_GET['amount']) && isset($_SESSION['cart'][$_GET['id']])) {
			$_SESSION['cart'][$_GET['id']] = $_GET['amount'];
			if($_GET['amount'] == 0) {
				unset($_SESSION['cart'][$_GET['id']]);
			}
		}
	}


	public function set($variableName, $value) {
		$this->viewVars[$variableName] = $value;
	}

	private function setSessionMessages() {
		if(!empty($_SESSION['info'])) $this->set('info', $_SESSION['info']);
		if(!empty($_SESSION['error'])) $this->set('error', $_SESSION['error']);
	}

	private function unsetSessionMessages() {
		if(!empty($_SESSION['info'])) unset($_SESSION['info']);
		if(!empty($_SESSION['error'])) unset($_SESSION['error']);
	}

	public function redirect($url) {
		header("Location: {$url}");
		exit();
	}

	private function createViewVarWithContent() {
		extract($this->viewVars, EXTR_OVERWRITE);
		ob_start();
		require WWW_ROOT . 'view' . DS . strtolower($this->route['controller']) . DS . $this->route['action'] . '.php';
		$content = ob_get_clean();
		$this->set('content', $content);
	}

	private function renderInLayout() {
		extract($this->viewVars, EXTR_OVERWRITE);
		include WWW_ROOT . 'view' . DS . 'layout.php';
	}

}