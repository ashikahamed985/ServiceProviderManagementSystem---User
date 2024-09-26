<?php

    require_once('../model/user-info-model.php');
    require_once('../model/service-info-model.php');
    $id = $_COOKIE['id'];

    $userManagement = new UserManagement();
    $row = $userManagement ->  userInfo($id);

    
?>
<script>

function searchServices() {

    let search = document.getElementById("search").value;
    let table = document.getElementById("service-table");

    for (let i = table.rows.length - 1; i > 0; i--) {
        table.deleteRow(i);
    }

    if(search === "" || search.trim() === '') return;

    let xhttp = new XMLHttpRequest();
    xhttp.open('GET', '../controller/get-services.php?service=' + search, true);
    xhttp.send();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = JSON.parse(this.responseText);
            if (result.length > 0) {
                result.forEach(data => {
                    addRow(table, data);
                });
            }
            else{
                let newRow = table.insertRow(table.rows.length);
                newRow.innerHTML = '<tr><td align=\"center\">No Services Available</td></tr>';
            }
        }
    }
    }


    function addRow(table, rowdata) {

    let newRow = table.insertRow(table.rows.length);

    let cell1 = newRow.insertCell(0);

    cell1.innerHTML = "<td align='left'><img src='../" + rowdata.Image + "' width='250px'><br><br><a href='service-page.php?id=" + rowdata.ServiceID + "'>" + rowdata.ServiceName + "</a></td>";

    }

</script>
<table border=0 cellspacing=0 cellpadding=20 width=100%>
    <tr>
        <td align="left">
            <a href="user-home.php">Home</a>
        </td>
        <td align="center">
            <input type="text" placeholder="Search..." size=100  id="search" onkeyup="searchServices()">
        </td>
        <td align="right">
            <select name="menu" onchange="location = this.value">
                <option disabled selected hidden> <?php echo $row["Username"]; ?> </option>
                <option value="profile.php"> View Profile </option>
                <option value="edit-profile.php"> Edit Profile </option>
                <option value="change-password.php"> Change Password </option>
                <option value="delete.php"> Delete Account </option>
            </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="cart.php">Cart</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="../controller/logout-controller.php">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="20" id="service-table">
    <tr>
        <td></td>
    </tr>
</table>