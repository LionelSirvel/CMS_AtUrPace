
<?php

    if (isset($_GET['p_id']))
    {
        $p_id = $_GET['p_id'];
    }

    $query="SELECT * FROM posts WHERE post_id = $p_id ";
    $result = mysqli_query($connection, $query);


    while($row = mysqli_fetch_assoc($result))
    {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = "../images/" . $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
    }

    if (isset($_POST['update']))
    {

        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image))
        {
            $query = "SELECT * FROM posts WHERE post_id = $p_id";
            $result = mysqli_query($connection,$query);

            while ($row = mysqli_fetch_assoc($result))
            {
                $post_image = $row['post_image'];
            }

        }

        $query = "UPDATE posts 
                    SET post_title          = '$post_title', 
                        post_category_id    = '$post_category_id',
                        post_date           = now(),
                        post_author         = '$post_author',
                        post_status         = '$post_status',
                        post_tags           = '$post_tags',
                        post_content        = '$post_content',
                        post_image          = '$post_image'
                  WHERE post_id             = $p_id";

        $result = mysqli_query($connection,$query);

        testQuery($result);

        echo "<p class='bg-success'>Post Updated! <a href='../post.php?p_id={$p_id}'>View Post</a></p>";

    }
    ?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
       <select name="post_category" id="">
           <?php
           $query = "SELECT * FROM categories";
           $result = mysqli_query($connection,$query);

           testQuery($result);

           while($row = mysqli_fetch_assoc($result))
           {
               $cat_id = $row['cat_id'];
               $cat_title = $row['cat_title'];

               echo "<option value='{$cat_id}'>$cat_title</option>";
           }
           ?>
       </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value='<? echo $post_status; ?>'><? echo $post_status; ?></option>

            <?php
                if($post_status == 'published')
                {
                    echo "<option value='draft'>Draft</option>";
                }
                else
                {
                    echo "<option value='published'>Publish</option>";
                }

            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img src="../images/<?php echo $post_image; ?>" class="img-responsive" width="200" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Post">
    </div>

</form>



