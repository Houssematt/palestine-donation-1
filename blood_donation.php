
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="blood.css">
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
<body style="background-image:blood.jpg">
    <div class="container">
    <header>
        <h1>Blood donation</h1>
    </header>
        <div class="content">
            <div class="content-form">
                <section>
                    <i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
                    <h2 class="h2">address</h2>
                    <p class="p">
                        Rades ,Ben Arous 
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

      <form action="process_blood_donation.php" method="post">
        <div class="form">
           
              <div class="contact-form">
              <label for="date_visite_medicale">Choisir une Date de visite medicale :</label>
            <input type="date" name="date_visite_medicale" id="date_visite_medicale" required class="date">
              
              <div class="contact-form">
              <label>Type of Your Blood:</label>
            <div >
            <select name="blood_type" id="blood_type" required class="option">
            <option value="" disabled selected>Type of Your Blood</option>
                <option value="A">A+</option>
                <option value="B">B+</option>
                <option value="AB">AB+</option>
                <option value="O">O+</option>
                <option value="A">A-</option>
                <option value="B">B-</option>
                <option value="AB">AB-</option>
                <option value="O">O-</option>
            </select>
            </select>
           
              </div>
   <br>
              <div class="submit">
                  <input type="submit" name="submit" class="custom-button">
              </div>
              </div><a href="pagedonation.html" class="button"> Back ⭯ </a> </br>
            </div>
          </div>
    </form>
        <div class="media">
            <li><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></li>
            <li><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></li>
            <li><i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i></li>
            <li><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i></li>
        </div>
        <div class="empty">

        </div>
    </div>   
</body>
</html>




 