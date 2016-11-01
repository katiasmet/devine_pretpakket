<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';
class UserDAO extends DAO {
	
	public function selectAll() {
		$sql = "SELECT * FROM `dhz_users`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `dhz_users` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByEmail($e_mail) {
		$sql = "SELECT * FROM `dhz_users` WHERE `e_mail` = :e_mail";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':e_mail', $e_mail);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `dhz_users`(`first_name`, `last_name`, `adres`, `postal_code`, `city`, `e_mail`, `password`, `visible_map`, `contact_possible`) 
					VALUES (:first_name,:last_name,:adres,:postal_code,:city,:e_mail,:password,:visible_map,:contact_possible)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':first_name', $data['first_name']);
			$stmt->bindValue(':last_name', $data['last_name']);
			$stmt->bindValue(':adres', $data['adres']);
			$stmt->bindValue(':postal_code', $data['postal_code']);
			$stmt->bindValue(':city', $data['city']);
			$stmt->bindValue(':e_mail', $data['e_mail']);
			$stmt->bindValue(':password', $data['password']);
			$stmt->bindValue(':visible_map', $data['visible_map']);
			$stmt->bindValue(':contact_possible', $data['contact_possible']);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}

	public function update($id, $data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "UPDATE `dhz_users` SET `first_name`= :first_name,`last_name`= :last_name ,`adres`= :adres,`postal_code`=:postal_code,
					`city`= :city,`e_mail`= :e_mail,`password`= :password,`visible_map`= :visible_map,`contact_possible`= :contact_possible 
					WHERE `id` = :id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':first_name', $data['first_name']);
			$stmt->bindValue(':last_name', $data['last_name']);
			$stmt->bindValue(':adres', $data['adres']);
			$stmt->bindValue(':postal_code', $data['postal_code']);
			$stmt->bindValue(':city', $data['city']);
			$stmt->bindValue(':e_mail', $data['e_mail']);
			$stmt->bindValue(':password', $data['password']);
			$stmt->bindValue(':visible_map', $data['visible_map']);
			$stmt->bindValue(':contact_possible', $data['contact_possible']);
			$stmt->bindValue(':id', $id);
			if($stmt->execute()) {
				return $this->selectById($id);
			}
		}
		return false;
	}

	public function delete($id) {
		$sql = "DELETE FROM `dhz_users` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		return $stmt->execute();
	}

	public function getValidationErrors($data) {
		$errors = array();
		if(empty($data['first_name'])) {
			$errors['first_name'] = 'Vul je voornaam in.';
		}
		if(empty($data['last_name'])) {
			$errors['last_name'] = 'Vul je achternaam in.';
		}
		if(empty($data['adres'])) {
			$errors['adres'] = 'Vul je straat en huisnummer in.';
		}
		if(empty($data['postal_code'])) {
			$errors['postal_code'] = 'Vul je postcode in.';
		}
		if(empty($data['city'])) {
			$errors['city'] = 'Vul je gemeente in.';
		}
		if(empty($data['city'])) {
			$errors['city'] = 'Vul je gemeente in.';
		}
		if(empty($data['e_mail'])) {
			$errors['e_mail'] = 'Vul je e-mailadres in.';
		}
		if(empty($data['password'])) {
			$errors['password'] = 'Geef een wachtwoord op.';
		}
		if(!isset($data['visible_map'])) {
			$errors['visible_map'] = 'Geef aan of je zichtbaar wilt zijn op de kaart. ';
		}
		if(!isset($data['contact_possible'])) {
			$errors['contact_possible'] = 'Geef aan of je gecontacteerd kunt worden. ';
		}
		return $errors;
	}
}