<?php

include_once('Detached.php');

$dude = $_GET['dude'];

$detached_in = new Detached($dude);

//$result = $detached_in->getExperience();
//$result = $detached_in->getLanguages();

$result = $detached_in->getAll();

$detached_in->cleanUp();

header('Content-type: application/json');

echo json_encode($result);
