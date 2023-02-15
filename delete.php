<?php 
 
    if (isset($_POST['isbn'])) {
        $isbn = $_POST['isbn'];
 
        include 'model.php';
 
        $model = new Model();
 
        if ($model->destroy($isbn)) {
            $data = array('res' => 'success');
        }else{
            $data = array('res' => 'error');
        }
 
        echo json_encode($data);
    }