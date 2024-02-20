<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calculator";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the result from the form submission
if (isset($_POST['result'])) {
    $result = $_POST['result'];

    $sql = "INSERT INTO tbl_calcu (result) VALUES ('$result')";

    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} 

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calculator</title>
</head>
<body>
    <div class="container">
    <form action="" method="post" name="calc" class="calculator">


            <br>
            
            <br>
            <input type="hidden" name="result" id="resultField">
            <input type="text" class="value" name="input" id="inputField" readonly>
            <span class="btn clear" onclick="calc.input.value=''"><i>C</i></span>
            <span class="btn" onclick="calc.input.value+='/'" name="op"><i>/</i></span>
            <span class="btn" onclick="calc.input.value+='*'" name="op"><i>*</i></span>
            <span class="btn" onclick="calc.input.value+='7'" name="num"><i>7</i></span>
            <span class="btn" onclick="calc.input.value+='8'" name="num"><i>8</i></span>
            <span class="btn" onclick="calc.input.value+='9'" name="num"><i>9</i></span>
            <span class="btn" onclick="calc.input.value+='-'" name="op"><i>-</i></span>
            <span class="btn" onclick="calc.input.value+='4'" name="num"><i>4</i></span>
            <span class="btn" onclick="calc.input.value+='5'" name="num"><i>5</i></span>
            <span class="btn" onclick="calc.input.value+='6'" name="num"><i>6</i></span>
            <span class="btn plus" onclick="calc.input.value+='+'" name="op"><i>+</i></span>
            <span class="btn" onclick="calc.input.value+='1'" name="num"><i>1</i></span>
            <span class="btn" onclick="calc.input.value+='2'" name="num"><i>2</i></span>
            <span class="btn" onclick="calc.input.value+='3'" name="num"><i>3</i></span>
            <span class="btn" onclick="calc.input.value+='0'" name="num"><i>0</i></span>
        

            <span class="btn equal" onclick="calculateResult()"><i>=</i></span>

        
            </form>
    </div>
    
</body>
</html>

<script>
function calculateResult() {
    // Calcu result
    var result = eval(calc.input.value);

    // Set the result in the visible input field
    document.getElementById('inputField').value = result;

    // Set the result in the hidden input field for form submission
    document.getElementById('resultField').value = result;
    
    // submit the form data
    var formData = new FormData(document.forms['calc']);
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            
            console.log(xhr.responseText);
        }
    };

    xhr.open("POST", window.location.href, true);
    xhr.send(formData);
}

document.forms['calc'].addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the refresh pag nag submit
    calculateResult(); // Calculate and submit the result
});
</script>





