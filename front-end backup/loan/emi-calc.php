<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>EMI Calculator</title>
	<link href="styles/emi-style.css" rel="stylesheet"> 
	<link rel = "icon" href = "images/icon.png" type = "image/x-icon">
</head>

<body>
	<div class="super-container">
		<div class="header">
			<span class="close">&times;</span>
			<h1>EMI Calculator</h1>
		</div>
		<div class=cover>
				<table class="main">
					<col class=w50>
					<col class=w51>
					<tr>
						<td>Loan Amount</td>
						<td><input id="amount" placeholder="₹"></td>
					</tr>
					<tr>
						<td>Installments</td>
						<td>
							<select name="installment" id="installment">
                      		<option selected disabled>---</option>
                        	<?php
	                    		$pdo = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');

                        		$sql="SELECT tenure,rate FROM interests WHERE type='loan'";
                        		$query=$pdo->query($sql);
	                    		foreach ($pdo->query($sql) as $row)//Array or records stored in $row
		                		{
			            			echo "<option value=$row[tenure]>$row[tenure]</option>"; 
		                		}
	                    	?>
                    		</select>
						</td>
					</tr>
					<tr>
						<td>Interest Rate</td>
						<!--<td><input id=rate onchange=emi();></td>-->
						<td><input id=rate value="<?php echo $row['rate']; ?>" disabled></td>
					</tr>						
					<tr>
						<td><button class="button1" type=reset>Reset</button></td>
						<td><button class="button1" type=button onclick='emi()'>Calculate</button></td>
					</tr>
					<tr>
						<td>EMI</td>
						<td><input id="emi1" disabled></td>
					</tr>
					<tr>
						<td>Interest payable</td>
						<td><input id="total_inte" disabled></td>
					</tr>						
					<tr>
						<td>Total payable</td>
						<td><input id="total" disabled></td>
					</tr>
				</table>
		</div>
	</div>

	<script>
	function emi()
	{
		if(document.getElementById('amount').value==null || document.getElementById('amount').value.length==0 || document.getElementById('installment').value==null) 
			{document.getElementById('emi1').value="Data Required.";}
		else 
			{
				var emi='';
				var princ1= document.getElementById('amount').value;
				var term1= document.getElementById('installment').value;
				var intr1=document.getElementById('rate').value / 1200;
				document.getElementById('emi1').value =Math.round(princ1 * intr1 / (1-(Math.pow(1/(1 + intr1), term1)))*100)/100; 
				document.getElementById('total').value= Math.round((document.getElementById('emi1').value * document.getElementById('installment').value)*100)/100;
				document.getElementById('total_inte').value=Math.round((document.getElementById('total').value*1 - document.getElementById('amount').value*1)*100)/100;
			}
	}
	// Widget Code by http://widgetcodes.com/
	</script>

</body>
</html>