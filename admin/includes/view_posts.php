
<?php
if (isset($_POST['checkBoxArray']))
{
    foreach ($_POST['checkBoxArray'] as $checkBoxValue) {

        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options)
        {
            case 'published';
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkBoxValue";
                $result = mysqli_query($connection, $query);
                testQuery($result);
                break;

            case 'draft';
                $query1 = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkBoxValue";
                $result = mysqli_query($connection, $query1);
                testQuery($result);
                break;

            case 'delete';
                $query2 = "DELETE FROM posts WHERE post_id = $checkBoxValue";
                $result = mysqli_query($connection, $query2);
                testQuery($result);
                break;

            case 'clone';
                $query3 = "SELECT * FROM posts WHERE post_id = $checkBoxValue";
                $result = mysqli_query($connection,$query3);

                while($row=mysqli_fetch_assoc($result))
                {
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }

                $query4 = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags,post_status)
                     VALUES ($post_category_id, '$post_title','$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status')";

                $copy_query = mysqli_query($connection,$query4);
                if(!$copy_query)
                {
                  die("QUERY FAILED".mysqli_error($connection));
                }
                break;

        }

    }
}
?>



<form action="" method="post">
<table class="table table-bordered table-hover">
    <div id="bulkOptionContainer" class="col-xs-4" style="padding: 0px">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    </div>

    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>

     <thead>
     <tr>
         <th><input type="checkbox" id="selectAllBoxes"></th>
         <th>Id</th>
         <th>Title</th>
         <th>Author</th>
         <th>Category</th>
         <th>Status</th>
         <th>Image</th>
         <th>Tags</th>
         <th>Comments</th>
         <th>Date</th>
         <th>Views</th>
         <th colspan="3">Operation</th>
     </tr>
     </thead>
     <tbody>

     <?php
     $query="SELECT * FROM posts p JOIN categories c ON p.post_category_id = c.cat_id ORDER BY post_id DESC";  //SQL Query to join Posts & Categories table
     $result = mysqli_query($connection, $query);

     while($row = mysqli_fetch_assoc($result))
     {
         $post_id = $row['post_id'];
         $post_title = $row['post_title'];
         $post_author = $row['post_author'];
         $category_title = $row['cat_title']; //Join Query was implemented to display the category_title in the backend table-SEC-14/LEC-118
         $post_status = $row['post_status'];
         $post_image = "../images/".$row['post_image'];
         $post_tags = $row['post_tags'];
         $post_comment_count = $row['post_comment_count'];
         $post_date = $row['post_date'];
         $post_views = $row['post_views'];
         ?>

         <tr>
             <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<? echo $post_id;?>"></td>
             <td><?php echo $post_id; ?></td>
             <td><?php echo $post_title; ?></td>
             <td><?php echo $post_author; ?></td>
             <td><?php echo $category_title; ?></td>
             <td><?php echo $post_status; ?></td>
             <td><img class="img-responsive" width="100" src=<?php echo $post_image;?> alt="image"></td>
             <td><?php echo $post_tags; ?></td>
             <td><?php echo $post_comment_count; ?></td>
             <td><?php echo $post_date; ?></td>
             <td><a href="posts.php?reset=<?php echo $post_id; ?>"><?php echo $post_views; ?></a></td>
             <td><a href="../post.php?p_id=<?php echo $post_id; ?>">View</a></td>
             <td><a href="posts.php?source=edit_post&p_id=<?php echo $post_id; ?>">Edit</a></td>
             <td><a onclick="javascript: return confirm('Are you sure you want to delete ?');" href="posts.php?delete=<?php echo $post_id; ?>">Delete</a></td>
         </tr>

     <?php } ?>

     </tbody>
 </table>

 <!--Logic to delete the Posts from frontend table-->
 <?php
    if (isset($_GET['delete']))
    {
        $post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = $post_id";
        header("Refresh:0; url=posts.php");
        $result=mysqli_query($connection,$query);

    }

 if (isset($_GET['reset']))
 {
     $post_id = $_GET['reset'];

     $query = "UPDATE posts SET post_views = 0  WHERE post_id = $post_id";
     header("Refresh:0; url=posts.php");
     $result=mysqli_query($connection,$query);

 }
 ?>
