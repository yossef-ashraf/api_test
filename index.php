<?php
require_once "database/database.php";
require_once "api/user.php";
$url = explode("/",$_SERVER['QUERY_STRING']); 

// .htaccess ues for spicf url and send to index 
// $url have a url without localhost/folder_name
// $url start from file_name like ( index not index.php )
// $url = array coz explode function 
// array = Array ( [0] => index [1] => ?? [2] => ?? ......)
// print_r($url);die;
//folder_name is a index.php dont must write it in url 




header("Access-Control-Allow-Origin:application/json");
// to access json file 
header("Content-Type: application/json; charset=UTF-8");
// type of api is json and support عربي

if($url[1] == 'v1') {
// api / v1 

if ($url[2] == "user" ) {
// api / v1 / user 

$user= new user;

//// methods
if ($url[3] == "all" ) {
    // api / v1 / user /all 

$data= $user->all();
$res=['status'=>200 ,'data'=>$data];
$res= json_encode($res);
print_r($res);
// end  all api
}
/////////////////////////////////////////////////////////////////////////////
elseif ($url[3] == "add" ) {
// api / v1 / user / add
header ('Access-Control-Allow-Methods: POST' ) ;
$data= file_get_contents("php://input") ;
$data_de = json_decode($data,true);
$res = $user->add($data_de);
if ($res) {
http_response_code(201);
$res=['status'=>201 ,'msg'=>"done"];
}else{
http_response_code(400);
$res=['status'=>400 ,'msg'=>"error"];
}
// coz if word must use return in funtion if dont use will $res not have ant value always be null 
$res= json_encode($res);
print_r($res);
// end  add api
}
/////////////////////////////////////////////////////////////////////////////
elseif ($url[3] == "update" ) {
// api / v1 / user /update
header ('Access-Control-Allow-Methods: PUT' ) ;
$data= file_get_contents("php://input") ;
$data_de = json_decode($data,true);
// structure json must be 
// {
// "id":??
// "users":{
// all property : valeus}}
$id=["id" => $data_de['id']] ;
$data= $data_de['users'];
$res=$user->update($data ,$id);
if ($res){
http_response_code(200);
$res=['status'=>200 ,'msg'=>"done"];}else{
http_response_code(400);
$res=['status'=>400 ,'msg'=>"error"];}
$res= json_encode($res);
print_r($res);
}
/////////////////////////////////////////////////////////////////////////////
elseif ($url[3] == "delete" ) {
// api / v1 / user /delete
header ('Access-Control-Allow-Methods: DELETE' ) ;
$data= file_get_contents("php://input") ;
$data_de = json_decode($data,true);
$id=["id" => $data_de['id']] ;
$res=$user->delete($id);
if ($res){
http_response_code(200);
$res=['status'=>200 ,'msg'=>"done"];}else{
http_response_code(400);
$res=['status'=>400 ,'msg'=>"error"];}
$res= json_encode($res);
print_r($res);
// end of methods
}
elseif ($url[3] == "delete-all" ) {
// api / v1 / user /delete-all
header ('Access-Control-Allow-Methods: DELETE' );

$res=$user->delete_all();
if ($res){
http_response_code(200);
$res=['status'=>200 ,'msg'=>"done"];}else{
http_response_code(400);
$res=['status'=>400 ,'msg'=>"error"];}
$res= json_encode($res);
print_r($res);


// end of methods
}

// end of user
}

// end of v1
}






