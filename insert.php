<?php 
    if (isset($_POST['isbn']) && isset($_POST['name'])) {
        $isbn = $_POST['isbn'];
        $name = $_POST['name'];
        $author = $_POST['author'];
        $num_pages = $_POST['num_pages'];
        $description = $_POST['description'];
 
        include 'model.php';
 
        $model = new Model();
 
        if ($model->store($isbn, $name, $author, $num_pages, $description)) {
            $data = array('res' => 'success');
        }else{
            $data = array('res' => 'error');
        }
 
        echo json_encode($data);
    }