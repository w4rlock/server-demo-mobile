<?php
session_start();
require_once("db_connect.php");
require_once("login.php");
require_once("utils.php");
require_once("usr.php");
 
$error='';

function makeToken() {
    return sha1(uniqid(microtime(),true));
}

function send_response($msj){
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/x-javascript');

    //JSONP
    if ((isset($_GET['callback']))&&(!empty($_GET['callback']))){
        $utils = new utils();
        $cb = $utils->limpiarDato($_GET['callback']);
        echo $cb . '(' . json_encode($msj,true) . ');';
    }
    else{
        echo json_encode($msj,true);
    }
}

function get(){
   if ((isset($_GET['action']))&&(!empty($_GET['action']))){
       switch ($_GET['action']) {
           case 'login.find':
                $login = new login();
                $utils = new utils();
                $ar=array('username'=>$_GET['username'],
                          'password'=>$_GET['password']);
                $utils->limpiarQuery($ar);
                $row = $login->find($ar);
                if ($row['numrows'] < 1) {
                    $response['error'] = 'Usuario o password no validos';
                }
                else{
                    //$_SESSION[md5('usr_id')] = $row['usr_id'];
                    $response['name'] = $row['name'];
                    $response['surname'] = $row['surname'];
                    //echo $login->isLogged();
                }
                break;

           case 'login.insert':
                $usr = new usr();
                $login = new login();
                $arr=$utils->limpiarQuery($_GET);
                if ($login->exist($arr['username'])){
                    $response['error'] = 'El usuario ' . $arr['username'] . ' ya se encuentra registado';
                }
                else{
                    $id = $usr->insert($arr);
                    $arr['usr_id'] = $id;
                    $login->insert($arr);
                    $response['id'] = $id;
                }
                break;

           case 'pedido.findMenu': break;

           case 'pedido.insert': break;

           case 'pedido.find': break;

           default: break;
       }
       send_response($response);
   }
}

//function post(){}

//function put(){}

//if ($_GET) {
$tokenOk = false;
if (($_GET['authToken'] == $_SESSION['authToken'])) {
    $tokenOk = true;
}
$_SESSION['authToken'] = makeToken();
echo $_SESSION['authToken'];
//}
 
//if ($_GET && $tokenOk == false) {
    //$response['error'] =  'Token no valido';
    //send_response($response) 
    //return;
//}
//else{
    ////$response['authToken'] = $_SESSION['authToken'];
//}
$method = $_SERVER['REQUEST_METHOD'];
$resource = $_SERVER['REQUEST_URI'];

//$params = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

switch ($method) {
    case 'GET':
         this.get();
         break;
    case 'POST':
        break;
    case 'PUT':
        //parse_str(file_get_contents('php://input'), $arguments);
        break;
    case 'DELETE':
        break;
}
?>
