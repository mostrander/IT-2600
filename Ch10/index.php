<?php
//set default value
$message = '';

//get value from POST array
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action =  'start_app';
}

//process
switch ($action) {
    case 'start_app':

        // set default invoice date 1 month prior to current date
        $interval = new DateInterval('P1M');
        $default_date = new DateTime();
        $default_date->sub($interval);
        $invoice_date_s = $default_date->format('n/j/Y');

        // set default due date 2 months after current date
        $interval = new DateInterval('P2M');
        $default_date = new DateTime();
        $default_date->add($interval);
        $due_date_s = $default_date->format('n/j/Y');

        $message = 'Enter two dates and click on the Submit button.';
        break;
    case 'process_data':
        $invoice_date_s = filter_input(INPUT_POST, 'invoice_date');
        $due_date_s = filter_input(INPUT_POST, 'due_date');

        // make sure the user enters both dates
        if ($invoice_date_s == null || $invoice_date_s == '')
        {
            $message = 'Please enter an invoice date!';
        }
        if ($due_date_s == null || $due_date_s == '')
        {
            if($message != null)
            {
                $message = $message . " Please enter a due date!";
            }
            else
            {
                $message = 'Please enter a due date!';
            }
            
        }
        
        // convert date strings to DateTime objects
        // and use a try/catch to make sure the dates are valid
        try {
            $invoice_date = new DateTime($invoice_date_s);
            $due_date = new DateTime($due_date_s);
            
        } catch (Exception $ex) {
            $message = "One or both dates are incorrect. Please retry using the "
                    . "Month/Day/Year format.";
        }

        // make sure the due date is after the invoice date
        if ($due_date <= $invoice_date)
        {
            $message = "Due date cannot come before the invoice date! Please check"
                    . " the dates and try again.";
        }
        

        // format both dates
        $invoice_date_f = $invoice_date->format('F j, Y');
        $due_date_f = $due_date->format('F j, Y'); 
        
        // get the current date and time and format it
        $current_date_f = date('F j, Y');
        $current_time_f = date('g:i:s a');
        
        // get the amount of time between the current date and the due date
        // and format the due date message
        $now = new DateTime();
        $due = $now->diff($due_date);
        
        if($due_date > $now)
        {
            $due_date_message = 'This invoice is due in ' .$due->format('%y years, %m months, %d days.');
        }
        else
        {
            $due_date_message = 'This invoice is ' .$due->format('%y years, %m months,'
                    . ' and %d days overdue.');
        }
        
        

        break;
}
include 'date_tester.php';
?>