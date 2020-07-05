<?php
if (isset($_POST['submit'])) {
    try {
        require 'config.php';
        require 'common.php';
        $connection = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "email" => $_POST['email'],
            "age" => $_POST['age'],
            "location" => $_POST['location'],
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

    } catch (PDOException $error) {
        print $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php include 'templates/header.php' ?>


<?php if (isset($_POST['submit']) && $statement) { ?>
    <?php echo $_POST['firstname']; ?> successfully added.
<?php } ?>

<h1>
    Add a user
</h1>


<form method="post">
    <label for="firstname">First Name</label>
    <input type="text" for="firstname" name="firstname">

    <label for="lastname">Last Name</label>
    <input type="text" for="lastname" name="lastname">

    <label for="email">Email</label>
    <input type="text" for="email" name="email">

    <label for="age">Age</label>
    <input type="text" for="age" name="age">

    <label for="location">Location</label>
    <input type="text" for="location" name="location">

    <div>
        <input type="submit" name="submit" value="submit">

    </div>

</form>


<?php include 'templates/footer.php' ?>

