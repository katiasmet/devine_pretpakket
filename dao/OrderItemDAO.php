<?php
require_once __DIR__ . '/DAO.php';
class OrderItemDAO extends DAO {
	
	public function selectById($id) {
		$sql = "SELECT * FROM `dhz_orders` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `dhz_order_items`(`order_id`, `package_id`, `amount`) 
					VALUES (:order_id,:package_id,:amount)";
			$stmt = $this->pdo->prepare($sql); 
			$stmt->bindValue(':order_id', $data['order_id']);
			$stmt->bindValue(':package_id', $data['package_id']);
			$stmt->bindValue(':amount', $data['amount']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId(); 
				return $this->selectById($insertedId);
			}
		}
		return false; 
	}

	public function getValidationErrors($data) {
		$errors = array();
		if(!isset($data['order_id'])) {
			$errors['order_id'] = "Geef je order id op.";
		}
		if(!isset($data['package_id'])) {
			$errors['package_id'] = "Geef een package id op.";
		}
		if(!isset($data['amount'])) {
			$errors['amount'] = "Geef een hoeveelheid op.";
		}
		return $errors;
	}

}