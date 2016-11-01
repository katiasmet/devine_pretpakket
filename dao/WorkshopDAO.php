<?php
require_once __DIR__ . '/DAO.php';
class WorkshopDAO extends DAO {

	public function selectAll() {
		$sql = "SELECT dhz_workshops.*, dhz_packages.title FROM `dhz_workshops` INNER JOIN `dhz_packages` ON dhz_workshops.package_id = dhz_packages.id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT dhz_workshops.*, dhz_packages.title FROM `dhz_workshops` INNER JOIN `dhz_packages` ON dhz_workshops.package_id = dhz_packages.id WHERE dhz_workshops.id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}