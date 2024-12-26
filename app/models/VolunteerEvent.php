<?php

class VolunteerEvent {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllWithCharity() {
        $sql = "
            SELECT 
                ve.event_name,
                ve.event_date,
                ve.event_location,
                ve.description,
                ve.current_volunteers,
                ve.volunteer_goal,
                ve.created_at,
                c.charity_name
            FROM 
                volunteerevent ve
            LEFT JOIN 
                charity c ON ve.charity_id = c.charity_id
            ORDER BY 
                ve.created_at DESC
        ";

        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUpcomingEvents($limit = 3) {
        $sql = "
            SELECT 
                ve.event_id,
                ve.event_name,
                ve.event_date,
                ve.event_location,
                ve.description,
                ve.current_volunteers,
                ve.volunteer_goal,
                ve.created_at,
                c.charity_name
            FROM 
                volunteerevent ve
            LEFT JOIN 
                charity c ON ve.charity_id = c.charity_id
            WHERE 
                ve.event_date >= CURDATE()
            ORDER BY 
                ve.event_date ASC
            LIMIT :limit
        ";

        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalVolunteerEvents() {
        $sql = "SELECT COUNT(*) as total FROM volunteerevent";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
?>
