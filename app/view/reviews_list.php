<h2>Reviews</h2>
<a href="/" style="color: black; text-decoration: none;"><- Back to Dashboard</a>

<table class="dashboard">
    <tbody>
        <?php 
            if (isset($data['rows']) && count($data['rows']) != 0){
                foreach($data['rows'] as $row){
                    $meta = json_decode($row->review_meta);
                    echo '<tr><td><pre>';
                    echo '<strong>'.@$meta->title.'</strong><br />';
                    echo '<div class="review-content">'.$row->review.'</div><br />';
                    //echo "<tr><td>{$row['name']}</td><td style='text-align: center;'>{$row['pending_reviews']}</td></tr>";
                    echo 'Review by: '.$meta->name;
                    echo '</pre>';
                    echo ($row->published == 0 ? '<a class="btn" href="?review='.$row->id.'&amp;action=publish">Publish</a>' : '<a class="btn" href="?review='.$row->id.'&amp;action=unpublish">Unpublish</a>');
                    echo '<hr></td></tr>';
                }
            }else{
                echo '<tr><td colspan="2">No Reviews</td><tr>';
            }            
        ?>
    </tbody>
</table>

