<?php 
$json = '
    {
      "number": "1234",
      "name": "Bill",
      "Habit": [
        "Reading",
        "Sport"
      ]
    }
    ';

$obj = json_decode($json);

echo "Name: " . $obj->name . "<br />";
echo "Number: " . $obj->number . "<br />";
echo "Habit: <br />";

foreach ($obj->Habit as $habit) {
    echo $habit . "<br />";
}