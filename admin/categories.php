
<?php include "includes/admin_header.php"?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin!
                            <small>Author</small>
                        </h1>

                        <!-- CREATE - Function to Add New Category -->
                        <?php
                            insert_categories();
                        ?>


                        <div class="col-xs-6">

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class= "btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>


                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Edit Category</label>

                        <!-- UPDATE - Function To update a category -->
                            <?php
                            updateCategories();
                            ?>

                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update" value="Update Category">
                            </div>
                        </form>
                        </div>


                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th colspan="2">Operation</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <!-- READ - Function to Fetch all the Categories -->
                                <?php
                                    findAllCategories();
                                ?>

                                <!-- DELETE - Function to Delete a Category -->
                                <?php
                                    deleteCategories();
                                ?>

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>


        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php"?>
