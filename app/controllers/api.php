<?php

/* 
 * EasyReview AI Controller
 * @author Zackary Boarman
 * @version 1.0
 */

class App_Controllers_API extends App_Controller{
    
    //No point in accessing just /api
    protected function home(){
        echo json_encode(array('status'=>0));
        die();
    }
    
    //This actually creates the review so it'll be seen
    protected function create(){
        $siteid = filter_input(INPUT_GET, "siteid", FILTER_SANITIZE_NUMBER_INT);
        $pdo = (new Sys_Database("sites"))->getPDO();
        $stmt = $pdo->prepare("SELECT * FROM sites WHERE `id` = :siteid ");
        $stmt->execute(['siteid'=> (int) $siteid]);
        $site = $stmt->fetch();
        
        //Only continue if the apikey matches what it should for the site
        if ($_POST['apikey'] == $site->apikey){
            $pdo = (new Sys_Database("reviews"))->getPDO();
            
            //Since the meta data isn't the main focus, let's put it into one field.
            //Makes extending this later a bit easier without a Scema change
            $meta =  str_replace("'", "'", json_encode(array(
                'stars' => filter_input(INPUT_POST, 'stars'),
                'title' => filter_input(INPUT_POST, 'title'),
                'name' => filter_input(INPUT_POST, 'your_name'),
                'email' => filter_input(INPUT_POST, 'your_name'),
                'phone' => filter_input(INPUT_POST, 'your_phone'),
            ), JSON_PRETTY_PRINT));
            
            $review = filter_input(INPUT_POST, 'review');
            $site_ref_id = filter_input(INPUT_POST, 'site_ref_id');
            
            $stmt = $pdo->prepare("INSERT INTO reviews (`site_id`,`site_ref_id`,`viewed`,`created`,`published`,`review`,`review_meta`) "
                    . "VALUES( :siteid, :site_ref_id, 0, now(), 0, :review, :meta ) ");
            $stmt->execute([
                'siteid'=> (int) $siteid,
                'site_ref_id' => (int) $site_ref_id,
                'review' => $review,
                'meta' => $meta
                ]);
        }
        
        //Since it's just a demo, always return 0
        echo json_encode(array('status'=>0));
        error_log(json_encode($_POST));
        die();
    }
}