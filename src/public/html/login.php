<!DOCTYPE html>
<html >
    <head>
      <meta charset="UTF-8">
      <title>Fake System - Login</title>
          <link rel="stylesheet" href="src/public/css/style.css">
    </head>

    <body>
      <hgroup>
      <h1>Fake Login System</h1>
      <h3>By José Henrique Felipetto</h3>
        </hgroup>

      <?php
        if (isset($data))
        {
            if( array_key_exists('errors', $data))
            {
                echo "<ul>";
                foreach ($data["errors"] as $error)
                {
                    echo "<li> $error </li>";
                }
                echo "</ul>";
            }

            if(array_key_exists('success', $data))
            {
                echo "<p>" .  $data['success'] . " </p>";
            }
        }
      ?>

    <form action="login" METHOD="post">
      <div class="group">
        <input type="text" name="user" ><span class="highlight"></span><span class="bar"></span>
        <label>User</label>
      </div>
      <div class="group">
        <input type="password" name="password"><span class="highlight"></span><span class="bar"></span>
        <label>Password</label>
      </div>

      <button type="submit" class="button buttonBlue" id="buttonSubmit">Login
        <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
      </button>
      <button type="button" class="button buttonBlue" id="newUser">New User
        <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
      </button>
    </form>
    <footer><a href="http://www.polymer-project.org/" target="_blank"><img src="https://www.polymer-project.org/images/logos/p-logo.svg"></a>
      <!--<p>You Gotta Love <a href="http://www.polymer-project.org/" target="_blank">Google</a></p>-->
    </footer>

     <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
     <script src="src/public/js/index.js"></script>

    </body>
</html>
