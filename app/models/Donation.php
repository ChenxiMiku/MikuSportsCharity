<?php

class Donation {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllDonations() {
        $sql = "
            SELECT 
                d.title, 
                d.description, 
                d.funding_goal, 
                d.current_funding, 
                d.image_path,
                c.charity_name 
            FROM 
                donation d
            LEFT JOIN 
                charity c ON d.charity_id = c.charity_id
        ";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatestDonations($limit = 3) {
        $sql = "
            SELECT 
                d.title, 
                d.description, 
                d.funding_goal, 
                d.current_funding, 
                d.image_path,
                c.charity_name 
            FROM 
                donation d
            LEFT JOIN 
                charity c ON d.charity_id = c.charity_id
            ORDER BY
                d.created_at DESC
            LIMIT :limit
        ";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalDonations() {
        $sql = "SELECT COUNT(*) as total FROM donation";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
?>
