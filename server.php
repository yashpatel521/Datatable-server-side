<?php

// DB table to use
$table = 'user_details';

// Table's primary key
$primaryKey = 'user_id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'user_id', 'dt' => 0),
    array('db' => 'first_name',  'dt' => 1),
    array('db' => 'last_name',   'dt' => 2),
    array('db' => 'username', 'dt' => 3,),
    array('db' => 'gender', 'dt' => 4,),
    array('db' => 'password', 'dt' => 5,),
    array(
        'db' => 'date', 'dt' => 6,
        'formatter' => function ($d) {
            return date('d-M-Y', strtotime($d));
        }
    )
);

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'first',
    'host' => 'localhost'
);

// $where = "first_name ='wright'"; //You SQL where condition
$where = ""; //You SQL where condition
require('ssp.class.php');
$response = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, '', $where);

for ($i = 0; $i < sizeof($response['data']); $i++) {
    $response['data'][$i][1] = '<a href="' . $response['data'][$i][0] . '">' . $response['data'][$i][1] . '</a>';
}

echo json_encode($response);
