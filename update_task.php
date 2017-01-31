<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('task.class.php');



$data = json_decode($_POST["data"]);
$task_name = $data[0];
$task_desc = $data[1];
$task_id = $data[2];
$action = $data[3];


$task_class = new Task;
if($action == "save"){
    $task_class->TaskId = $task_id;
    $task_class->TaskName = $task_name;
    $task_class->TaskDescription = $task_desc;     
    $task_class->Save();
}else{
    $task_class->TaskId = $data[0]; 
    $task_class->Delete();
}
// Assignment: Implement this script
?>