<?php
include '../connecting/connect.php';

$output = '';

if (isset($_POST['query'])){
    $search = $_POST['query'];

    $query = $connection->prepare('SELECT * FROM categories WHERE categories.name LIKE ?');
    $query->bindValue(1, "$search%", PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
}else{
    $query = $connection->prepare("SELECT * FROM `categories` ORDER BY id DESC");
}
if ($query->rowCount() > 0){

    $output = " <thead>
                    <tr>
                        <th scope=\"col\">Id</th>
                        <th scope=\"col\">Name</th>                      
                        <th scope=\"col\">Create date</th>
                        <th scope=\"col\">Update date</th>
                        <th scope=\"col\"></th>
                        <th scope=\"col\"></th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($result as $x){
        $id =  $x["id"];
        $name = $x["name"];

        $output .='
            <tr>
                <th scope="row">'.$x['id'].'</th>
                <td>'.$x['name'].'</td>              
                <td>'.$x['create_date'].'</td>
                <td>'.$x['update_date'].'</td>
                <td class="delete" id="delete"><a class="deleteF" data-id='.$id.'>✘</a></td>
                <td class="update"><a href="updatefield.php?id='.$id.'&name='.$name.'">↻</a></td>
            </tr>';
    }
    $output .= "</tbody>";
}else{
    echo '<h4 style="padding: 10px; text-align: center">There is nothing to show</h4>';
}
echo $output;
