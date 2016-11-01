<?php
require_once __DIR__ . '/DAO.php';
class WorkshopSubscriptionsDAO extends DAO {

	public function selectById($id) {
		$sql = "SELECT * FROM `dhz_workshop_subscriptions` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByWorkshopId($id) {
		$sql = "SELECT COUNT(*) AS `subscriptions`, dhz_workshop_subscriptions.workshop_id FROM `dhz_workshop_subscriptions` WHERE `workshop_id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByUserId($id) {
		$sql = "SELECT dhz_workshop_subscriptions.workshop_id, dhz_workshops.* FROM `dhz_workshop_subscriptions` INNER JOIN `dhz_workshops` ON dhz_workshop_subscriptions.workshop_id = dhz_workshops.id WHERE dhz_workshop_subscriptions.user_id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectWorkshopByUser($user_id, $workshop_id) {
		$sql = "SELECT * FROM `dhz_workshop_subscriptions` WHERE `user_id` = :user_id AND `workshop_id` = :workshop_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':workshop_id', $workshop_id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `dhz_workshop_subscriptions`(`user_id`, `workshop_id`, `owner_price`) 
					VALUES (:user_id,:workshop_id,:owner_price)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':user_id', $data['user_id']);
			$stmt->bindValue(':workshop_id', $data['workshop_id']);
			$stmt->bindValue(':owner_price', $data['owner_price']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}

	public function delete($user_id, $workshop_id) {
		$sql = "DELETE FROM `dhz_workshop_subscriptions` WHERE `user_id` = :user_id AND `workshop_id` = :workshop_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':workshop_id', $workshop_id);
		return $stmt->execute();
	}

	public function getValidationErrors($data) {
		$errors = array();
		if(empty($data['user_id'])) {
			$errors['user_id'] = 'Geef je gebruikers-id op.';
		}
		if(empty($data['workshop_id'])) {
			$errors['workshop_id'] = 'Geef de workshop-id op.';
		}
		if(!isset($data['owner_price'])) {
			$errors['owner_price'] = 'Geef aan of je het pakket van deze workshop hebt besteld.';
		}
		return $errors;
	}
}