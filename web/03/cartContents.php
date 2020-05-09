<?php
session_start();

$pets = [
  "Poppy" => array(
    "Age"   => "2 years",
    "Breed" => "Australian Shepherd Collie Mix",
    "Price" => "200",
    "URL"   => "https://cdn.pixabay.com/photo/2019/07/01/11/23/dog-4309752_960_720.jpg"
  ),
  "Max" => array(
    "Age"   => "3 years",
    "Breed" => "Long-haired Chihuahua",
    "Price" => "200",
    "URL"   => "https://cdn.pixabay.com/photo/2017/10/29/18/00/chihuahua-2900362_960_720.jpg"
  ),
  "Milo" => array(
    "Age"   => "8 years",
    "Breed" => "Lab Mix",
    "Price" => "150",
    "URL"   => "https://cdn.pixabay.com/photo/2014/04/05/11/38/dog-316459_960_720.jpg"
  ),
  "Charlie" => array(
    "Age"   => "7 years",
    "Breed" => "Terrier Mix",
    "Price" => "150",
    "URL"   => "https://cdn.pixabay.com/photo/2014/04/05/11/40/dog-316598_960_720.jpg"
  ),
  "Bella" => array(
    "Age"   => "4 years",
    "Breed" => "Australian Shepherd",
    "Price" => "200",
    "URL"   => "https://cdn.pixabay.com/photo/2016/03/22/13/25/dog-1272872_960_720.jpg"
  ),
  "Brittany" => array(
    "Age"   => "5 years",
    "Breed" => "Boxer",
    "Price" => "200",
    "URL"   => "https://cdn.pixabay.com/photo/2016/03/24/22/53/boxer-1277804_960_720.jpg"
  ),
];

$name = $_GET['name'];

if (!isset($_SESSION['cart'])) {
  $array = array();
  array_push($array, $name);
  $_SESSION['cart'] = $array;
  $_SESSION['cost'] += $pets[$name]['Price'];
} else {
  if(!in_array($name, $_SESSION['cart'])) {
    array_push($_SESSION['cart'], $name);
    $_SESSION['cost'] += $pets[$name]['Price'];
  }
    
}

?>