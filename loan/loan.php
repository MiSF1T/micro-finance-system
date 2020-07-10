<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Loan</title>
 
    <link href="styles/style.css?v=<?php echo time(); ?>" rel="stylesheet"> 
  </head>

  <body>
    <!-- NAVIGATION BAR---------------------------->
    <!--<div class="topnav">
        <a href="#logout">Logout</a>
        <a class="active" href="#loan">Loan</a>
        <a href="#term-dep">Term Deposit</a>
        <a href="#transactions">Transaction</a>
        <a href="#home">Home</a>
    </div>-->
    <div class="menu_bar">
            <ul>
                <li><a href="#">Home</a></li>
               <li><a href="#">Transaction</a>
                    <div class="sub_menu">
                        <ul>
                            <li><a href="#">Create</a></li>
                            <li><a href="#">View</a></li>
                        </ul>
                    </div>
               </li>
               <li><a href="#">Term Deposit</a></li>
               <li class="active"><a href="#">Loan</a></li>
               <li><a href="http://localhost/roll13/oms/login.html">Logout</a></li>
               <li><a href="#">About Us</a></li>
             </ul>
    </div>
    <!---------------------------------------------->

    <!-- Container for rest of body elements-------->
    <div class="super-container">
        <!--Intro Image and desc-------------------->
        <div class="intro">
            <img src="images/loan3.jpg" alt="Loan Description">
            <h1 class="img-head">LOAN</h1>
            <p class="information">You can request for loan by specifying amount, annual income
                and the number of installments. Previous loans must be cleared to avail new loan.
                You also have to be a member for at least a year to avail loan services.
                Currently active loan information is displayed, if any.
            </p>
        </div>
        <!------------------------------------------>

        <!--Create TD block------------------------->
        <div class="block1">
            <h1 class="A">Create Loan</h1>
        </div>
        <!------------------------------------------>

        <!--Container for Input field and labels---->
        <div class="flex-container2">
            <div class="amount">
                <label for="amount" class="label-field">Amount</label>
                <input type="number" class="input-field" name="amount" id="amount"> 
            </div>
            <div class="ann">
                <label for="ann" class="label-field">Annual Income</label>
                <input type="number" class="input-field" name="ann" id="ann"> 
            </div>
            <div class="installment">
                <label for="installment" class="label-field">Installments</label>
                    <select name="slct1" class="slct1" id="slct1">
                      <option selected disabled>---</option>
                      <option value="6">6</option>
                      <option value="12">12</option>
                      <option value="24">24</option>
                    </select>
            </div>
        </div>
        <!------------------------------------------->

        <!--Container for buttons-------------------->
        <div class="flex-container3">
            <button type="button" name="info" id="info" class="button button1">VIEW INSTALLMENTS</button>
            <button type="button" name="create" class="button button2" onclick="location.href='create_loan.php?amount='+ document.getElementById('amount').value+'&ann='+ document.getElementById('ann').value+'&slct1='+ document.getElementById('slct1').value;">
            SUBMIT FOR REVIEW</a></button>
        </div>
        <!-------------------------------------------> 
        
        <!--View TD block---------------------------->
        <div class="block2">
            <h1 class="B">Active Loan</h1>
        </div>
        <!------------------------------------------->
       
        <!--Active Loan------------------------------>
        <form class="output-group">
            <div class="flex-container4 ">
                <div class="display">
                    <label  class="label-field">Loan ID
                        <input type="number" id="loan-id" class="display-field" disabled>
                    </label>
                </div>
                <div class="display">
                    <label  class="label-field">Amount
                        <input type="number" id="amount" class="display-field" disabled>
                    </label>
                </div>
                <div class="display">
                    <label  class="label-field">Installments
                        <input type="number" id="inst" class="display-field" disabled>
                    </label>
                </div>
                <div class="display">
                    <label  class="label-field">Creation Date
                        <input type="date" id="creation-date" class="display-field" disabled>
                    </label>
                </div>
            </div>
            <button type="button" name="info" id="info" class="button button2">REPAY LOAN AT ONCE</button>
        </form>
        <!--Bottom border block-->
        <div class="block3"></div>
    </div> 

    <!-- MODAL OVERLAY ------------------------------>
    <div id="overlay" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h3>Interest Rates</h3>
            </div>
            
            <!--interest rates -->
            <div class="table-wrapper1">
            <table class="fl-table">
                <thead>
                <tr>
                    <th>INSTALLMENTS</th>
                    <th>RATE</th>
                </tr>
                </thead>

                <tbody>
                <?php 
					$pdo = new PDO('mysql:host=localhost;dbname=omfs', 'root', '');

					$sql="select tenure,rate FROM interests where type='loan'";
					$query=$pdo->query($sql);
					foreach($pdo->query($sql) as $row){
						?>
						<tr>
                            <td> <?php echo $row['tenure']; ?> </td>
                            <td> <?php echo $row['rate']; ?></td>
						</tr>
						<?php
					}
				?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <!---------------------------------------------->
    <script src="scripts/main.js"></script>
    </body>
</html>