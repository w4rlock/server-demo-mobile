<?php
class login
{
    function __construct($name)
    {
    }

    function find($obj){
        $query  = "SELECT l.usr_id, name, surname FROM login l INNER JOIN usr u ON u.usr_id = l.usr_id ";
        $query .= "WHERE l.username = '" . $obj['username'] . "' AND l.password = sha1('" . $obj['password'] . "')";

        $result = mysql_query($query) or die(mysql_error());
        $row=mysql_fetch_assoc($result);
        $row['numrows'] = mysql_num_rows($result);
        mysql_free_result($result); 

        return $row;
    }
    
    function logout() {
        session_destroy();

    }
    
    function isLogged(){
        return isset($_SESSION[md5('usr_id')]);
    }
    
    function insert($obj){
        $query  = "INSERT INTO login(usr_id, username, password) ";
        $query .= "VALUES ('" . $obj['usr_id'] . "','" . $obj['username'] . "',sha1('" . $obj['password'] . "'))";
        mysql_query($query) or die(mysql_error());
    }

    function exist($username){
        $query  = "SELECT COUNT(1) AS res FROM login WHERE username = '" . $username . "'";
        $result = mysql_query($query) or die(mysql_error());
        $row=mysql_fetch_assoc($result);
        mysql_free_result($result); 

        return ($row['res'] >= 1);
    
    }

}

?>
