</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<!-- Bootstrap Core JavaScript -->
<script src="uielement/bootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="uielement/bootstrap/vendor/metisMenu/metisMenu.min.js"></script>

<script type="text/javascript">
$(function() {
    $('#side-menu').metisMenu();
});
var idleTime = 0;
$(document).ready(function () {
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 5) { // 20 minutes
        window.location.reload();
    }
}
</script>
<style>
.twitter-typeahead {
  width:100%;
}
</style>


</body>

</html>
