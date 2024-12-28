<?php

class VolunteerEvent
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllWithCharity()
    {
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
                c.charity_name,
                (
                    SELECT JSON_ARRAYAGG(
                        JSON_OBJECT(
                            'startTime', et.start_time,
                            'endTime', et.end_time
                        )
                    )
                    FROM event_times et
                    WHERE et.event_id = ve.event_id
                ) AS timeSlots
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
    
    public function getUpcomingEvents($limit = 3)
    {
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

    public function getTotalVolunteerEvents()
    {
        $sql = "SELECT COUNT(*) as total FROM volunteerevent";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function updateEvent(
        $eventId,
        $eventName,
        $charityId,
        $description,
        $location,
        $date,
        $volunteerGoal
    ) {
        try {
            // Begin transaction
            $this->db->getConnection()->beginTransaction();

            // Update the main volunteerevent table
            $sqlEvent = "
                UPDATE 
                    volunteerevent 
                SET 
                    event_name = :eventName,
                    charity_id = :charityId,
                    description = :description,
                    event_location = :location,
                    event_date = :date,
                    volunteer_goal = :volunteerGoal
                WHERE 
                    event_id = :eventId
            ";
            $stmtEvent = $this->db->getConnection()->prepare($sqlEvent);
            $stmtEvent->bindParam(':eventName', $eventName, PDO::PARAM_STR);
            $stmtEvent->bindParam(':charityId', $charityId, PDO::PARAM_INT);
            $stmtEvent->bindParam(':description', $description, PDO::PARAM_STR);
            $stmtEvent->bindParam(':location', $location, PDO::PARAM_STR);
            $stmtEvent->bindParam(':date', $date, PDO::PARAM_STR);
            $stmtEvent->bindParam(':volunteerGoal', $volunteerGoal, PDO::PARAM_INT);
            $stmtEvent->bindParam(':eventId', $eventId, PDO::PARAM_INT);
            $stmtEvent->execute();

            // Commit transaction
            $this->db->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->getConnection()->rollBack();
            throw new Exception("Failed to update event: " . $e->getMessage());
        }
    }

    public function deleteEvent($eventId)
    {
        $sql = "DELETE FROM volunteerevent WHERE event_id = :eventId";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function addEvent(
        $eventName, 
        $charityId, 
        $description, 
        $location, 
        $date, 
        $volunteerGoal
    ) {
        try {
            // Begin transaction
            $this->db->getConnection()->beginTransaction();
    
            // Insert into volunteerevent table
            $sqlEvent = "
                INSERT INTO 
                    volunteerevent (event_name, charity_id, description, event_location, event_date, volunteer_goal)
                VALUES 
                    (:eventName, :charityId, :description, :location, :date, :volunteerGoal)
            ";
            $stmtEvent = $this->db->getConnection()->prepare($sqlEvent);
            $stmtEvent->bindParam(':eventName', $eventName, PDO::PARAM_STR);
            $stmtEvent->bindParam(':charityId', $charityId, PDO::PARAM_INT);
            $stmtEvent->bindParam(':description', $description, PDO::PARAM_STR);
            $stmtEvent->bindParam(':location', $location, PDO::PARAM_STR);
            $stmtEvent->bindParam(':date', $date, PDO::PARAM_STR);
            $stmtEvent->bindParam(':volunteerGoal', $volunteerGoal, PDO::PARAM_INT);
            $stmtEvent->execute();
    
            // Commit transaction
            $this->db->getConnection()->commit();
            return $this->db->getConnection()->lastInsertId();
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->getConnection()->rollBack();
            throw new Exception("Failed to add event: " . $e->getMessage());
        }
    }    

    public function addEventTime($eventId, $startTime, $endTime) {
        $sql = "INSERT INTO event_times (event_id, start_time, end_time) VALUES (:eventId, :startTime, :endTime)";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->bindParam(':startTime', $startTime, PDO::PARAM_STR);
        $stmt->bindParam(':endTime', $endTime, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function deleteEventTimes($eventId) {
        $sql = "DELETE FROM event_times WHERE event_id = :eventId";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
    }

}
