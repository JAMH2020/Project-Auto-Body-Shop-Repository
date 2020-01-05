<?php
/******************************************************
** autogenerate an invoice number from the database  **
*******************************************************/


//include file to connect to the database
include_once '../../database/connectdb.php';

//include file to check errors in sql statements
include_once '../../database/error_check.php';


function generate_invoice_no($conn){
  
  //prepare and bind sql statement
  $stmt_invoice_no = $conn->prepare("SELECT Invoice_No FROM Invoice
                                   ORDER BY Invoice_Id DESC
                                   LIMIT 1");

  //execute the statement
  $stmt_invoice_no->execute();

  //store the result
  $stmt_invoice_no->store_result();

  //bind the results
  $stmt_invoice_no->bind_result($invoice_noRow);



  //get the full current date
  $date = new DateTime();

  //current year (YYYY)
  $year = $date->format("Y");

  //current month (MM)
  $month = $date->format("m");

  //current day (DD)
  $day = $date->format("d");


  //invoice number
  $invoice_no = "";


  //find the latest invoice number
  if ($stmt_invoice_no->num_rows > 0){ 
    while($stmt_invoice_no->fetch()){
      
      //get the year value from the latest invoice number
      $prev_year = substr($invoice_noRow, 0, 4);
      
      //get the month value from the latest invoice number
      $prev_month = substr($invoice_noRow, 4, 2);
      
      //get the day value from the latet invoice number
      $prev_day = substr($invoice_noRow, 6, 2);
      
      //get the invoice number for the day of the latest invoice number
      $prev_no = (int)(substr($invoice_noRow, 8, 5));
      
      
      
      
      //if there is already an invoice created for the current day
      if ($year == $prev_year && $month == $prev_month && $day == $prev_day){
        //add one to the invoice number of the latest day
        $prev_no++;
        
        //string value of the invoice number
        $prev_no_text = "";
        
        //convert the number to have 5 digits
        if ($prev_no < 10){
          $prev_no_text = sprintf("0000%d", $prev_no);
          
        } else if ($prev_no < 100){
          $prev_no_text = sprintf("000%d", $prev_no);
          
        } else if ($prev_no < 1000) {
          $prev_no_text = sprintf("00%d", $prev_no);
          
        } else if ($prev_no < 10000){
          $prev_no_text = sprintf("0%d", $prev_no);
         
        } else if ($prev_no < 100000){
          $prev_no_text = sprintf("%d", $prev_no);
        }
        
        
        //generate the invoice number (YYYYMMDDNNNNN)
        $invoice_no = $year . $month . $day . $prev_no_text;
      
      //if it is the first order of the day
      } else {
        $invoice_no = $year . $month . $day . "00001";
      }
    }
  
  //if there are no invoices in the database
  } else {
    //generate an invoice number (YYYYMMDDNNNNN)
    $invoice_no = $year . $month . $day . "00001";
  }




  //close the statment
  $stmt_invoice_no->close();


  return $invoice_no;

}
