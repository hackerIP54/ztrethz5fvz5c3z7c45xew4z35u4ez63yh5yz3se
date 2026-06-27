<?php
function callSOAP($sid, $service, $action) {

    $url = "http://fritz.box:49000/$service";

    $xml = '<?xml version="1.0"?>
<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
 <s:Body>
  <u:' . $action . ' xmlns:u="urn:dslforum-org:service:' . $service . ':1">
   <NewX_AVM_DE_SID>' . $sid . '</NewX_AVM_DE_SID>
  </u:' . $action . '>
 </s:Body>
</s:Envelope>';

    $opts = [
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: text/xml\r\n",
            "content" => $xml,
            "timeout" => 3
        ]
    ];

    $context = stream_context_create($opts);
    return @file_get_contents($url, false, $context);
}
?>
