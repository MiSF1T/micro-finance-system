<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Term Deposit</title>
 
    <link href="styles/style.css" rel="stylesheet"> 
  </head>

  <body>
    <!-- NAVIGATION BAR---------------------------->
    <div class="topnav">
        <a href="#logout">Logout</a>
        <a href="#loan">Loan</a>
        <a class="active" href="#term-dep">Term Deposit</a>
        <a href="#transactions">Transaction</a>
        <a href="#home">Home</a>
    </div>
    <!---------------------------------------------->

    <!-- Container for rest of body elements-------->
    <div class="super-container">
        <!--Intro Image and desc-------------------->
        <div class="intro">
            <img src="images/term.jpg" alt="Term Deposit Description">
            <h1 class="img-head">TERM DEPOSIT</h1>
            <p class="information">You can create term deposit by specifying amount and tenure.
                Currently active term deposits are displayed in the table.
            </p>
        </div>
        <!------------------------------------------>
        
        <!--Create TD block------------------------->
        <div class="block1">
            <h1 class="A">Create Term Deposit</h1>
        </div>
        <!------------------------------------------>

        <!--Container for Input field and labels---->
        <div class="flex-container2">
            <div class="amount">
                <label for="amount" class="label-field">Amount</label>
                <input type="number" class="input-field" name="amount" id="amount"> 
            </div>
            <div class="tenure">
                <label for="tenure" class="label-field">Tenure</label>
                    <select name="slct1" class="slct1" id="slct1">
                      <option selected disabled>---</option>
                      <option value="1">1 Year</option>
                      <option value="2">2 Years</option>
                      <option value="3">3 Years</option>
                    </select>
            </div>
        </div>
        <!------------------------------------------->

        <!--Container for buttons-------------------->
        <div class="flex-container3">
            <button type="button" name="info" class="button button1">VIEW INTEREST RATES</button>
            <button type="button" name="create" class="button button2">CREATE</button>
        </div>
        <!-------------------------------------------> 

        <!--MODAL POPUP------------------------------>

        <!-------------------------------------------> 

        <!--View TD block---------------------------->
        <div class="block2">
            <h1 class="B">Current Term Deposits</h1>
        </div>
        <!------------------------------------------->
        
        <!--Current TD table ------------------------>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                <tr>
                    <th>TD ID</th>
                    <th>AMOUNT</th>
                    <th>TENURE(years)</th>
                    <th>CREATION DATE</th>
                </tr>
                </thead>

                <tbody>
                <!--<tr>
                    <td>2765</td>
                    <td>20000</td>
                    <td>2</td>
                    <td>20/01/2020</td>
                </tr>
                <tr>
                    <td>6932</td>
                    <td>10000</td>
                    <td>1</td>
                    <td>9/04/2020</td>
                </tr>
                <tr>
                    <td>8239</td>
                    <td>10000</td>
                    <td>1</td>
                    <td>17/05/2020</td>
                </tr> -->
                <?php 
					$pdo = new PDO('mysql:host=localhost;dbname=omfs', 'root', '');

					$sql="select * FROM td";
					$query=$pdo->query($sql);
					foreach($pdo->query($sql) as $row){
						?>
						<tr>
							<td> <?php echo $row['td_id']; ?></td>
                            <td> <?php echo $row['amount']; ?></td>
                            <td> <?php echo $row['tenure']; ?></td>
                            <td> <?php echo $row['creation_date']; ?></td>
						</tr>
						<?php
					}
				?>
                </tbody>
            </table>
        </div>
        <!------------------------------------------->

        <!--Manage TD block------------------------->
        <div class="block1">
            <h1 class="A">Manage Term Deposit</h1>
        </div>  
        <div class="select">
            <label for="slct" class="label-field">Term Deposit to manage</label> 
            <select name="slct" class="slct" id="slct">
              <option selected disabled>Select TD</option>
              <!--<option value="1">2765</option>
              <option value="2">6932</option>
              <option value="3">8239</option>-->

              <?php
	                $pdo = new PDO('mysql:host=localhost;dbname=omfs', 'root', '');

                    $sql="select td_id FROM td";
                    $query=$pdo->query($sql);
	                foreach ($pdo->query($sql) as $row)//Array or records stored in $row
		            {
			            echo "<option value=$row[td_id]>$row[td_id]</option>"; 
		            }
	         ?>
            </select>
          </div>
        <!------------------------------------------>
        <div class="flex-container3">
            <button type="button" name="info" class="button button2">BREAK</button>
            
            <button type="button" name="create" class="button button2">RENEW</button>
        </div>
        <div class="block3"></div>
    </div> 

    <script src="scripts/main.js"></script>
    </body>
  </html>
