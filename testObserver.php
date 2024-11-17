<?php

require_once("app/models/Users/BaseAccoount.php");
require_once("app/enums/NotificationFor.php");


$obs = BaseAccount::getPreferencesObserver(NotificationFor::Donation->value, 1);

$obs->notify("hello");