<?php 
        function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                $data = strip_tags($data);
                return $data;   
        }
?>