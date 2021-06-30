<?php

if( isset( $_GET[ 'Submit' ] ) ) {
    // Get input
    $id = $_GET[ 'id' ];

    // xac nhan ID da la 1 son hay chua
    if(is_numeric( $id )) {
        // Check the database
        $data = $db->prepare( 'SELECT first_name, last_name FROM users WHERE user_id = (:id) LIMIT 1;' );
        $data->bindParam( ':id', $id, PDO::PARAM_INT );
        $data->execute();

        // Dam bao rang chi tra ve 1 gia tri
        if( $data->rowCount() == 1 ) {
            // Feedback cho người dùng (có thể thấy không có bất kì dữ liệu nào được thực sự trả về )
            echo '<pre>User ID exists in the database.</pre>';
        }
        else {
            // Khong tim thay 
            header( $_SERVER[ 'SERVER_PROTOCOL' ] . ' 404 Not Found' );


            echo '<pre>User ID is MISSING from the database.</pre>';
        }
    }
}

?> 