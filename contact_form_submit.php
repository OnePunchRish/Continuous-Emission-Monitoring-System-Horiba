<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $city = htmlspecialchars($_POST['city']);
    $company = htmlspecialchars($_POST['company']);
    $referrer_url = htmlspecialchars($_POST['referrer_url']); // Get referrer URL
    
    /*capture utm details*/
    $utm_source = htmlspecialchars($_POST['utm_source']);
    $utm_medium = htmlspecialchars($_POST['utm_medium']);
    $utm_campaign = htmlspecialchars($_POST['utm_campaign']);
    $utm_term = htmlspecialchars($_POST['utm_term']);
    /*capture utm details END*/
    
    // Echo the referrer URL to check if it's correct
    /*echo "Referrer URL: " . $referrer_url; 
    exit;*/ // Stop further execution to check the referrer URL

    // Validate form data (basic example)
    if (empty($fname) || empty($lname) || empty($phone) || empty($email) || empty($city) || empty($company)) {
        // Redirect to an error page or show a message
        echo "Fill all fields!";
        exit;
    }
    
    // Parse the referrer URL
    $parsedUrl = parse_url($referrer_url); // Parse URL
    $path = isset($parsedUrl['path']) ? $parsedUrl['path'] : ''; // Get the path
    $pathParts = explode('/', trim($path, '/')); // Split the path into parts

    // Debug: Output the parts of the path
    /*echo "<pre>";
    print_r($pathParts); // Output the parts of the URL path
    echo "</pre>";*/

    // Extract group_field and product_name (corrected indices)
    $group_field = isset($pathParts[2]) ? $pathParts[2] : null; // 'ms'
    $product_name = isset($pathParts[3]) ? $pathParts[3] : null; // 'xrf-analyzers'

    // Debug: Output the extracted values
    /*echo "Group Field: " . $group_field . "<br>";
    echo "Product Name: " . $product_name . "<br>";*/


    // Database credentials
    $servername = "localhost"; // Typically "localhost"
    $username = "horibai_ppc_campaign"; // Replace with your database username
    $password = "hinppc@234$"; // Replace with your database password
    $dbname = "horibai_ppc_campaign"; // Replace with your database name

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $created_at = date('Y-m-d'); // Store the date in a variable
    $product_name = 'xrf-analyzers'; // Store the product name in a variable


    // Prepare SQL statement to insert data
    $stmt = $conn->prepare("INSERT INTO mfc_query_details (fname,lname,phone,email,city,company,group_field,product_name,utm_source,utm_medium,utm_campaign,utm_term,created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssssss", $fname, $lname, $phone, $email,$city,$company,$group_field,$product_name,$utm_source,$utm_medium,$utm_campaign,$utm_term,$created_at);
    
    /*if ($stmt->execute()) {
        // Send an email to the user
        $to_email = $email;
        $subject = "Thank you for contacting us!";
        $email_message = "Dear $name,\n\nThank you for reaching out! We have received your message and will get back to you soon.\n\nBest regards,\nHORIBA India Private Limited";
        $headers = 'From: noreply@horibaindia.com';
        mail($to_email,$subject,$message,$headers);  
      }*/
    
    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect to the success page
        header("Location: thankyou.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
