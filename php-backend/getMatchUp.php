<?php

require 'vendor/autoload.php';


header('Content-Type: application/json');

$out = ["test" => "works"];

echo json_encode($out);