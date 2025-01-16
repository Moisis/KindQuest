<?php
require_once "IIterator.php";
interface IIterableCollection
{
    public function createIterator();
}