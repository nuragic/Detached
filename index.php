<?php

include_once('Detached.php');

$dude     = $_GET['dude'];
$download = array_key_exists('download', $_GET);

if ($dude) {

  $detached_in = new Detached($dude);

  //$result = $detached_in->getExperience();
  //$result = $detached_in->getLanguages();
  //$result = $detached_in->getSkills();

  $result = $detached_in->getAll();

  $detached_in->cleanUp();

  if ($result) {

    if ($download) {
      header('Content-Transfer-Encoding: binary');
      header("Content-disposition: attachment; filename=$dude.json");
    }

    header('Content-type: application/json');

    echo json_encode($result);
  }

}
