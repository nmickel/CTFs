<?php
use ZMQ\ZMQContext;

require realpath(dirname(__FILE__))."/rpc/Channel.php";
require realpath(dirname(__FILE__))."/rpc/Client.php";
require realpath(dirname(__FILE__))."/rpc/Event.php";
require realpath(dirname(__FILE__))."/rpc/Exception.php";
require realpath(dirname(__FILE__))."/rpc/Hook.php";

use ZeroRPC\Client;
use ZeroRPC\Channel;

$rpc = new Client("tcp://wp_centicorp_rpc:4242");
$rpc->setTimeout(5000);
?>
