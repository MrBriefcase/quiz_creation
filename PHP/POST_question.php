<?php
    // setup connection.
    $DBHost = 'localhost';
    $dblogin = 'root';
    $DBpassword = 'root';
    $DBname = 'QuizCreation';

    // passed values.
    $q = $_POST['q'];
    $a1 = $_POST['a1'];
    $a2 = $_POST['a2'];
    $a3 = $_POST['a3'];
    $a4 = $_POST['a4'];
    $answer = $_POST['answer'];

    try {
        $conn = new PDO("mysql:host=$DBHost;dbname=$DBname", $dblogin, $DBpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // insert question and correct answer.
        $sql = "INSERT INTO question (the_question, correct_choice) VALUES ('$q', '$answer');";
        $statement = $conn->prepare($sql);
        $statement->execute();
        
        // select latest ID
        $sql = "SELECT * FROM question ORDER BY ID DESC LIMIT 1;";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $latest = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        // hold this num for later use
        $numholder = $latest[0]['ID'];
        
        // insert potential answers into answer table
        $sql = "INSERT INTO answer (the_answer, q_link, ABCD) VALUES ('$a1', $numholder, 'a');";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $sql = "INSERT INTO answer (the_answer, q_link, ABCD) VALUES ('$a2', $numholder, 'b');";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $sql = "INSERT INTO answer (the_answer, q_link, ABCD) VALUES ('$a3', $numholder, 'c');";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $sql = "INSERT INTO answer (the_answer, q_link, ABCD) VALUES ('$a4', $numholder, 'd');";
        $statement = $conn->prepare($sql);
        $statement->execute();
        
        // SUCCESS!!    
        echo 'success!';
    } catch(PDOException $e) {
        // error handling
        $msg = $e->getMessage();
        echo "failed: $msg";
    }

////     debug
//    $x = "data is: ";
//    foreach($_POST as $data) {
//        $x .= $data . " ";
//    }
//    echo $x;

?>