<!-- Header -->
<?php include "includes/header.php"?>
<!-- Navigation -->
<?php include "includes/navigation.php"?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if(isset($_GET['p_id']))
            {
                $post_id = $_GET['p_id'];

            $view_query = "UPDATE posts SET post_views = post_views+1 WHERE post_id = $post_id";
            $send_query = mysqli_query($connection,$view_query);

            if(!$send_query)
            {
                die("QUERY FAILED");
            }

            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                ?>
                <h1 class="page-header">
                    At Your Pace
                    <small>Learn something new everyday!</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" src="images/<?echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>
                <hr>

                <?php
            }

            }
            else
            {
                header("Location: index.php");
            }
            ?>

            <!-- Blog Comments -->
            <?php
                if (isset($_POST['create_comment']))
                {
                    $post_id = $_GET['p_id'];  // Fetching the post_id from the URL using GET super global variable
                    $comment_author = $_POST['comment_author'];  //Fetching the author, email & content when below form is submitted
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content))
                    {
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content,comment_status, comment_date)
                          VALUES($post_id,'$comment_author','$comment_email','$comment_content','Disapproved',now())";

                        $result = mysqli_query($connection, $query);

                        if (!$result)
                        {
                            die('QUERY FAILED' . mysqli_error($connection));
                        }

                        $query1 = "UPDATE posts 
                               SET post_comment_count = post_comment_count + 1
                               WHERE post_id = $post_id";

                        $result1 = mysqli_query($connection, $query1);

                        header("Location: admin/comments.php");
                    }
                    else
                    {
                       echo "<script>alert('Fields cannot be empty')</script>";
                    }


                }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
<!--                        <div class="input-group">-->
<!--                          <span class="input-group-addon">-->
<!--                            <i class="fas fa-users"></i>-->
<!--                          </span>-->
                        <input type="text" class="form-control" placeholder="Author" name="comment_author">
<!--                        </div>-->
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="comment_email">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="comment_content" placeholder="Leave your comment"  rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Logic to display Comments in the Post -->

            <?php
                $query = "SELECT * 
                          FROM comments 
                          WHERE comment_post_id = $post_id
                          AND comment_status = 'Approved'
                          ORDER BY comment_id DESC";

                $result = mysqli_query($connection,$query);
                if(!$result)
                {
                    die('Query Failed'.mysqli_error($connection));
                }
                while($row = mysqli_fetch_assoc($result))
                {
                    $comment_date  = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
             ?>

                    <!-- Logic to display Comments in the Post  -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author;?>
                                <small><?php echo $comment_date;?></small>
                            </h4>
                            <?php echo $comment_content;?>
                        </div>
                    </div>

             <?php
                }
                ?>



        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php"?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"?>

