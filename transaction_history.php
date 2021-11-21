<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
      <link rel="stylesheet" href="styles.css">
      <title>Transaction History</title>
</head>
<body style="background-color:#daf0ff;">
<!-- Navigation bar-->
  <header>
    <p class="Logo">Online Banking System</p>
    <input type="checkbox" name="" class="btn1"/>
    <div class="nav_1">
<ol>
  <li><a href="index.php">Home</a></li>
  <li><a href="customer_details.php">Customer Details</a></li>
  <li><a href="#" target="_self">Transfer History</a></li>
  <li><a href="#footer">Contact Us</a></li>
</ol>
    </div>
  </header>
<!--Transaction History-->

	<div class="container">
        <h2 class="text-center pt-4" style="color : #0492C2;">Transfer History</h2>

       <br>
       <div class="table-responsive-sm">
    <table class="table table-hover table-striped table-condensed table-bordered">
        <thead style="color : black;">
            <tr>
                <th class="text-center">S.No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Date & Time</th>
            </tr>
        </thead>
        <tbody>
        <?php

            include 'connection.php';

            $sql ="select * from transaction";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr style="color : black;">
            <td class="py-2"><?php echo $rows['sno']; ?></td>
            <td class="py-2"><?php echo $rows['sender']; ?></td>
            <td class="py-2"><?php echo $rows['receiver']; ?></td>
            <td class="py-2"><?php echo $rows['balance']; ?> </td>
            <td class="py-2"><?php echo $rows['datetime']; ?> </td>

        <?php
            }

        ?>
        </tbody>
    </table>

    </div>
</div>
<!--Footer-->
<div class="foot">
  <div id="footer">
    <div class="footerBox">
      <h3 class="footerBoxHeading">Contact Us</h3>
      <ul>
        <li class="footerContainer">
          <i class="fas fa-envelope"></i><a  href="#"><p class="linkText">bushraghaffar@gmail.com</p>
          </a>
        </li>
        <li class="footerContainer">
          <i class="fas fa-phone-alt"></i><a href="#"><p class="linkText">+923317235690</p>
          </a>
        </li>
      </ul>
    </div>
    <div class="footerBox">
      <h3 class="footerBoxHeading">Follow Us</h3>
     <div class="container_1">
      <div class="icons center">
        <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
      </div>
      <div class="icons center">
        <a href="#"><i class="fab fa-linkedin-in fa-2x"></i></a>
      </div>
      <div class="icons center">
        <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
      </div>
      <div class="icons center">
        <a href="#"><i class="fab fa-github fa-2x"></i></a>
      </div>
     </div>
    </div>
  </div>
  </div>
<!---Contact Us------->
<div id="bottomPane">
  <ul>
    <li class="bottomItems"><a href="#">Privacy Policy</a></li>
    <li class="bottomItems">&copy; 2021 Banking System/Bushra Ghaffar</li>
    <li class="bottomItems"><a href="#">License & Agreement</a></li>
    <li class="bottomItems"><a href="#">About Us</a></li>
  </ul>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
