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
   /* $sql = 'SELECT start, end FROM ' . $tmtbname . ' WHERE id=' . $id . ' LIMIT ' . $slctlimit; */
   $sql = 'SELECT start, end FROM ' . $tmtbname . ' WHERE id=' . $id;
   if ($result = $sqlcnct->query($sql)) {
           while ($row = $result->fetch_assoc()) {
                   $array[] = array('start' => $row['start'], 'end' => $row['end'],);
           }
           $array = array_reverse($array);
           $json = json_encode($array, JSON_PRETTY_PRINT);
           echo $json;
           $result->close();
   }
   $sqlcnct->close();

   function get_request() {
       $content_type = explode(';', trim(strtolower($_SERVER['CONTENT_TYPE'])));
       $media_type = $content_type[0];

       if ($_SERVER['REQUEST_METHOD'] == 'POST' && $media_type == 'application/json') {
           $request = json_decode(file_get_contents('php://input'), true);
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
