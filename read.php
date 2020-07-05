<?php

if (isset($_POST['submit'])) {
    try {
        require "config.php";
        require "common.php";
        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * FROM users WHERE location = :location";

        $location = $_POST['location'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();


    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php include 'templates/header.php' ?>

<form method="post">
    <label for="location">Location</label>
    <input type="text" id="location" name="location">
    <input type="submit" name="submit" value="View Results">
</form>

<?php

if (isset($_POST['submit'])) {
    foreach ($result as $item) {

        ?>

        <h1>
            Firstname: <?php print $item['firstname']; ?>
        </h1>

        <div>
            Lastname: <?php print $item['lastname']; ?>
        </div>

        <div>
            email: <?php print $item['email'];?>
        </div>

        <div>
            Location: <?php print $item['location']; ?>
        </div>

    <?php } ?>
<?php } ?>

<div>
    <a href="index.php">Back to Home</a>

</div>

<?php include 'templates/footer.php' ?>
