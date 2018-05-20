<?php
   $host = 'localhost';
   $user = 'root';
   $password = '';
   $dbname = 'test';
   $tmtbname = 'time';
   $slctlimit = '10';
   $id = '1';

   $sqlcnct = new mysqli($host, $user, $password, $dbname);
   if ($sqlcnct->connect_error) {
           echo $sqlcnct->connect_error;
           exit();
   } else {
           $sqlcnct->set_charset('utf8');
   }
    $sql = 'SELECT start, end FROM ' . $tmtbname . ' WHERE id=' . $id . ' LIMIT ' . $slctlimit;
   if ($result = $sqlcnct->query($sql)) {
           while ($row = $result->fetch_assoc()) {
                   $array[] = array('start' => $row['start'], 'end' => $row['end'],);
           }
           $json = json_encode($array, JSON_PRETTY_PRINT);
           echo $json;
           $result->close();
   }
   $sqlcnct->close();
?>
