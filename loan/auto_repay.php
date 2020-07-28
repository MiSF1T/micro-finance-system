<?php
    session_start();

        $db = new PDO("mysql:host=localhost;dbname=omfs","root","");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $querySql = $db->query("SELECT * FROM interests WHERE Type = 'Loan' ");
        $row = $querySql->fetch();
        $r = $row['Rate'];
        
        $query = $db->query("SELECT * FROM loan");

        foreach( $query as $rows ) {
            $n = $rows['Installments'];
            $principal = $rows['Loan_Amount'];
            $id = $rows['Loan_Id'];
            $rate = ($r/12) / 100 ;
            
            $emi = round(( $principal * $rate * pow(( 1 + $rate), $n) / ( pow(( 1 + $rate), $n ) - 1 ) ));

            $sql = $db->query("UPDATE Account SET balance= balance - '" .$emi. "' WHERE account_no= '".$_SESSION["account_no"]."'");
            $sql->execute();
        }  
?>