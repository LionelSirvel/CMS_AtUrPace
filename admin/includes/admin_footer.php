</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>


<!--JavaScript to select all checkboxes-->
<script type="text/javascript">
    $(document).ready(function () {

        $('#selectAllBoxes').click(function (event) {

            if (this.checked){
                $('.checkBoxes').each(function () {
                    this.checked=true;
                });
            }
            else
            {
                $('.checkBoxes').each(function () {
                    this.checked=false;
                });
            }
        });
    });
    </script>

</body>

</html>
