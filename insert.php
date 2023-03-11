<?php
ini_set('display errors', '1');
if ( isset($fname) || isset($lname) || isset($password) || isset($gender) || isset($email) || isset($phonecode) || isset($phone) ){
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email =$_POST['email'];
$phonecode = $_POST['phonecode'];
$phone = $_POST['phone'];

if (!empty($fname)|| !empty($lname)|| !empty($password)|| !empty($gender)|| !empty($email)||
 !empty($phonecode)|| !empty($phone)){
    $host = "localhost";
    $dbUsername= "root";
    $password='';
    $dbname ="organic";

    //create connection
    $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

    if (mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }else{
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT ="INSERT = Into register(fname,lnane, password,gender,email,phonecode,phone)(?,?,?,?,?,?,?)";
        //prepare statement 
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0){
            $tmt->close();

            $stmt=$conn->prepare($INSERT);
            $stmt->bind_param("sssssii",$fname,$lname,$password,$gender,$email,
               $phonecode,$phone);
            $stmt->execute();
            echo "new record inserted successfully";
        }else{
            echo "Someone already registered using this email";}
        $stmt->close();
        $conn->close();
    }
}else{
    echo "All field are required"; die();}
}

?>