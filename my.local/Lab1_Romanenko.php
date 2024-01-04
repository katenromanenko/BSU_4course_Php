<html>

	<body>
	<h1>1.16. Дана целочисленная матрица Аm,n,</h1>
	<h1>строки которой упорядочены по воз¬растанию (ai,1≤ai,2≤...≤ai,n для i=1,…,m)</h1>
	<h1>Найдите и выведите числа, которые встречаются во всех строках.</h1>

		<?php
			$myMatrix = [[1, 3, 4, 6], [4, 6, 10, 14], [-1, 4, 5, 6], [2, 4, 6, 10]];
			echo "<b>Матрица</b>: <br>";
			foreach ($myMatrix as $v)
			{
				foreach ($v as $x)
					echo "$x ";
				echo "<br>";
			}
			
			$w = count($myMatrix[0]);
			$h = count($myMatrix);
			
			for ($i = 0; $i < $w; $i++)
				$cnts[$i] = 1;
			
			for ($i = 0; $i < $w; $i++)
			{
				$x = $myMatrix[0][$i];
				for ($j = 1; $j < $h; $j++)
				{
					for ($k = 0; $k < $w; $k++)
					{
						if ($myMatrix[$j][$k] == $x)
							$cnts[$i]++;
						if ($myMatrix[$j][$k] > $x)
							break;
					}
				}
			}
			
			for ($i = 0; $i < $w; $i++)
			{
				if ($cnts[$i] == $h)
					$res[] = $myMatrix[0][$i];
			}
			
			print_r($res);
		?>
	</body>
</html>