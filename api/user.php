<?php
use Dcblogdev\PdoWrapper\Database;


class user {
public $db;
// coz can use in all funtions

public function __construct(){
// make a connection to mysql here
$options = [
//required
'username' => 'root',
'database' => 'api',
//optional
'password' => '',
'type' => 'mysql',
'charset' => 'utf8',
'host' => 'localhost',
'port' => '3306'
];
$this->db = new Database($options);
}
public function all(){
$data =json_encode( $this->db->rows("SELECT * FROM users "));
// print_r($data);
// $res=['status'=>200 ,'data'=>$data];
// print_r(json_encode($res));
return $data ;
}
public function add($data){
$data["name"]= stripslashes(trim(htmlspecialchars($data["name"])));
$data["email"]=stripslashes(trim(htmlspecialchars($data["email"])));
$data["pass"]= stripslashes(trim(htmlspecialchars(md5($data["pass"]))));
$data = $this->db->insert("users" , $data );
return $data ;
}
public function update($data ,$id){
if (!empty($data["id"])) {
$data["id"]=stripslashes(trim(htmlspecialchars($data["id"])));
}
if (!empty($data["name"])) {
$data["name"]=stripslashes(trim(htmlspecialchars($data["name"])));
}
if (!empty($data["email"])) {
$data["email"]=stripslashes(trim(htmlspecialchars($data["email"])));
}
if (!empty($data["pass"])) {
$data["pass"]= stripslashes(trim(htmlspecialchars(md5($data["pass"]))));
}
$data = $this->db->update("users" , $data ,$id );
return $data ;
}
public function delete($id){
$id=trim(stripslashes(htmlspecialchars($id)));
$data = $this->db->delete("users",$id );
return $data ;
}
public function delete_all(){
$data = $this->db->deleteAll('users');
return $data ;
}
}








//////////////////////////////////////////////////////////////////////////////////////////////////////
// js thinging if i use $res=['status'=>200 ,'data'=>$data];                                        //
// x = {'y':55,'z':[1,11,111]}                                                                      //
// {y: 55, z: Array(3)}                                                                             //
// x.z = [{'o':5},{'o':9}]                                                                          //
// (2) [{…}, {…}]                                                                                   //
// x.z                                                                                              //
// (2) [{…}, {…}]0: {o: 5}o: 5[[Prototype]]: Object1: {o: 9}length: 2[[Prototype]]: Array(0)        //
// var data = x.z                                                                                   //
// undefined                                                                                        //
// data                                                                                             //
// (2) [{…}, {…}]0: {o: 5}1: {o: 9}length: 2[[Prototype]]: Array(0)                                 //
// data.map(d=> d.o)                                                                                //
// (2) [5, 9]                                                                                       //
//////////////////////////////////////////////////////////////////////////////////////////////////////

