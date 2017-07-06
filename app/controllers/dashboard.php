<?php

/* 
 * EasyReview Dashboard Controller
 * @author Zackary Boarman
 * @version 1.0
 */

class App_Controllers_Dashboard extends App_Controller{
    protected function home(){
        $rows = array();
        $sites = (new Sys_Database("sites"))->getAllRows();
        $review_model = new App_Model_Reviews();
        
        if (count($sites) != 0){
            
            //For every site, let's get the number of unviewed and total reviews
            foreach ($sites as $site){
                $reviews_pending = $review_model->getPendingReviewCount($site->id);
                $reviews_total = $review_model->getTotalReviewCount($site->id);
                if ($reviews_pending >= 1 || $reviews_total >= 1){
                    $rows[] = array(
                        'id' => $site->id,
                        'name' => $site->name,
                        'pending_reviews' => $reviews_pending,
                        'total_reviews' => $reviews_total
                    );
                }
            }
        
        }
        
        $tmpl = Sys_Template::getTemplate();
        $tmpl->setTitle("Dashboard");
        $tmpl->setContent($this->load_view("dashboard_home",array('rows'=>$rows)));
        $tmpl->display();
    }
}