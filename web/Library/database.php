<?php


function get_db() {
	$db = NULL;

  try
  {
    $dbUrl = getenv('DATABASE_URL');

    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"],'/');

    //$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    $db = new PDO('postgres://herymnpumbdvjl:5fb0816b5f1b1f359576c0e56a0a5ee887564e76e8c14105b88d98c11d52ad07@ec2-52-201-55-4.compute-1.amazonaws.com:5432/d57aqo8h5p3d3i');

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch (PDOException $ex)
  {
    echo 'Error!: ' . $ex->getMessage();
    die();
  }

  return $db;
}