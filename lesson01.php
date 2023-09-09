<?php


// Program 1 : to Test Weekday in the Week 

// $day = "Sunday";
// if($day == "Sunday" || $day == "Monday"){
//     echo "It's a weekday";
// }else if($day=="Friday"||$day =="Saturday"){
// echo "It's the weekend";

// }else{
//     echo "I'm lazy to write the rest !!";
// }

//Program 2 : array 

// $daysOne = array('Sunday', 'Monday', 'Tuesday');

// print_r($daysOne);
// echo "<br/>";
// unset($daysOne[2]);
// print_r($daysOne);
// echo "<br/>";
// // echo $daysOne[2]; // undefind
// $daysOne[2]= "Tuesday"; //to add it again
// print_r($daysOne);

//Program 3 : function to add numbers 

// $nums = [1,2,3,4,5];
// array_push($nums,6,7,8,12,11,16);

// print_r($nums);


//Program 4 : Associative Array 

// $marks = array(
//     'Arabic'=>90,
//     'English'=>85,
//     'Coding'=>95,
//     'Review'=>95,
// );

// echo $marks["Coding"];

//Program 5 : Array Slicing  انشاء اريه من اريه اخرى
// $first_array= array('item0','item1','item2','item3','item4');
// // print_r($first_array);
// // $second_array = array($first_array[2],$first_array[3]);
// // print_r($second_array);
// //or using array slice function
// $second_array = array_slice($first_array,2,2);
// print_r($second_array);

//Program 6 : sort array 


// $nums = array(1,2,3,4,6,5,44,12);

// sort($nums); //تصاعدي
// rsort($nums);//تنازلي
// print_r($nums);



//Program 7 : Using Explode Function تفجير الاسم الى قطع حسب المطى او تقطيعه الجملة 

// $name = "Mohammed Dabour";
// $namearray = explode(' ',$name);
// print_r($namearray);


//Program 8 : Using Implode Function

// $myarray = Array("I","'m","studing","CS");

// $myarraystring = implode(' ',$myarray);
// print_r($myarraystring);

//Program 9 : For loop

// for ($num = 1; $num <= 1000000000000; $num++) {
//     echo "<br/>";
//     echo "Mohammd Dabour is the best programmer in the world!!!";
// }


// for ($num = 1; $num <= 44; $num=$num+2) {
//     echo $num . "<br/>";
// }

// $num = 1 ;
// while($num <= 40){

//     echo $num . "<br>";
//     $num =  $num + 5;
// }

// $num = 50;

// do{
//     echo $num . "<br>";
//     $num = $num - 5;

// }while ($num >= 40);


// $items = array(
//     'item1' => 'table', 'item2' => 'chair',
//     'item3' => 'table', 'item4' => 'spoon', 'item5' => 'book'
// );

// // foreach ($items as $itemKey => $itemValue) {
// //     echo $itemKey . " ====> " . $itemValue . "<br>";
// // }

// function hello_user($name)
// {
//     echo "Hello " . $name;
// }

// hello_user("Mohammed Dabour");
?>

<?php $page_title = "Add your idea"; ?>
<?php $page_heading = "Share your idea with us";
?>
<?php
$hostname = "localhost";
$database_name = "idea";
$database_user = "mohammed1";
$password = "123"; // Replace with your actual database password

try {
    // Database source name
    $dsn = "mysql:host=$hostname;dbname=$database_name";

    // Create a PDO instance with error handling enabled
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    );

    // Your database connection is now established
    // You can perform database operations here

} catch (PDOException $e) {
    // Handle any database connection errors here
    echo "Database Connection Failed: " . $e->getMessage();
    // You might want to log the error as well
}
?>


<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
</head>

<body>
    <h1><?php echo $page_heading;


        if (isset($_POST['submit'])) :
            if (isset($_POST['title'])) :
                $idea_title = $_POST['title'];
            endif;
            if (isset($_POST['text'])) :
                $idea_text = $_POST['text'];
            endif;
            $connection = new PDO($dsn, $database_user, $password, $options);
        endif;

        $new_idea = array('title' => $idea_title, 'text' => $idea_text);
        $new_idea_keys_string = implode(', ', array_keys($new_idea));
        $new_idea_keys_placeholders = ':' . implode(', : ', array_keys($new_idea));
        // echo $new_idea_keys_string;
        // echo $new_idea_keys_placeholders;

        $sql = sprintf("INSERT INTO ideas (title, text) VALUES (:title, :text)");
        $statement  = $connection->prepare($sql);
        $statement->execute($new_idea);
        echo "<br>";
        echo $sql;
        ?></h1>

    <form method="POST" action="">

        <label for="title">Idea Title</label>
        <input type="text" name="title" placeholder="<?php if (isset($_POST['title'])) {
                                                            echo $_POST['title'];
                                                        } ?>">
        <br>
        <label for="text">Idea Text</label>
        <textarea type="text" row="8" cols="80" name="text" placeholder="<?php if (isset($_POST['text'])) {
                                                                                echo $_POST['text'];
                                                                            } ?>"></textarea>
        <input type="submit" name="submit" value="save your idea">
    </form>


    <?php

    // print_r($_GET);

    $sthTitle = sprintf("My idea title : %s", $idea_title);
    $sthText = sprintf("My idea text : %s", $idea_text);
    if (isset($_POST['title'])) {
        echo $sthTitle . "<br>";
    }
    if (isset($_POST['text'])) {
        echo $sthText;
    }
    // echo  "<br>";
    // echo $new_idea_keys_string;
    // echo  "<br>";
    // echo $new_idea_keys_placeholders;
    ?>


</body>

</html>