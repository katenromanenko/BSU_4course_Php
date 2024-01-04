<!--2.14.. Из n чисел выведите наибольшее число, делящееся на 9.-->
<!DOCTYPE html>
<html>
<body>
<h1>2.14.. Из n чисел выведите наибольшее число, делящееся на 9</h1>

<?php
$n = array(3, 9, 12, 18, 24);

$max = 0;

foreach($n as $num){
  if($num % 9 == 0 && $num > $max){
    $max = $num;
  }
}

echo $max;
?>

</body>
</html>
