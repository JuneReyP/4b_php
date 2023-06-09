<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= "SAMPLE PHP"; ?></title>
</head>

<body>
    <h1>Sample</h1>

    <h1>
        <?=
        "THis is from my PHP script";
        ?>
    </h1>

    <h3>
        <?=
        "THis is from my PHP script";
        ?>
    </h3>

    <?php
    //asdadadasdasd
    #sdfsdfsdf
    /*
    asdasd
    asdasd
    asdad
    */

    $s23 = 2;
    $sample = "juan";
    $age = 1;
    $Age = 2;
    $AgE = 2;
    $x = 10.09;
    var_dump($sample);

    function myFunction(){
        global $age;
        static $b = 0;
        //local scope
        //echo $age;
        echo $b;
        $b++;
    }

    // myFunction(); //return 0
    // myFunction(); //return 1

    echo '<h1>'.$sample.'</h1>';

    //indexed array
    $cars = array("Volvo","BMW","Toyota");
    //$cars2 = ["Volvo","BMW","Toyota"];
    //multi-dimensional array
    $ingredients = array(
        array("orange", "banana", "apple"), //0
        array("carrots", "cabage", "squash"), //1
        array("pork", "beef", "chicken") //2
    );
    $ingredients[0][1];

    for($a = 0; $a < 3; $a++){
        echo $cars[$a]."<br>";
    }
    echo "<hr>";

    for($col = 0; $col < 3; $col++){
        for($rows = 0; $rows < 3; $rows++){
            echo $ingredients[$col][$rows]."<br>";
        }
        echo "<br>";
    }
    $ingredients[0][0];
    $ingredients[0][1];
    $ingredients[0][2];

    $ingredients[1][0];
    $ingredients[1][1];
    $ingredients[1][2];

    $ingredients[2][0];

    //associative array
    $age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
    $age['Peter'];

    foreach($age as $key){
        echo $key." ".$value."<br>";
    }
    ?>
</body>

</html>