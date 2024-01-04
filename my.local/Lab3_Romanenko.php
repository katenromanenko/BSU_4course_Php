<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2-lab</title>
</head>
<body>
<h1>3.10. В заданном тексте найдите самое длинное слово и самую длинную фразу.</h1>
<h4>раз четыре шестьдесят сорок пользователь он автомобиль номер</h4>
<?php
$text = 'раз четыре шестьдесят сорок пользователь он автомобиль номер';
$arr = explode(" ", $text);
$max = $arr[0];
for ($i=0; $i<count($arr); $i++) {
    if(strlen($arr[$i]) > strlen($max)){
        $max = $arr[$i];
      }
    }
echo $max;
?>
</body>
</html>

