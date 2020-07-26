<?php

function users_online()
{
    global $connection;
    $session = session_id();
    $time = time();
    $time_out_in_seconds = 30;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM users_online WHERE session1 = '$session' ";
    $send_query = mysqli_query($connection,$query);
    $count = mysqli_num_rows($send_query);

    if ($count == NULL)
    {
        mysqli_query($connection,"INSERT INTO users_online (session1, time1) VALUES ('$session','$time') ");
    }
    else
    {
        mysqli_query($connection,"UPDATE users_online SET time1 = '$time' WHERE session1 = '$session'");
    }

    $users_online_query = mysqli_query($connection,"SELECT * FROM users_online WHERE time1 > '$time_out'");
    return $count_user = mysqli_num_rows($users_online_query);
}

function testQuery($result)
{
    global $connection;

    if(!$result)
    {
        die("QUERY FAILED".mysqli_error($connection));
    }

}


// <!------ CRUD Operations --------!>

function insert_categories()
{
    global $connection;

    if (isset($_POST['submit']))
    {
        $cat_title = $_POST['cat_title'];

        if (empty($cat_title))
        {
            echo "This field should not be empty.";
        }
        else
        {
            $query = "INSERT into categories (cat_title) VALUE('$cat_title')";
            $result = mysqli_query($connection,$query);

            if (!$result)
            {
                die('Insert Query Failed'.mysqli_error($connection));
            }
        }
    }
}

function findAllCategories()
{
    global $connection;

    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($result))
    {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
        echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td>";
        echo "</tr>";
    }
}

function updateCategories()
{
    global $connection;
    global $up_cat_id;

    if (isset($_GET['edit']))
    {
        $cat_id= $_GET['edit'];

        if (isset($_GET['edit']))
        {
            $cat_id  = $_GET['edit'];

            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $result = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($result))
            {
                $up_cat_id = $row['cat_id'];
                $up_cat_title = $row['cat_title'];
                ?>

                <input value="<?php if (isset($up_cat_title)) {echo $up_cat_title;} ?>" type="text" class="form-control" name="cat_title">

                <?php
            }
        }
        ?>

        <?php
        if (isset($_POST['update']))
        {
            $cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title='$cat_title' WHERE cat_id='$cat_id'";

            $result = mysqli_query($connection,$query);
            if (!$result)
            {
                die('Update Query Failed'.mysqli_error($connection));
            }
        }
    }
}


function deleteCategories()
{
    global $connection;

    if (isset($_GET['delete']))
    {
        $id=$_GET['delete'];
        $query = "DELETE from categories where cat_id=$id";
        $result=mysqli_query($connection,$query);
        header("Location: categories.php");  // Command to refresh the page after delete operation
        if (!$result)
        {
            die('Delete Query Failed'.mysqli_error($connection));
        }
    }
}





