<?php
require_once __DIR__ . '/DAO.php';
class OrderDAO extends DAO {
	
	public function selectById($id) {
		$sql = "SELECT * FROM `dhz_orders` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByUserId($id) {
		$sql = "SELECT dhz_orders.*, dhz_order_items.*, dhz_packages.title, dhz_packages.price, dhz_packages.id AS 'ordered_package_id' FROM `dhz_orders` 
				INNER JOIN `dhz_order_items` ON dhz_orders.id = dhz_order_items.order_id 
				INNER JOIN `dhz_packages` ON dhz_order_items.package_id = dhz_packages.id 
				WHERE dhz_orders.user_id = :id ORDER BY `creation_date` DESC";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectByPackage($user_id,$package_title) {
		$sql = "SELECT dhz_orders.user_id, dhz_order_items.package_id, dhz_packages.title FROM `dhz_orders` 
				INNER JOIN `dhz_order_items` ON dhz_orders.id = dhz_order_items.order_id 
				INNER JOIN `dhz_packages` ON dhz_order_items.package_id = dhz_packages.id 
				WHERE dhz_orders.user_id = :user_id AND dhz_packages.title = :package_title";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':package_title', $package_title);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `dhz_orders`(`user_id`, `creation_date`) 
					VALUES (:user_id,:creation_date)";
			$stmt = $this->pdo->prepare($sql); 
			$stmt->bindValue(':user_id', $data['user_id']);
			$stmt->bindValue(':creation_date', $data['creation_date']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId(); 
				return $this->selectById($insertedId);
			}
		}
		return false; 
	}

	public function getValidationErrors($data) {
		$errors = array();
		if(!isset($data['user_id'])) {
			$errors['user_id'] = "Geef je gebruikersid op.";
		}
		if(!isset($data['creation_date'])) {
			$errors['creation_date'] = "Geef een datum op.";
		}
		return $errors;
	}

}