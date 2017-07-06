<?php

/* 
 * EasyReview Reviews Controller
 * @author Zackary Boarman
 * @version 1.0
 */

class App_Controllers_Reviews extends App_Controller{
    
    //No point in going to /reviews
    protected function home(){
        $tmpl = Sys_Template::getTemplate();
        $tmpl->setTitle("Dashboard");
        $tmpl->setContent("Go Back to access reviews");
        $tmpl->display();
    }
    
    
    protected function load_reviews($siteid){
        
        $review_model = new App_Model_Reviews();
        
        //Start Review Toggle
        $review = $review_model->getReview($_GET['review']);
        $data = array(
            'site_ref_id' => $review->site_ref_id
        );
        
        //Only do if they have clicked the button to (Un)Publish
        if (isset($_GET['action']) && isset($_GET['review'])){
            if ($_GET['action'] == "publish"){
                $data['apiaction'] = "publish";
                $review_model->setPublished( (int) $_GET['review'], true);
            }
            
            if ($_GET['action'] == "unpublish"){
                $data['apiaction'] = "unpublish";
                $review_model->setPublished( (int) $_GET['review'], false);
            }
            $this->POST($siteid, $data);
        }
        
        $rows = array();
        
        $reviews = $review_model->getAllReviews( (int) $siteid);
        
        if ($reviews >= 1){
            $rows = $reviews;
        }
        
        $tmpl = Sys_Template::getTemplate();
        $tmpl->setTitle("Dashboard");
        $tmpl->setContent($this->load_view("reviews_list",array('rows'=>$rows)));
        $tmpl->display();
    }
    
    //Override route path since I want the second part to be the site id
    public function route_path(){
        $method = App::$path[1];
        if ($method == ""){
            $method = "home";
        }

        if (is_numeric($method)){
            $this->load_reviews($method);
        }elseif (method_exists($this,$method)){
            $this->$method();
        }
    }
    
    //cURL wrapper, but instead of URL you give it the site id
    public function POST($siteid, $data){
        $db = new Sys_Database("sites");
        $site = $db->getRow((int) $siteid);
        $curl = curl_init($site->apiurl);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($curl);
        curl_close($curl);

    }
    
}
