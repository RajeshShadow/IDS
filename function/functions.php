<?php
/*----------------------------Connection--------------------------*/
function db_connect() {
    static $con;
    if(!isset($con)) {
		$db_host = 'localhost';
		$db_database = 'cenjowsg_new';
		$db_user = 'root';
		$db_pass = '';
        $con = mysqli_connect($db_host,$db_user,$db_pass,$db_database);
    }
    if($con === false) {
        return mysqli_connect_error(); 
    }
    return $con;
}
/*----------------------------edit gallery album -------------------------*/



/*----------------------------Insert All Data--------------------------*/



function dbrowInsert($table_name, $form_data)
{
	$con = db_connect();
    $fields = array_keys($form_data);
	$sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $form_data)."')";
	
	$result_final=mysqli_query($con,$sql);
	return $result_final;
}
/*----------------------------Delete Data--------------------------*/
function dbRowDelete($table_name, $where_clause='')
{
	$con = db_connect();
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;

	
    // run and return the query result resource
    return mysqli_query($con,$sql);
}
/*----------------------------Update Data--------------------------*/
function dbRowUpdate($table_name, $form_data, $where_clause='')
{
	$con = db_connect();
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;

    // run and return the query result
    return mysqli_query($con,$sql);
}
/*----------------------------Fetch All Data--------------------------*/
function dbRowselect($table_name)
{
	$con = db_connect();
    // check for optional where clause
    // build the query
    $sql = "select * FROM ".$table_name;

	
    // run and return the query result resource
    return mysqli_query($con,$sql);
}
/*----------------------------Fetch All Data where condition

Like   dbRowselectwhere('main_category', "WHERE main_id = '$main_id'")
--------------------------*/
function dbRowselectwhere($table_name, $where_clause='')
{
	$con = db_connect();
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "select * FROM ".$table_name.$whereSQL;

	
    // run and return the query result resource
    return mysqli_query($con,$sql);
}
?>