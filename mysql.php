<?php
function add_user($connection, $arg1, $arg2, $arg3) {
    $USERNAME = $arg1;
    $EMAIL = $arg2;
    $PASSWORD = md5($arg3);

    $query = $connection->prepare("INSERT INTO users(username, email, password) VALUES(?, ?, ?)");
    $query->bind_param("sss", $USERNAME, $EMAIL, $PASSWORD);

    if($query->execute()) {
        echo "dodano";
    } else {
        echo "błąd";
    }
}
function show_users($connection) {

    $query = "SELECT * FROM users";
    $result = $connection->query($query);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . "<br>";
            echo "Username: " . $row["username"] . "<br>";
            echo "<hr>";
        }
    }

}
    $server = "localhost";
    $user = "admin"; // "root"
    $pass = "root";  // ""
    $db = "blogMZ";  // "blog"

    // Utworzenie obiektu połączenia z bazą danych
    $conn = new mysqli($server, $user, $pass, $db);

    if($conn->mysqli_connect_errno) {
        echo "Błąd: " . mysqli_connect_error; 
    }

    // add_user($conn, "test1", "test1@gmail.com", "test1234");
    show_users($conn);




    // Zamknięcie połączenia z bazą danych
    $conn->close();

?>