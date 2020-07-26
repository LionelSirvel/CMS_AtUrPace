<?php

$connection = mysqli_connect('localhost','root','','cms');

if($connection)
{
//echo "Successfully connected to cms database ";
}
else
{
    echo "Error connecting to cms database, please check db.php ";
}