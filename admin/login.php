


<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

.container{
    min-height: 100vh;
    background: #08071d;
    display: flex;
    justify-content: center;
    align-items: center;
    background: url("im4.jpg") no-repeat center center/cover;
    background-size: 50cm;
}

.container form{
    width: 400px;
    height: 550px;
    display: flex;
    justify-content: center;
    box-shadow: 20px 20px 50px rgba(0,0,0,0.5);
    border-radius: 15px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    flex-wrap: wrap;
}

.container form h1{
    color: #fff;
    font-weight: 500;
    margin-top: 20px;
    width: 500px;
    text-align: center;
}

.container form input{
    width: 290px;
    color:#fff;
    height: 40px;
    padding-left: 10px;
    outline: none;
    border: none;
    font-size: 15px;
    margin-bottom: 10px;
    background: none;
    border-bottom: 2px solid #fff;
}

.container form input::placeholder{
    color: #ddd;
}



.container form h4{
    color: #fff;
    font-weight: 300;
    width: 400px;
    margin-top: 20px;
    text-align: center;
}

.container form textarea{
    background: none;
    border: none;
    border-bottom: 2px solid #fff;
    color: #ffffff;
    font-weight: 200;
    font-size: 15px;
    padding: 10px;
    outline: none;
    min-width: 300px;
    max-width: 300px;
    min-height: 80px;
    max-height: 80px;
}

textarea::-webkit-scrollbar{
    width: 1em;
}

textarea::-webkit-scrollbar-thumb{
    background-color: rgba(194,194,194,0.713);
}

.container form #button{
    border: none;
    
    background: #fff;
    border-radius: 5px;
    margin-top: 20px;
    font-weight: 15px;
    font-size: 15px;
    color: #464343;
    width: 100px;
    padding: 0;
    margin-right: 30px;
    margin-bottom: 30px;
    transition: 0.3s;
    
}

.container form #button:hover{
    opacity: 0.7;
}

.login{
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    margin-top: 25px;
    margin-left: 30px;
    transition: 0.3s;

}
<?php
session_start();
if (!empty($_POST)) {
    $varemail = $_POST['email'];
    $varpassword = $_POST['password'];

    // Connect to the database
    try {
        $db = new PDO('mysql:host=localhost;dbname=association_dons;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // Retrieve user from the database
    $sqlQuery = "SELECT * FROM admine WHERE email = :email AND password = :password";
    $requete = $db->prepare($sqlQuery);
    $requete->bindParam(':email', $varemail);
    $requete->bindParam(':password', $varpassword);
    $requete->execute();

    $admin = $requete->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        $_SESSION['admin_id'] = $admin['id'];
        // User found, redirect to a logged-in page
        header("Location:index.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h1>Login</h1>
    
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
        
            <input type="submit" value="Login" id="button">

           <p><?php echo isset($error) ? $error : ""; ?></p>

        </form>
    </div>
</body>
</html>

