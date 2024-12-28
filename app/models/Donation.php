<?php

class Donation
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDonations()
    {
        $sql = "
            SELECT 
                d.donation_id,
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

    public function getLatestDonations($limit = 3)
    {
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

    public function getTotalDonations()
    {
        $sql = "SELECT COUNT(*) as total FROM donation";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getDonationByTitle($title)
    {
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
            WHERE 
                d.title = :title
        ";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateDonation($eventId, $eventName, $charityId, $description, $fundingGoal)
    {
        $sql = "
        UPDATE 
            donation 
        SET 
            title = :title, 
            charity_id = :charity_id,
            description = :description,
            funding_goal = :funding_goal
        WHERE
            donation_id = :donation_id
        ";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':title', $eventName, PDO::PARAM_STR);
        $stmt->bindParam(':charity_id', $charityId, PDO::PARAM_INT);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':funding_goal', $fundingGoal, PDO::PARAM_STR);
        $stmt->bindParam(':donation_id', $eventId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function addDonation($eventName, $charityId, $description, $fundingGoal, $imagePath)
    {
        $sql = "
        INSERT INTO 
            donation (title, charity_id, description, funding_goal, image_path) 
        VALUES 
            (:title, :charity_id, :description, :funding_goal, :image_path)
        ";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':title', $eventName, PDO::PARAM_STR);
        $stmt->bindParam(':charity_id', $charityId, PDO::PARAM_INT);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':funding_goal', $fundingGoal, PDO::PARAM_STR);
        $stmt->bindParam(':image_path', $imagePath, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteDonation($eventId)
    {
        $sql = "DELETE FROM donation WHERE donation_id = :donation_id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':donation_id', $eventId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
