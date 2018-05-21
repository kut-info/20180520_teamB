<?php
   $host = 'localhost';
   $user = 'root';
   $password = '';
   $dbname = 'test';
   $tmtbname = 'time';
   /* $slctlimit = '10'; */
   /* $id = '1'; */


   $idjson = get_request();
   $id = $idjson["id"];
   $sqlcnct = new mysqli($host, $user, $password, $dbname);
   if ($sqlcnct->connect_error) {
           echo $sqlcnct->connect_error;
           exit();
   } else {
           $sqlcnct->set_charset('utf8');
   }
   echo var_dump($idjson);
   /* $sql = 'SELECT start, end FROM ' . $tmtbname . ' WHERE id=' . $id . ' LIMIT ' . $slctlimit; */
   $sql = 'SELECT start, end FROM ' . $tmtbname . ' WHERE id=' . $id;
   $array = array();
   if ($result = $sqlcnct->query($sql)) {
           while ($row = $result->fetch_assoc()) {
                   $array[] = array('start' => $row['start'], 'end' => $row['end'],);
           }
           $array = array_reverse($array);
           /*if (empty($array)) {
               $array = array("mode" => "empty");
           }
           */
           //$json = json_encode($array, JSON_PRETTY_PRINT);
           $json = json_encode($array);
           echo $json;
           $result->close();
   } else {
       echo json_encode(array("mode"=>"ea"));
   }
   $sqlcnct->close();

   function get_request() {
       //$content_type = explode(';', trim(strtolower($_SERVER['CONTENT_TYPE'])));
       //$media_type = $content_type[0];

       //if ($_SERVER['REQUEST_METHOD'] == 'GET' && $media_type == 'application/json') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $con = file_get_contents('php://input');
           echo var_dump(file_get_contents('php://input'));
           $request = json_decode($con, true);
           echo var_dump($con);

       } else {
           $request = $_REQUEST;
           foreach ($_REQUEST as $key => $value) {
               $request[$key] = json_decode($value, true);
               if ($request[$key] == null) {
                   $request[$key] = $value;
               }
           }
       }
       return $request;
   }
?>
