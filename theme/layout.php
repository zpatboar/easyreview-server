<?php

/* 
 * Crappy HTML Template for Demo
 */

?>
<html>
    <head>
        <title>EasyReview - <?php echo $this->getTitle();?></title>
        <style>
            body{
                background: #D9D9D9;
            }
            
            #wrap{
                max-width: 1200px;
                margin-left: auto;
                margin-right: auto;
                background: #FFF;
                border-radius: 10px;
                padding: 10px;
            }
            
            .body table{
                border: 1px solid #333;
            }
            
            .dashboard{
                width: 600px;
            }
            
            .dashboard tbody tr:even{
                background-color: #cccccc;
            }
            
            .review-content{
                background: #F0F0F0;
                padding: 10px;
            }
            
            .btn{
                color: black;
                text-decoration: none;
                background: #F0F0F0;
                border-radius: 5px;
                padding: 8px;
                line-height: 26px;
            }
        </style>
    </head>
    <body>
        <div id="wrap">
            <div class="header"></div>
            <div class="body">
                <?php echo $this->getContent(); ?>
            </div>
            <div class="footer"></div>
        </div>
    </body>
</html>