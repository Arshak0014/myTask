<?php
include '../connecting/connect.php';

$output = '';

if (isset($_POST['query'])){
    $search = $_POST['query'];

    $query = $connection->prepare('SELECT products.*, models.name AS mod_name, categories.name AS cat_name FROM ((products 
        LEFT JOIN models ON products.models_id = models.id)
        LEFT JOIN categories ON models.categories_id = categories.id)  WHERE products.name LIKE ?');
    $query->bindValue(1, "$search%", PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
}else{
    $query = $connection->prepare("SELECT products.*, models.name AS mod_name, categories.name AS cat_name FROM ((products 
        LEFT JOIN models ON products.models_id = models.id)
        LEFT JOIN categories ON models.categories_id = categories.id)");
}

if ($query->rowCount() > 0){

    $output = " <thead>
                    <tr>
                        <th scope=\"col\">Id</th>
                        <th scope=\"col\">Name</th>
                        <th scope=\"col\">Categories_id</th>
                        <th scope=\"col\">Models_id</th>
                        <th scope=\"col\">Image path</th>
                        <th scope=\"col\">Is new</th>
                        <th scope=\"col\">Price</th>
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
        $category_id = $x["categories_id"];
        $model_id = $x["models_id"];

        if ($x['is_new'] == '1'){
            $isNew = "New";
        }else{
            $isNew = "Old";
        }

        $output .='
            <tr>
                <th scope="row">'.$x['id'].'</th>
                <td>'.$x['name'].'</td>
                <td>'.$x['cat_name'].'</td>
                <td>'.$x['mod_name'].'</td>
                <td>'.$x['image_path'].'</td>
                <td>'.$isNew.'</td>
                <td>'.$x['cat_name'].'</td>
                <td>'.$x['create_date'].'</td>
                <td>'.$x['update_date'].'</td>
                <td class="delete" id="delete"><a class="deleteF" data-id='.$id.'>✘</a></td>
                <td class="update"><a href="updatefieldmodel.php?id='.$id.'&name='.$name.'&category_id='.$category_id.'&model_id='.$model_id.'">↻</a></td>        
            </tr>';
    }
    $output .= "</tbody>";
}else{
    echo '<h4 style="padding: 10px; text-align: center">There is nothing to show</h4>';
}
echo $output;