<?php
session_start();
header("Content-Type: application/json");

include "sid.php";
include "soap.php";

$user = "fritz2992";
$pass = "admin";

$sid = getSID($user, $pass);

if(!$sid){
    echo json_encode(["error"=>"no sid"]);
    exit;
}

// PING ROUTER (REAL)
$pingRaw = shell_exec("ping -n 1 192.168.178.1");
preg_match('/Average = (\d+)ms/', $pingRaw, $m);
$ping = $m[1] ?? null;

// INTERNET STATUS (REAL ROUTER CALL)
$internetXML = callSOAP($sid, "WANIPConnection", "GetStatusInfo");

// DSL INFO (REAL)
$dslXML = callSOAP($sid, "WANDSLInterfaceConfig", "GetInfo");

// OUTPUT RAW (NO FAKE VALUES)
echo json_encode([
    "ping"=>$ping,
    "internet_xml"=>$internetXML,
    "dsl_xml"=>$dslXML,
    "sid"=>$sid
]);
?>
