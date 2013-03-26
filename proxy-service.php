<?php
/**
 * Proxy Service to make cross domain HTTP requests
 * Author : Asanka Nissanka
 * Released under MIT License
 */
switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        //HANDLING GET MESSAGES

        //set GET variables
        $url = $_GET['csurl'];
        unset($_GET['csurl']);

        //open connection
        $ch = curl_init();
        //set the url
        curl_setopt($ch,CURLOPT_URL,$url);

        //execute get
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        break;
    case "POST":
        //HANDLING POST MESSAGES

        //set POST variables
        $url = $_POST['csurl'];
        unset($_POST['csurl']);

        //$url='http://192.168.1.2:8998/riak/test';
        $headers = apache_request_headers();
        $url=$headers['X_CSURL_HEADER'];
        //JSON object
        //$content=$_POST['content'];
        $content=file_get_contents('php://input');
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$content);
        curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        break;
    case "PUT":
        //HANDLING PUT MESSAGES
        $content=file_get_contents("php://input");
        //set POST variables
        $headers = apache_request_headers();
        $url=$headers['X_CSURL_HEADER'];
        //JSON object
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'PUT');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Length: '.strlen($content)));
        curl_setopt($ch,CURLOPT_POSTFIELDS,$content);

        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        break;
    case "DELETE":
        //HANDLING PUT MESSAGES
        //$content=file_get_contents("php://input");
        //set POST variables
        $headers = apache_request_headers();
        $url=$headers['X_CSURL_HEADER'];
        //JSON object
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'DELETE');
        //curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Length: '.strlen($content)));
        //curl_setopt($ch,CURLOPT_POSTFIELDS,$content);

        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        break;
    default:

}

?>