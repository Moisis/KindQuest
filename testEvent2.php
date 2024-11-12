<?php

require_once __DIR__."/app/models/Events/Fundraising.php";

$testFund = new Fundraising("No","no","22-10-2002","23-10-2002",1,30);
$testFund->insertEvent(1);