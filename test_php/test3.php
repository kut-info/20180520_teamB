<?php
$data = array(
    array(
        "start" => "2018-01-03 00:00:00",
        "end" => "",
        ),
    array(
        "start" => "2018-01-02 00:00:00",
        "end" => "2018-01-02 12:12:12",
        ),
    array(
        "start" => "2018-01-01 00:00:00",
        "end" => "2018-01-01 12:12:12",
    )
);
echo json_encode($data);