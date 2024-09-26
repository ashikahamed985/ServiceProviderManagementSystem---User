<?php

require_once('database.php');

class ServiceManagement {
    private $con;

    public function __construct() {
        $this->con = dbConnection();
    }

    public function getAllForYourHomeServices() {
        $sql = "SELECT * FROM ServiceInfo WHERE Category = 'For Your Home'";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }

    public function getAllTrendingServices() {
        $sql = "SELECT * FROM ServiceInfo WHERE Category = 'Trending'";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }

    public function getAllrecommendedServices() {
        $sql = "SELECT * FROM ServiceInfo WHERE Category = 'Recommended'";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }

    public function getServiceByID($id) {
        $sql = "SELECT * FROM ServiceInfo WHERE ServiceID = '{$id}'";
        $result = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function searchService($service) {
        $sql = "SELECT * FROM ServiceInfo WHERE ServiceName LIKE '%{$service}%'";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function __destruct() {
        mysqli_close($this->con);
    }
}

?>
