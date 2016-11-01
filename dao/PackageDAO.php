<?php
require_once __DIR__ . '/DAO.php';
class PackageDAO extends DAO {
	
	public function selectAll() {
		$sql = "SELECT * FROM `dhz_packages`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `dhz_packages` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectAllPromo() {
		$sql = "SELECT * FROM `dhz_packages` WHERE `promo` != ''";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectMostViewed() {
		$sql = "SELECT MAX(`views`), `dhz_packages`.* FROM `dhz_packages`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectBySearch($searchString) {
		$sql = "SELECT * FROM `dhz_packages` 
				WHERE `title` LIKE :searchString OR `short_description` LIKE :searchString";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':searchString', '%' . $searchString . '%');
		$stmt->bindValue(':searchString', '%' . $searchString . '%');
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function update($id, $views) {
		$errors = $this->getValidationErrors($views);
		if(empty($errors)) {
			$sql = "UPDATE `dhz_packages` SET `views`= :views  WHERE `id` = :id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':views', $views);
			$stmt->bindValue(':id', $id);
			if($stmt->execute()) {
				return $this->selectById($id);
			}
		}
		return false;
	}
	public function getValidationErrors($views) {
		$errors = array();
		if(empty($views)) {
			$errors['views'] = 'Geef je aantal views op';
		}
		return $errors;
	}
}