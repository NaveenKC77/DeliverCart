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
    
    .small-box{
      color: #fff;
      padding: 1rem 1rem 0 1rem;
    }

    .bg__red{
      background-color: #ff3355;
    }
    .bg__blue{
      background-color: #005bff;
    }
    .bg__grey{
      background: #008c8c;
    }
    .bg__violet{
      background: #8f00ff;
    }
    h3, h4{
      font-family: 'poppins';
    }
    thead{
      border-bottom: 2px solid #66666630;
    }
    
  </style>
</head>

<body>
  <?php include "includes/header.php"; ?>
  <div class="container table__div" style="margin-bottom:210.5px">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <?php
      if (isset($_SESSION['error'])) {
        echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
        unset($_SESSION['error']);
      }
      if (isset($_SESSION['success'])) {
        echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
        unset($_SESSION['success']);
      }
      ?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg__red">
            <div class="inner">
              <?php
              $stmt = "Select items.price as price from users_items inner join items on users_items.item_id = items.id where users_items.status='confirmed'";
              $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
              $sum = 0;
              while ($row = mysqli_fetch_array($result)) {
                $sum = $sum + $row["price"];
              }
              function custom_number_format($n, $precision = 3)
              {
                if ($n < 1000000) {
                  // Anything less than a million
                  $n_format = number_format($n);
                } else if ($n < 1000000000) {
                  // Anything less than a billion
                  $n_format = number_format($n / 1000000, $precision) . 'M';
                } else {
                  // At least a billion
                  $n_format = number_format($n / 1000000000, $precision) . 'B';
                }

                return $n_format;
              }

              $n_format = custom_number_format($sum, 2);
              echo "<h3>&#36; " . $n_format . "</h3>";
              ?>
              <p>Total Sales</p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg__blue">
            <div class="inner">
              <?php
              $stmt = "Select * from supplier where status = 'accepted'";
              $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
              $num_rows = mysqli_num_rows($result);


              echo "<h3>" . $num_rows . "</h3>";

              ?>

              <p>Number of supplier</p>
            </div>

          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg__grey">
            <div class="inner">
              <?php
              $stmt = "SELECT *,COUNT(*) AS numrows FROM items";
              $result = mysqli_query($con, $stmt) or die($mysqli_error($con));
              $prow =  mysqli_fetch_array($result);

              echo "<h3>" . $prow['numrows'] . "</h3>";
              ?>

              <p>Number of Products</p>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg__violet">
            <div class="inner">
              <?php
              $stmt = "SELECT *,COUNT(*) AS numrows FROM users";
              $result = mysqli_query($con, $stmt) or die($mysqli_error($con));
              $urow = mysqli_fetch_array($result);
              $num = $urow['numrows'] - 1;
              echo "<h3>" . $num . "</h3>";
              ?>

              <p>Number of Users</p>
            </div>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
      </div>

    </section>
    <!-- right col -->
    <h3> Suppliers with pending approvals </h3>
    <div class="table__div">
      <table class="table table-striped">
        <thead>
          <tr>
            <td>#</td>
            <td>Supplier Name</td>
            <td>Supplier Contact</td>
            <td>Email</td>
            <td>Category</td>
            <td>Status</td>
          </tr>
        </thead>
        <tbody>
        
          <?php
          $stmt = "Select supplier.id as id, supplier.name as name, supplier.contact as contact, supplier.email as email, category.name as cat from supplier inner join category on supplier.cat_id=category.id where status='registered'";
          $result = mysqli_query($con, $stmt) or die(mysqli_error($con));
          $num_rows = mysqli_num_rows($result);
          if ($num_rows) {
            $count = 0;
            while ($row = mysqli_fetch_array($result)) {
              $count += 1;
          ?>
              <tr>
                <td><?= $count ?></td>
                <td><?= $row["name"] ?></td>
                <td><?= $row["contact"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><?= $row["cat"] ?></td>
                <td><select name="option" id="<?= $row["id"] ?>" onchange="myfunc(<?= $row['id'] ?>)">
                    <option value="registered">Applicant</option>
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                  </select></td>
              </tr>
          <?php }
          } else {
            echo "<h4 style='color:red;margin-left: 1rem;'>Currently there are no new requests!</h4>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php include "../includes/footer.php" ?>
</body>

</html>