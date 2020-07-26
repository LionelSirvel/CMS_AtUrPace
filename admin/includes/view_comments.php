
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approved</th>
        <th>Disapproved</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $query="SELECT * FROM comments";  //SQL Query to join Posts & Categories table
    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result))
    {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content']; //Join Query was implemented to display the category_title in the backend table-SEC-14/LEC-118
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        ?>

        <tr>
            <td><?php echo $comment_id; ?></td>
            <td><?php echo $comment_author; ?></td>
            <td><?php echo $comment_content; ?></td>
            <td><?php echo $comment_email; ?></td>
            <td><?php echo $comment_status; ?></td>

            <?php
            $query1 = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $result1 = mysqli_query($connection,$query1);
            while ($row = mysqli_fetch_assoc($result1))
            {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                ?>
                <td><a href="../post.php?p_id=<? echo $post_id;?>"><? echo $post_title;?></a></td>
            <?php
            }
            ?>

            <td><?php echo $comment_date; ?></td>
            <td><a href="comments.php?approve=<?php echo $comment_id;?>">Approve</a></td>
            <td><a href="comments.php?disapprove=<?php echo $comment_id;?>">Disapprove</a></td>
            <td><a href="comments.php?delete=<?php echo $comment_id;?>">Delete</a></td>
        </tr>

    <?php } ?>

    </tbody>
</table>

<!--Logic to Approve the comments from Admin-->
<?php
if (isset($_GET['approve']))
{
    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $the_comment_id";
    $result=mysqli_query($connection,$query);
    header("Location: comments.php");

}
?>
<!--Logic to Disapprove the comments from Admin-->
<?php
if (isset($_GET['disapprove']))
{
    $the_comment_id = $_GET['disapprove'];

    $query = "UPDATE comments SET comment_status = 'Disapproved' WHERE comment_id = $the_comment_id";
    $result=mysqli_query($connection,$query);
    header("Location: comments.php");

}
?>

<!--Logic to delete the comments from Admin-->
<?php
if (isset($_GET['delete']))
{
    $the_comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = $the_comment_id";
    $result=mysqli_query($connection,$query);
    header("Location: comments.php");
}
?>

