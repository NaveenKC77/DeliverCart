<?php
require("../includes/common.php");
if (!isset($_SESSION['admin'])) {
  header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Admin Panel</title>
  <?php include "includes/include_bootstrap.php"; ?>
  <?php include "includes/header_style.php"; ?>
  <script type="text/JavaScript">
    const myfunc = (id) => {
        option = document.getElementById(id)
        window.location.href = "supplier_update.php?option="+option.value+"&id="+id
      }
    </script>
  <style>
    
   
    

    body {
        color: #566787;
    background: #f5f5f5;
    font-family: 'Varela Round', sans-serif;
    font-size: 13px;
  }

  /* Modal styles */
 .modal-dialog {
    max-width: 700px;
  }
   .modal-header,  .modal-body, .modal-footer {
    padding: 20px 30px;
  }
   .modal-content {
    border-radius: 3px;
  }
   .modal-footer {
    background: #ecf0f1;
    border-radius: 0 0 3px 3px;
  }
    . .modal-title {
        display: inline-block;
    }
   .form-control {
    border-radius: 2px;
    box-shadow: none;
    border-color: #dddddd;
  }
   textarea.form-control {
    resize: vertical;
  }
   .btn {
    border-radius: 2px;
    min-width: 100px;
  } 
   form label {
    font-weight: normal !important;
  } 


</style>

</head>
<body>
   <?php include "includes/header.php"; ?>
 <?php 
 $ids = $_GET['id'];
                $p_selectquery = "select * from items where id = '$ids'";
                $p_query = mysqli_query($con, $p_selectquery);

               $p_res = mysqli_fetch_array($p_query);

  ?>
    
  <!-- Edit Modal HTML -->
  <div id="editEmployModal" class="">
    <div class="modal-dialog">
      <div class="modal-content">
        <form  method="POST" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Product</h4>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="ename" value="<?php echo $p_res['name']?>" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="text" name="eprice" value="<?php echo $p_res['price']?>" class="form-control">
            </div>
            <div class="form-group">
              <label>Category</label>
               <select class="form-control" value="<?php $p_res['category_id']?>" name="ecat" required>
                <?php 
                $c_selectquery = "select * from category";
                $c_query = mysqli_query($con, $c_selectquery);

                while($c_res = mysqli_fetch_array($c_query)){

                 ?>
                <option value="<?php echo $c_res['id'] ?>" 
                  <?php if($p_res['category_id']==$c_res['id']){
                    echo "selected";
                  }
                ?>
                ><?php echo $c_res['name'] ?></option>
               <?php } ?>
              </select>
            </div>          
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" name="submit" value="Save">
          </div>
        </form>
      </div>
    </div>
  </div>
 
<?php  
if (isset($_POST['submit'])) {
             
            $ename = $_POST['ename'];
            $eprice = $_POST['eprice'];
            $ecat = $_POST['ecat'];

            
           $pupdate = "update items set name='$ename', price='$eprice', category_id='$ecat' where id = '$ids'";
           $updateres = mysqli_query($con, $pupdate);
           if($updateres){
             ?>
              <script type="text/javascript">
                location.replace("all-item.php");
              </script>

              <?php
      
           }else{
            echo "NAHI";
           }
}
 ?>
   <?php include "../includes/footer.php" ?>


</body>
</html>