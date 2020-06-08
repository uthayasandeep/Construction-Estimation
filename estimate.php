<?php
$servername = "localhost";
$username = "***------Your User name---------***";
$password = "***------Your DB Password---------****";
$dbname = "***------Your DB name---------***";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$name = $_POST['cname'];
$email = $_POST['email'];
$squarefeet = $_POST['squarefeet'];
$room = $_POST['room'];
$bhk_value3 = 0;
$bhk_value2 = 0;
$bhk_value1 = 0;
if($room == '1bhk'){
  $bhk_value1 = $squarefeet * 500;
}
elseif($room == '2bhk'){
  $bhk_value2 = $squarefeet * 1000;
}
else{
  $bhk_value3 = $squarefeet * 2000;
}
$estimated_amount = array($bhk_value1, $bhk_value2, $bhk_value3);
$submitted_value = array_filter($estimated_amount); 
foreach($submitted_value as $key=>$value){
     $s_value = $value;
}
$sql = "INSERT INTO estimate (name, email, squarefeet,room, bhk_value1, bhk_value2, bhk_value3)
VALUES ('$name','$email','$squarefeet', '$room', '$bhk_value1', '$bhk_value2', '$bhk_value3')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    //Sender Mail Id..Enter Your Mail id
    $from_mail = '*****----Your Mail id---------******';
    //Instead of VeeraBuilders You can give Your Company name.
    $from="From:veerabuilders <$from_mail>";
    $to      = $email;
    $subject = 'Estimation';
    
    $message = 'Hi '. $name . ', estimation has been done for your inputs.Our estimated amount for your building is Rs '. $s_value;
    $headers = array(
        'From' => '***------Your Mail id---------***',
        'Reply-To' => '***------Your Mail id---------***',
        'X-Mailer' => 'PHP/' . phpversion()
    );
    
    $success = mail($to, $subject, $message,$from);
    if (!$success) {
        $errorMessage = error_get_last()['message'];
    }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();



?>