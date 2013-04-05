<?php
class usr
{
    function __construct($name)
    {
    }

    function find($obj){
        //$query  = "SELECT l.usr_id, name, surname FROM login l INNER JOIN usr u ON u.usr_id = l.usr_id ";
        //$query .= "WHERE l.username = '" . $obj['username'] . "' AND l.password = sha1('" . $obj['password'] . "')";

        //$result = mysql_query($query) or die('not connected');
        //$row=mysql_fetch_assoc($result);
        //$row['numrows'] = mysql_num_rows($result);
        //mysql_free_result($result); 

        //return $row;
    }
    
    function insert($obj){
        $query  = "INSERT INTO usr(name, surname, address) ";
        $query .= "VALUES ('" . $obj['name'] . "','" . $obj['surname'] . "','" . $obj['address'] . "')";
        mysql_query($query) or die(mysql_error());

        return mysql_insert_id();
    }

}

?>
