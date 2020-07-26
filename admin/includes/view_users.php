
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
        <th colspan="2">Change User Role</th>
        <th colspan="2">Operations</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $query="SELECT * FROM users";  //SQL Query to display all Users
    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result))
    {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        ?>

        <tr>
            <td><?php echo $user_id; ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $user_firstname; ?></td>
            <td><?php echo $user_lastname; ?></td>
            <td><?php echo $user_email; ?></td>
            <td><?php echo $user_role; ?></td>
            <td><a href="users.php?change_to_admin=<?php echo $user_id;?>">Admin</a></td>
            <td><a href="users.php?change_to_sub=<?php echo $user_id;?>">Subscriber</a></td>
            <td><a href="users.php?source=edit_user&edit_user=<?php echo $user_id;?>">Edit</a></td>
            <td><a href="users.php?delete=<?php echo $user_id;?>">Delete</a></td>
        </tr>

    <?php } ?>

    </tbody>
</table>

<!--Logic to Approve the comments from Admin-->
<?php
if (isset($_GET['change_to_admin']))
{
    $the_user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
    $result=mysqli_query($connection,$query);
    header("Location: users.php");

}
?>
<!--Logic to Disapprove the comments from Admin-->
<?php
if (isset($_GET['change_to_sub']))
{
    $the_user_id = $_GET['change_to_sub'];

    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
    $result=mysqli_query($connection,$query);
    header("Location: users.php");

}
?>

<!--Logic to delete the comments from Admin-->
<?php
if (isset($_GET['delete']))
{
    $the_user_id = $_GET['delete'];

    $query = "DELETE FROM users WHERE user_id = $the_user_id";
    $result=mysqli_query($connection,$query);
    header("Location: users.php");
}
?>


