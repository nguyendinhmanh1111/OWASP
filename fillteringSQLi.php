<?php

if( isset( $_GET[ 'Submit' ] ) ) {
    // Get input
    $id = $_GET[ 'id' ];

    // xac nhan ID da la 1 son hay chua
    if(is_numeric( $id )) {
        // Check the database
        $data = $db->prepare( 'SELECT first_name, last_name FROM users WHERE user_id = (:id) LIMIT 1;' );
        //các biến bị ràng buộc chuyển giá trị của chúng làm đầu vào và nhận giá trị đầu ra
        $data->bindParam( ':id', $id, PDO::PARAM_INT );
        $data->execute();
        // Dam bao rang chi tra ve 1 gia tri
        if( $data->rowCount() == 1 ) {
            // Get values
            $first = $row[ 'first_name' ];
            $last  = $row[ 'last_name' ];

            // Feedback cho user(day cung co the la 1 lo hong ERROR-BASED SQLi)
            echo "<pre>ID: {$id}<br />First name: {$first}<br />Surname: {$last}</pre>";
        }
    }
}
?> 