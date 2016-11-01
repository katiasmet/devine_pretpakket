<?php
require_once __DIR__ . '/DAO.php';
class NewsletterSubscriptionsDAO extends DAO {

	public function selectById($id) {
		$sql = "SELECT * FROM `dhz_newsletter_subscriptions` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByEmail($e_mail) {
		$sql = "SELECT * FROM `dhz_newsletter_subscriptions` WHERE `e_mail` = :e_mail";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':e_mail', $e_mail);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($e_mail) {
		$errors = $this->getValidationErrors($e_mail);
		if(empty($errors)) {
			$sql = "INSERT INTO `dhz_newsletter_subscriptions`(`e_mail`) VALUES (:e_mail)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':e_mail', $e_mail);
			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}

	public function getValidationErrors($e_mail) {
		$errors = array();
		if(empty($e_mail)) {
			$errors['e_mail'] = 'Vul een geldig e-mailadres in.';
		}
		return $errors;
	}
}