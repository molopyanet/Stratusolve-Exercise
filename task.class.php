<?php

/**
 * This class handles the modification of a task object
 */
class Task {

    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    public $key;
    protected $TaskDataSource;

    public function __construct($Id = null) {
        $this->TaskDataSource = file_get_contents('Task_Data.txt');
        if (strlen($this->TaskDataSource) > 0)
            $this->TaskDataSource = json_decode($this->TaskDataSource); // Should decode to an array of Task objects
        else
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array

        if (!$this->TaskDataSource)
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array
        if (!$this->LoadFromId($Id))
            $this->Create();
    }

    protected function Create() {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
        $this->TaskId = $this->getUniqueId();
        return($this->TaskId);
    }

    public function getUniqueId() {
        // Assignment: Code to get new unique ID       
        $newId = uniqid();
        return $newId;
    }

    protected function LoadFromId($Id = null) {
        if ($Id) {
            // Assignment: Code to load details here...
        } else
            return null;
    }

    public function Save() {
        if ($this->TaskId == -1) {
            $this->TaskId = $this->Create();
            $new_task_array = array("TaskId" => $this->TaskId, "TaskName" => $this->TaskName,
                "TaskDescription" => $this->TaskDescription);
            array_push($this->TaskDataSource, $new_task_array);
            file_put_contents('Task_Data.txt', json_encode($this->TaskDataSource));
        } else {
            $full_array = (array) $this->TaskDataSource;
            for ($i = 0; $i < sizeof($full_array); $i++) {
                $inner = (array) $full_array[$i];
                if ($inner['TaskId'] === $this->TaskId) {
                    $inner['TaskName'] = $this->TaskName;
                    $inner['TaskDescription'] = $this->TaskDescription;
                    $full_array[$i] = $inner;
                }
            }
            file_put_contents('Task_Data.txt', json_encode($full_array));
        }
    }

    public function Delete() {
        //Assignment: Code to delete task here       
        $full_array = (array) $this->TaskDataSource;
        print_r($full_array);
        for ($i = 0; $i < sizeof($full_array); $i++) {
            $inner = (array) $full_array[$i];
            if ($inner['TaskId'] === $this->TaskId) {               
                unset($full_array[$i]);
            }
        }
        print_r($full_array);
        file_put_contents('Task_Data.txt', json_encode($full_array));
    }

}

?>