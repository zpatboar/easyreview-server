<?php

/* 
 * EasyReview Reviews Modal
 * @author Zackary Boarman
 * @version 1.0
 */

class App_Model_Reviews{
    
    //Pending Reviews are those never seen
    public function getPendingReviewCount($siteid){
        $pdo = (new Sys_Database("reviews"))->getPDO();
        $stmt = $pdo->prepare("SELECT count(*) FROM reviews WHERE `site_id` = :siteid AND `viewed` = 0 ");
        $stmt->execute(['siteid'=> (int) $siteid]);
        return $stmt->fetchColumn();
    }
    
    public function getTotalReviewCount($siteid){
        $pdo = (new Sys_Database("reviews"))->getPDO();
        $stmt = $pdo->prepare("SELECT count(*) FROM reviews WHERE `site_id` = :siteid ");
        $stmt->execute(['siteid'=> (int) $siteid]);
        return $stmt->fetchColumn();
    }
    
    public function getAllReviews($siteid){
        $pdo = (new Sys_Database("reviews"))->getPDO();
        
        //Once a review has been seen, mark it as viewed
        $stmt = $pdo->prepare("UPDATE reviews SET `viewed` = 1 WHERE `site_id` = :siteid AND `viewed` = 0 ");
        $stmt->execute(['siteid'=> (int) $siteid]);
        
        $stmt = $pdo->prepare("SELECT * FROM reviews WHERE `site_id` = :siteid ");
        $stmt->execute(['siteid'=> (int) $siteid]);
        $rows = $stmt->fetchAll();
        return $rows; 
    }
    
    public function getReview($reviewid){
        $pdo = new Sys_Database("reviews");        
        return $pdo->getRow((int) $reviewid); 
    }
    
    public function setPublished($reviewid, $published = true){
        $pdo = (new Sys_Database("reviews"))->getPDO();
        
        if ($published == true){
            $published = 1;
        }else{
            $published = 0;
        }
        
        $stmt = $pdo->prepare("UPDATE reviews SET `published` = :published WHERE `id` = :id ");
        $stmt->execute(['id'=> (int) $reviewid, 'published' => (int) $published]);
        return true;
    }
}
