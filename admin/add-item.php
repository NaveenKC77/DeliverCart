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
 
    
  <!-- Edit Modal HTML -->
  <div id="addEmployeeModal" class="">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" enctype="multipart/form-data">
          <div class="modal-header">            
            <h4 class="modal-title">Add Product</h4>

          </div>
          <div class="modal-body">          
            <div class="form-group">
              
              <label>Name</label>
              <input type="text" class="form-control" name="pname" required>
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="text" class="form-control" name="pprice" required>
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" name="pimg" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Slug</label>
              <input type="text" name="slug" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="pcat" required>
                <?php 
                $c_selectquery = "select * from category";
                $c_query = mysqli_query($con, $c_selectquery);

                while($c_res = mysqli_fetch_array($c_query)){

                 ?>
                <option value="<?php echo $c_res['id'] ?>"><?php echo $c_res['name'] ?></option>
               <?php } ?>
              </select>
            </div>          
          </div>
          <div class="modal-footer">
            
            <input type="submit" class="btn btn-success" name="submit" value="Add">
          </div>
        </form>

        <?php 
         if (isset($_POST['submit'])) {
             
              $pname = $_POST['pname'];
              $pprice = $_POST['pprice'];
              $pcat = $_POST['pcat'];
              $img = $_FILES['pimg'];
              $slug = $_POST['slug'];
              $p_filename = $img['name'];
            $p_filepath = $img['tmp_name'];
            $p_fileerror = $img['error'];
            if($p_fileerror ==0){ 

            $p_destfile = '../upload/'.$p_filename;
            $rdestfile = './upload/'.$p_filename;
  

           move_uploaded_file($p_filepath,  $p_destfile);
              
            $insertquery = "insert into items(name, price, category_id, photo, slug) values('$pname', '$pprice', '$pcat', '$rdestfile', '$slug')";
            $iquery = mysqli_query($con, $insertquery) or die(mysqli_error($con));
            if ($iquery) {
              ?>
              <script type="text/javascript">
                location.replace("all-item.php");
              </script>

              <?php
              
            }else{
              
            }

}
}
         ?>
      </div>
    </div>
  </div>
 

   <?php include "../includes/footer.php" ?>


</body>
</html>