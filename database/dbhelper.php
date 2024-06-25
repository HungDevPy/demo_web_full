<?php
require_once('config.php');

function execute($sql)
{
	//save data into table
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	mysqli_query($con, $sql);	

	//close connection
	mysqli_close($con);
}

function executeResult($sql)
{
    // Open connection to the database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    // Check if the connection was successful
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Execute the query
    $result = mysqli_query($con, $sql);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    // Fetch data from the result set
    $data = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data[] = $row;
    }

    // Close connection
    mysqli_close($con);

    return $data;
}


function executeSingleResult($sql)
{
	//save data into table
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	$result = mysqli_query($con, $sql);
	$row    = mysqli_fetch_array($result, 1);

	//close connection
	mysqli_close($con);

	return $row;
}
// Hàm thực hiện truy vấn SQL để lấy dữ liệu sản phẩm cho mỗi trang
function getProductsForPage($currentPage, $limit)
{
	$start = ($currentPage - 1) * $limit;
	$sql = "SELECT * FROM sanpham LIMIT $start, $limit";
	return executeResult($sql);
}
function getProductsForPageMa($currentPage, $limit,$id_danhmucsp)
{
	$start = ($currentPage - 1) * $limit;
	$sql = "SELECT * FROM sanpham where id_danhmucsp=$id_danhmucsp LIMIT $start, $limit";
	return executeResult($sql);
}
function getAllProducts()
{
	$sql = "SELECT * FROM sanpham ";
	return executeResult($sql);
}


function executeInsert($sql)
{
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	
	if (mysqli_query($con, $sql)) {
        // If the query is successful, get the ID of the last inserted row
        $insertedId = mysqli_insert_id($con);
    } else {
        // If the query fails, print the error details
        echo "Error: " . mysqli_error($con);
        $insertedId = 0; // Set to 0 to indicate failure
    }

	// close connection
	mysqli_close($con);

	return $insertedId;
}