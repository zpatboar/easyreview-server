<h2>Dashboard</h2>

<table class="dashboard">
    <thead>
        <tr>
            <th>Site Name</th>
            <th>New Reviews</th>
            <th>Total Reviews</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            if (isset($data['rows']) && count($data['rows']) != 0){
                foreach($data['rows'] as $row){
                    echo "<tr>"
                    . "<td><a href=\"reviews\\".$row['id']."\" style=\"color: black; text-decoration: none;\">{$row['name']}</a></td>"
                    . "<td style='text-align: center;'>{$row['pending_reviews']}</td>"
                    . "<td style='text-align: center;'>{$row['total_reviews']}</td>"
                    . "</tr>";
                }
            }else{
                echo '<tr><td colspan="2">No Reviews</td><tr>';
            }            
        ?>
    </tbody>
</table>

