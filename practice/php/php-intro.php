<!DOCTYPE html>
<html>
    <?php
        $i = 0;
        $num = 0;
        $sum = 0;
        $avg = 0;
        while ($i < 9)
        {
           $num = rand(0, 50);
           $odd_or_even = ($num % 2 == 0)?"even":"odd";
           echo $num ." ".$odd_or_even ."<br>";
           
           $sum += $num;
           $i++;
        }
        echo "Sum = ".$sum."<br>";
        $avg = $sum/9;
        echo "Average = ".$avg;
    ?>
</html>