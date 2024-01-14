<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="thankyou.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
 <br> <br> </br> <a href="pagedonation.html" class="button"> Back ⭯ </a> </br></form> 
    <div class="center">
       
    
        <div class="content">
            <div class="header">
                <h2>Thank You</h2>
                
            </div>
           
            <img src="valide.jpg" alt="Validation Image" class="validation-image">
            <br> <br> </br> <br> <br> </br> <br> <br> </br> 
            <p> thank you for your generosity ! </p>
                <?php
                    if (isset($_GET['donation_type'])) {
                        $donationType = $_GET['donation_type'];

                        switch ($donationType) {
                            case 'blood':
                                echo "Your blood donation has been received.";
                                break;
                            case 'money':
                                echo "Your monetary donation has been received.";
                                break;
                            case 'clothes':
                                echo "Your clothing donation has been received.";
                                break;
                            default:
                                echo "Your donation has been received.";
                                break;
                        }
                    }
                ?>
            
            <div class="line"></div>
      
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Thank You. All rights reserved.</p>
    </footer>
</body>
</html>
