<?php
require_once __DIR__ . '/DAO.php';
class ReviewDAO extends DAO {

	public function selectAll() {
		$sql = "SELECT * FROM `dhz_reviews`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `dhz_reviews` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectLast() {
		$sql = "SELECT dhz_reviews.*, dhz_users.first_name, dhz_users.last_name, dhz_packages.title FROM `dhz_reviews` 
				INNER JOIN `dhz_users` ON dhz_reviews.user_id = dhz_users.id 
				INNER JOIN `dhz_packages` ON dhz_reviews.package_id = dhz_packages.id 
				ORDER BY `creation_date` DESC LIMIT 3";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectByUser($id) {
		$sql = "SELECT dhz_reviews.*, dhz_packages.title FROM `dhz_reviews` 
				INNER JOIN `dhz_users` ON dhz_reviews.user_id = dhz_users.id 
				INNER JOIN `dhz_packages` ON dhz_reviews.package_id = dhz_packages.id 
				WHERE dhz_reviews.user_id = :id ORDER BY `creation_date` DESC";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectAllVisibleMap() {
		$sql = "SELECT dhz_users.*, dhz_reviews.*, dhz_packages.title FROM `dhz_users` 
				INNER JOIN `dhz_reviews` ON dhz_users.id = dhz_reviews.user_id 
				INNER JOIN `dhz_packages` ON dhz_reviews.package_id = dhz_packages.id WHERE dhz_users.visible_map = 1";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);	
	}

	public function selectEmptyByUser($user_id) {
		$sql = "SELECT `dhz_order_items`.*, `dhz_packages`.title FROM `dhz_order_items` 
				INNER JOIN `dhz_orders` ON `dhz_order_items`.order_id = `dhz_orders`.id 
				INNER JOIN `dhz_packages` ON dhz_order_items.package_id = dhz_packages.id 
				WHERE dhz_orders.user_id = :user_id AND dhz_order_items.package_id 
				NOT IN (SELECT package_id FROM dhz_reviews WHERE user_id = :user_id)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `dhz_reviews`(`user_id`, `package_id`, `creation_date`, `review`) 
					VALUES (:user_id,:package_id,:creation_date,:review)";
			$stmt = $this->pdo->prepare($sql); 
			$stmt->bindValue(':user_id', $data['user_id']);
			$stmt->bindValue(':package_id', $data['package_id']);
			$stmt->bindValue(':creation_date', $data['creation_date']);
			$stmt->bindValue(':review', $data['review']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId(); 
				return $this->selectById($insertedId);
			}
		}
		return false; 
	}

	public function delete($id) {
		$sql = "DELETE FROM `dhz_reviews` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		return $stmt->execute();
	}

	public function getValidationErrors($data) {
		$errors = array();
		if(!isset($data['user_id'])) {
			$errors['user_id'] = "Geef je gebruikersid op.";
		}
		if(!isset($data['package_id'])) {
			$errors['package_id'] = "Geef je packageid op.";
		}
		if(!isset($data['creation_date'])) {
			$errors['creation_date'] = "Geef de aanmaakdatum op.";
		}
		if(empty($data['review'])) {
			$errors['review'] = "Schrijf je ervaring in max. 150 tekens.";
		}
		return $errors;
	}


}