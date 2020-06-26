<?php
    // get the data from the form
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    // get the rest of the data for the form
    $password = filter_input(INPUT_POST, 'password');
    $phone = filter_input(INPUT_POST, 'phone');
    $contact = filter_input(INPUT_POST, 'contact_via');
    
    $comment = filter_input(INPUT_POST, 'comments');
    
    //sanitize the $comment input
    $comment = htmlspecialchars($comment);
    
    //set $comments to convert line breaks to HTML line breaks
    $comments = nl2br($comment, false);
    
    // for the heard_from radio buttons,
    // display a value of 'Unknown' if the user doesn't select a radio button
    $radio = filter_input(INPUT_POST, 'heard_from');
    if($radio == null)
    {
        $radio = 'Unknown';
    }

    // for the wants_updates check box,
    // display a value of 'Yes' or 'No'
    $check = filter_input(INPUT_POST, 'wants_updates');
    if($check != null)
    {
        $check = 'YES';
    }
    else
    {
        $check = 'NO';
    }
    
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Account Information</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>
    <main>
        <h1>Account Information</h1>

        <label>Email Address:</label>
        <span><?php echo htmlspecialchars($email); ?></span><br>

        <label>Password:</label>
        <span><?php echo htmlspecialchars($password); ?></span><br>

        <label>Phone Number:</label>
        <span><?php echo htmlspecialchars($phone); ?></span><br>

        <label>Heard From:</label>
        <span><?php echo htmlspecialchars($radio); ?></span><br>

        <label>Send Updates:</label>
        <span><?php echo htmlspecialchars($check); ?></span><br>

        <label>Contact Via:</label>
        <span><?php echo htmlspecialchars($contact); ?></span><br><br>

        <span>Comments:</span><br>
        <span><?php echo $comments; ?></span><br>        
    </main>
</body>
</html>