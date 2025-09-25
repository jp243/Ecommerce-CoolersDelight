<?php
    $admin = $_SESSION['admin_id'];

    switch($admin){

        case 1: echo '
                <option value="approved">APPROVED</option>
                <option value="disapproved">DISAPPROVED</option>
                ';
                break;
        case 2: echo '
                <option value="approved">APPROVED</option>
                <option value="disapproved">DISAPPROVED</option>
                ';
                break;
        case 3: echo '
                <option value="preparing">PREPARING</option>
                <option value="forDelivery">FOR DELIVERY</option>
                ';
                    break;
        case 4: echo '
                    <option value="enroute">ENROUTE</option>
                    <option value="delivered">DELIVERED</option>
                    ';

            break;
        default: echo "User not allowed";
    }
?>