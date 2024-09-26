<?php 
    require('../model/service-info-model.php');

    if(isset($_GET['service'])){

        $serviceManagement = new ServiceManagement();
        $result = $serviceManagement -> searchService($_GET['service']);
        
        echo json_encode($result);
    }

?>