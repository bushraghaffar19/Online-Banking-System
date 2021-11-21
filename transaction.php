<?php
include 'connection.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from customers where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check insufficient balance.
    else if($amount > $sql1['balance'])
    {

        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! This Amount cannot be transferred')";
         echo "</script>";
     }


    else {

                // deducting amount from sender's account
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE customers set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);


                // adding amount to reciever's account
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE customers set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);

                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Amount Transferred Successfully!');
                                     window.location='transaction_history.php';
                           </script>";

                }

                $newbalance= 0;
                $amount =0;
        }

}
?>
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
      <title>Transactions</title>

    <style type="text/css">
		button{
			border:none;
			background: #45b6fe;
		}
	    button:hover{
			background-color:#777E8B;
			transform: scale(1.1);
			color:white;
		}

    </style>
</head>
<body>
<!-- Navigation bar-->
  <header>
    <p class="Logo">Online Banking System</p>
    <input type="checkbox" name="" class="btn1"/>
    <div class="nav_1">
<ol>
  <li><a href="index.php">Home</a></li>
  <li><a href="customer_details.php">Customer Details</a></li>
  <li><a href="transaction_history.php">Transfer History</a></li>
  <li><a href="#footer">Contact Us</a></li>
</ol>
    </div>
  </header>
  <!--Transfer Amount-->
  <div style="background-color:#daf0ff;">
	<div class="container">
        <h2 class="text-center pt-4" style="color : #0492C2;">Money Transaction</h2>
            <?php
                include 'connection.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  customers where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr style="color : black;">
                    <th class="text-center">Account No.</th>
                    <th class="text-center">Account Holder</th>
                    <th class="text-center">Email Address</th>
                    <th class="text-center">Account Balane</th>
                </tr>
                <tr style="color : black;">
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label style="color : black;"><b>Transfer To:</b></label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose account</option>
            <?php
                include 'connection.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM customers where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >

                    <?php echo $rows['name'] ;?> (Balance:
                    <?php echo $rows['balance'] ;?> )

                </option>
            <?php
                }
            ?>
            <div>
        </select>
        <br>
        <br>
            <label style="color : black;"><b>Amount:</b></label>
            <input type="number" class="form-control" name="amount" required>
            <br><br>
                <div class="text-center" >
            <button class="btn mt-3" name="submit" type="submit" id="myBtn" >Transfer Money</button>
            </div>
        </form>
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
        <li class="bottomItems">&copy; 2021 Banking System target=""</li>
        <li class="bottomItems"><a href="#">License & Agreement</a></li>
        <li class="bottomItems"><a href="#">About Us</a></li>
      </ul>
    </div>
        </div>
    </body>
    </html>
