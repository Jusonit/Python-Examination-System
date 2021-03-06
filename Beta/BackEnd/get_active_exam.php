<?php

require_once("db.php");

function get_active_exam()
{
    $db = new DB();
    $conn = $db->get_connection();

    $exam_name = get_active_exam_name();

    $query = "SELECT masterquestions.intro,$exam_name.points  
              FROM $exam_name NATURAL JOIN masterquestions 
              ORDER BY examQuestionID";

    $questions = array();

    if ($result = $conn->query($query))
        while ($row = $result->fetch_row())
            $questions[] = $row;

    $conn->close();

    return $questions;
}

function get_active_exam_name()
{
    $db = new DB();
    $conn = $db->get_connection();

    $success = $conn->query("SELECT `exam_name` FROM `examstatus` WHERE `status` = 1");
    $conn->close();

    return $success->fetch_array()["exam_name"];
}

?>