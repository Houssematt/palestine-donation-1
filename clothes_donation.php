
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothes donation</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="clothes1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        /* Define a CSS rule for styling the button */
        .custom-button , .p {
            color:aliceblue; /* Set the text color to red */
             /* Set the background color (optional) */
            padding: 20px 20px; /* Set padding for better appearance (optional) */
            /* Add a border (optional) */
            cursor: pointer; /* Change the cursor on hover (optional) */
            
        }
    </style>
   
</head>
<body >
    <div class="container">
    <header>
        <h1>Clothes donation</h1>
    </header>
        <div class="content">
            <div class="content-form">
                <section>
                    <i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
                    <h2 class="h2">address</h2>
                    <p class="p">
                        Rades,Ben arous 
                    </p>
                </section>

                <section>
                    <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                    <h2 class="h2">Phone</h2>
                    <p class="p">+216 92 82 2437</p>
                </section>

                <section>
                    <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
                    <h2 class="h2">E-mail</h2>
                    <p class="p" >tunisianDonation@gmail.com</p>
                </section>
            </div>
        </div>

      <form action="clothes_donation_process.php" method="post">
           
        <div class="form">
            
              <div class="contact-form">
              <label for="clothing_size">Clothing Size :</label>
            <input type="text" name="taille" id="clothing_size" required>
             
           
    <div class="contact-form">
    <label for="code_zip">Zip code :</label>
            <input type="text" name="zip_code" id="code" required>
            
            <div class="contact-form">
            <label for="message" class="message">Type Your description</label>
            <textarea id="message" name="descr" required></textarea>
            
            </div>
            </div>
   <br>
              <div class="submit">
                  <input type="submit" name="submit" class="custom-button">
              
              </div> <a href="pagedonation.html" class="button"> Back ⭯ </a> </br></form> 
            </div>  
          </div> 
          </div>
          </div>
        <div class="media">
            <li><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></li>
            <li><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></li>
            <li><i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i></li>
            <li><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i></li>
        </div>  
        <div class="empty">

        

   </div>    </div>   
    <footer class="footer">
        <p>&copy; 2023 Page of Donations. All rights reserved.</p>
    </footer> 
    </body>
    </html>
