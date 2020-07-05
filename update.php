<?php

/**
 * List all users with a link to edit
 */

try {
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM users";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>


<?php require "templates/header.php"; ?>

<h2>Update users</h2>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Age</th>
        <th>Location</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php print escape($row["id"]); ?></td>
            <td><?php print escape($row["firstname"]); ?></td>
            <td><?php print escape($row["lastname"]); ?></td>
            <td><?php print escape($row["email"]); ?></td>
            <td><?php print escape($row["age"]); ?></td>
            <td><?php print escape($row["location"]); ?></td>
            <td><?php print escape($row["date"]); ?></td>
            <td><a href="update-single.php?id=<?php print escape($row["id"])?>">Edit User</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>


<?php include 'templates/footer.php'; ?>



