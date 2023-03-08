<?php
	if(isset($_POST['str']))
	{
	$ch = curl_init();
	$str=$_POST['str'];
	curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	$postdata = array( "model"=> "text-davinci-001",
	  "prompt"=> $str,
	  "temperature"=> 0.4,
	  "max_tokens"=> 1400,
	  "top_p"=> 1,
	  "frequency_penalty"=> 0,
	  "presence_penalty"=> 0);
	$postdata = json_encode($postdata);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); 
	
	$headers = array();
	$headers[] = 'Content-Type: application/json';
	$headers[] = 'Authorization: Bearer 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';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	$result= json_decode($result, true);
	echo $result['choices'] [0] ['text'];
}
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	form {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top:20%;
}

input[type="text"] {
  font-size: 12px;
  padding: 10px;
  border-radius: 20px;
  border: none;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 300px;
  outline: none;
}

button[type="submit"] {
  font-size: 12px;
  padding: 10px 20px;
  border-radius: 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
  background-color: #0056b3;
}

body {
  background-image: linear-gradient(to top, #0099ff, #00ccff);
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
}


	</style>
</head>
<body>
<form method="post">
<label for="field"> </label>
<input type="text" name="str" required>
<br>
<button type="submit">Submit</button>
</form>
</body>
</html>