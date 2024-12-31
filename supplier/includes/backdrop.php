<script type="text/JavaScript">
    function myfunction(){
        var modal = document.getElementById("modal");
        var overlay = document.getElementById("overlay");
        modal.style.visibility = "hidden";
        overlay.style.visibility = "hidden";
    }
</script>
<div class="overlay" id="overlay" onclick="myfunction()"></div>
<div class="mymodal" id="modal">
    <h3>Are you sure that you want to delete your account?</h3>
    <center><a href="delete_account.php" class="btn btn-danger">Yes</a>
    <button class="btn btn-success" onclick="myfunction()">No</button>
</center>
</div>