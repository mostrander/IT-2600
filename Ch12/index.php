<?php
// Start session management with a persistent cookie
//$lifetime = 60 * 60 * 24 * 14;    // 2 weeks in seconds

//modify session cookie so it expires when user exits browser
//$lifetime = 0;

//modify session cookie so it persists for 3 years
$lifetime = strtotime('+3 year');

session_set_cookie_params($lifetime, '/');
session_start();

//create a variable to hold session id so it can be displayed for testing
$id = session_id();

// Create a cart array if needed
if (empty($_SESSION['cart'])) { $_SESSION['cart'] = array(); }

// Create a table of products
$products = array();
$products['MMS-1754'] = array('name' => 'Flute', 'cost' => '149.50');
$products['MMS-6289'] = array('name' => 'Trumpet', 'cost' => '199.50');
$products['MMS-3408'] = array('name' => 'Clarinet', 'cost' => '299.50');

// Include cart functions
require_once('cart.php');

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'show_add_item';
    }
}

// Add or update cart as needed
switch($action) {
    case 'add':
        $product_key = filter_input(INPUT_POST, 'productkey');
        $item_qty = filter_input(INPUT_POST, 'itemqty');
        add_item($product_key, $item_qty);
        include('cart_view.php');
        break;
    case 'update':
        $new_qty_list = filter_input(INPUT_POST, 'newqty', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        foreach($new_qty_list as $key => $qty) {
            if ($_SESSION['cart12'][$key]['qty'] != $qty) {
                update_item($key, $qty);
            }
        }
        include('cart_view.php');
        break;
    case 'show_cart':
        include('cart_view.php');
        break;
    case 'show_add_item':
        include('add_item_view.php');
        break;
    case 'empty_cart':
        unset($_SESSION['cart12']);
        include('cart_view.php');
        break;
    
    case 'delete_session':
        $_SESSION = array(); //clears session data
        session_destroy(); //erases or destroys the session, cleans up session id
        
        $name = session_name();
        $expire = strtotime('-1 year'); //set cookie expiration time in past
        $params = session_get_cookie_params(); //obtains session parameters
        
        //separate out the individual parameters so you can target the specific cookie to delete
        $path = $params['path'];
        $domain = $params['domain'];
        $secure = $params['secure'];
        $httponly = $params['httponly'];
        
        //using same parameters, set cookie with no id value to erase it
        setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
        
        //set session_id to blank so it doesn't show same one when refreshed.
        $id = '';
        
        //include view, otherwise you will see blank screen!
        include('cart_view.php'); 
        
        break;
}
?>