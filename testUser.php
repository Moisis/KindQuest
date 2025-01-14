<?php
require_once "app/models/Users/Individual.php";
$accountid = 12345;
$hamza = new Individual(accountId: $accountid); ;
$hamza->register(["Hamza","1234"]);