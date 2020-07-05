<?php
require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $user = [
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "email" => $_POST['email'],
            "age" => $_POST['age'],
            "location" => $_POST['location'],
            "id" => $_POST['id']
        ];



        $sql = "UPDATE users
            SET firstname = :firstname,
              lastname = :lastname,
              email = :email,
              age = :age,
              location = :location
            WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->execute($user);

    } catch (PDOException $error) {
        print $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * FROM users WHERE id = :id";


        $statement = $connection->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetch();

    } catch (PDOException $error) {
        print $sql . "<br>" . $error->getMessage();
    }
} else {
    exit;
}

?>


<?php include 'templates/header.php' ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['firstname']); ?> successfully updated.
<?php endif; ?>


<form method="post">
    <input type="text" for="id" name="id" value="<?php print $result['id'] ?>" readonly>
    <label for="id">ID</label>

    <input type="text" for="firstname" name="firstname" value="<?php print $result['firstname'] ?>">
    <label for="firstname">First Name</label>

    <label for="lastname">Last Name</label>
    <input type="text" for="lastname" name="lastname" value="<?php print $result['lastname'] ?>"
           value="<?php print $result['lastname'] ?>">

    <label for="email">Email</label>
    <input type="text" for="email" name="email" value="<?php print $result['email'] ?>">

    <label for="age">Age</label>
    <input type="text" for="age" name="age" value="<?php print $result['age'] ?>">

    <label for="location">Location</label>
    <input type="text" for="location" name="location" value="<?php print $result['location'] ?>">

    <div>
        <input type="submit" name="submit" value="submit">
    </div>

</form>


<?php include 'templates/footer.php' ?>

