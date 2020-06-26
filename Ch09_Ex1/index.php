<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';
$error = '';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        /*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
        // 2. display the name with only the first letter capitalized
        if(empty($name))
        {
            $message = "Please enter your name!";
        }
        else
        {
            $name = strtolower($name);
            $name = ucwords($name);
            $i = strpos($name, ' ');
            if($i == null)
            {
                $first_name = $name;
            }
            else
            {
                $first_name = substr($name, 0, $i);
            }
            
        }
        
        

        /*************************************************
         * validate and process the email address
         ************************************************/
        // 1. make sure the user enters an email
        // 2. make sure the email address has at least one @ sign and one dot character
        if(empty($email))
        {
            if(empty($name))
            {
                $message = $message . "\nPlease enter your email!";
            }
            else
            {
                $message = "Please enter your email!";
            }
        }
        else
        {
            if(strpos($email, '@') == null || strpos($email, '.') == null)
            {
                $error = 'You must include at least 1 period and @ sign in the '
                        . 'email address!';
                $message = $error;
            }
        }

        /*************************************************
         * validate and process the phone number
         ************************************************/
        // 1. make sure the user enters at least seven digits, not including formatting characters
        // 2. format the phone number like this 123-4567 or this 123-456-7890
        if(empty($phone))
        {
            if(empty($email) || empty($name))
            {
                $message = $message . "\nPlease enter your phone number!";
            }
            else
            {
                $message = "Please enter your phone number!";
            }
        }
        
        else
        {
            //remove any non numerical data before working with phone number
            $phone = str_ireplace('.', '', $phone);
            $phone = str_ireplace('-', '', $phone);
            $phone = str_ireplace('(', '', $phone);
            $phone = str_ireplace(')', '', $phone);
            $phone = str_ireplace(' ', '', $phone);
            
            if (strlen($phone) < 7 || strlen($phone) > 10)
            {
                $error = "There is either too few or too many digits in the phone"
                        . " number you provided! Please try again.";
                $message = $error;
            }
            
            else if(strlen($phone) == 7)
            {
                $first_part = substr($phone, 0, 3);
                $second_part = substr($phone, 3);
                $phone = $first_part . '-' . $second_part;
            }
            else if (strlen($phone) == 10)
            {
                $first_part = substr($phone, 0, 3);
                $second_part = substr($phone, 3, 3);
                $third_part = substr($phone, 6);
                $phone = '(' . $first_part . ')' . ' ' . $second_part . '-' . $third_part;
            }
        }

        /*************************************************
         * Display the validation message
         ************************************************/
        if(!empty($name) && !empty($email) && !empty($phone) && empty($error))
        {
           $message = "Hello $first_name,\n\nThank you for entering this data:\n\n"
            . "Name: $name\nEmail: $email\nPhone: $phone"; 
        }

        break;
}
include 'string_tester.php';
?>