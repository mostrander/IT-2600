<?php
//set default values
$number1 = 78;
$number2 = -105.33;
$number3 = 0.0049;
$message = 'Enter some numbers and click on the Submit button.';
$error = false;

//process
$action = filter_input(INPUT_POST, 'action');
switch ($action) {
    case 'process_data':
        $number1 = filter_input(INPUT_POST, 'number1');
        $number2 = filter_input(INPUT_POST, 'number2');
        $number3 = filter_input(INPUT_POST, 'number3');

        // make sure the user enters three numbers
        if($number1 == null || empty($number1) || $number2 == null || empty($number2)
                || $number3 == null || empty($number3))
        {
            //reset $message variable to blank
            $message = '';
            
            $error = true;
            if($number1 == null || empty($number1))
            {
                $message .= "Please enter a value for number 1.\n";
            }
            if($number2 == null || empty($number2))
            {
                $message .= "Please enter a value for number 2.\n";
            }
            if($number3 == null || empty($number3))
            {
                $message .= "Please enter a value for number 3.\n";
            }
            
            $message .= "Please enter three numbers.";
        }

        // make sure the numbers are valid
        if(!is_numeric($number1) || !is_numeric($number2) || !is_numeric($number3))
        {
            $error = true;
            
            $message = '';
            $message = " Please only enter numerical data for the numbers.\n"
                    . "Please correct the following values: \n";
            
            if(!is_numeric($number1))
            {
                $message .= "Number 1\n";
            }
            if(!is_numeric($number2))
            {
                $message .= "Number 2\n";
            }
            if(!is_numeric($number3))
            {
                $message .= "Number 3\n";
            }
        }

        // get the ceiling and floor for $number2
        $number2_ceil = ceil($number2);
        $number2_floor = floor($number2);

        // round $number3 to 3 decimal places
        $number3_rounded = round($number3, 3);

        // get the max and min values of all three numbers
        $min = min($number1, $number2, $number3);
        $max = max($number1, $number2, $number3);

        // generate a random integer between 1 and 100
        $random = rand(1, 100);

        // format the message
        if($error == false)
        {
    
            $message =
            "Number 1: $number1\n" .
            "Number 2: $number2\n" .
            "Number 3: $number3\n" .
            "\n" .
            "Number 2 ceiling: $number2_ceil\n" .
            "Number 2 floor: $number2_floor\n" .
            "Number 3 rounded: $number3_rounded\n" .
            "\n" .
            "Min: $min\n" .
            "Max: $max\n" .
            "\n" .
            "Random: $random\n";
        }
        


        break;
}
include 'number_tester.php';
?>