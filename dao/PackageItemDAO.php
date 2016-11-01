<?php
require_once __DIR__ . '/DAO.php';
class PackageItemDAO extends DAO {

	public function selectByPackageId($id) {
		$sql = "SELECT * FROM `dhz_package_items` WHERE `package_id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}