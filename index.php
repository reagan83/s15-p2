<?php

// words file (created by gatherwords.php)
$words_filename = 'words.txt';


// check first if words dictionary file exists, if not, have user run /gatherwords.php
if (!file_exists($words_filename)) {
    header("Location: /gatherwords.php");
    exit;
}

// map words dictionary to words csv array
$words_csv = array_map('str_getcsv', file($words_filename));

// collapse silly created 2d array (from array_map function) to 1d array
$words_arr = $words_csv[0];


// default form values
$password_num_words = 4;
$password_include_numbers = false;
$password_include_specialchars = false;
$password_include_uppercase = false;

$generated_password = "";

// form processing
if (!empty($_GET)) {
    if (isset($_GET["num_words"])) {

        // extra credit steps, checking for numeric numbers and placing boundaries
        if (is_numeric($_GET["num_words"]) == TRUE) {
            $password_num_words = $_GET["num_words"];
        }

        // lower limit set to 4
        if ($password_num_words < 4) {
            $password_num_words = 4;
        }

        // upper limit set to 20
        if ($password_num_words > 20) {
            $password_num_words = 20;
        }
    }


    if (isset($_GET["include_numbers"])) {
        $password_include_numbers = $_GET["include_numbers"];
    }

    if (isset($_GET["include_specialchars"])) {
        $password_include_specialchars = $_GET["include_specialchars"];
    }

    if (isset($_GET["include_uppercase"])) {
        $password_include_uppercase = $_GET["include_uppercase"];
    }

    // let's generate ourselves a random password!
    $random_password_keys = array_rand($words_arr, $password_num_words);

    $i = 0;

    // generating random special chars influenced by this SO thread:
    // http://stackoverflow.com/questions/19017694/1line-php-random-string-generator
    $special_chars = "!@#$%^&*()-=[];',./<>?:";

    foreach ($random_password_keys as $key) {
        // add a dash between each word
        if (strlen($generated_password) > 0) {
            $generated_password = $generated_password . "-";
        }

        // append word to password string
        $generated_password = $generated_password . $words_arr[$key];

        // append numbers if user has specified
        if ($password_include_numbers == "on") {
            $generated_password = $generated_password . rand(0, 9);
        }

        // include special chars if user has specified
        if ($password_include_specialchars == "on") {
            $generated_password = $generated_password . substr(str_shuffle($special_chars), 0, 1);
        }

        // upper case first letter of password if user has specified
        if ($password_include_uppercase == "on") {
            $generated_password = ucfirst($generated_password);
        }


    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>P2 - Reagan Williams - cscie-s15 portfoilio</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/cover.css" rel="stylesheet">

</head>

<body>

    <div class="site-wrapper">
        <div class="site-wrapper-inner">
            <div class="cover-container">

                <div class="masthead clearfix">
                    <div class="inner">
                        <h4 class="masthead-brand">Reagan Williams</h4>
                        <ul class="nav masthead-nav">
                            <li class="active"><a href="#">Home</a></li>
                        </ul>
                    </div>
                </div>

                <div class="inner cover">
                    <div class="hero-avatar">
                        <span class="avatar--large">
                            <img src="/images/reagan.williams.jpg" class="avatar-image avatar-image--large imagePicker-target" title="Reagan Williams" alt="Reagan Williams">
                        </span>
                    </div>
                    <h1 class="cover-heading">P2: Password Generator</h1>
                    <p class="lead">Generate a random password based on your input below.</p>
                </div>
            </div>
            <div class="container">
                <h1 style="font-size: 60px;">
                    <?php
                        echo ($generated_password != "" ? $generated_password : "");
                    ?>
                </h1>


            <div class="row " style="margin-top: 25px;">
            <div class="col-md-3" style="float: none; margin: 0 auto;" role="main">

                <form method="get" name="pwoptions" role="form">

                    <div class="form-group">
                        <label for="num_words">How many words in password?</label>
                        <input type="text" class="form-control" name="num_words" value="<?php echo $password_num_words; ?>">
                    </div>
                    <div class="checkbox">
                        <label>
                          <input type="checkbox" name="include_numbers" <?php echo $password_include_numbers == "on" ? "checked" : ""; ?> > Include numbers?
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                          <input type="checkbox" name="include_specialchars" <?php echo $password_include_specialchars == "on" ? "checked" : ""; ?> > Include special characters?
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                          <input type="checkbox" name="include_uppercase" <?php echo $password_include_uppercase == "on" ? "checked" : ""; ?> > Upper case first letter of password?
                        </label>
                    </div>

                    <button type="submit" class="btn btn-success">Generate Password!</button>
                </form>
                <br>

                <a href="http://xkcd.com/936/">xkcd password strength</a><br>
                <img src="http://imgs.xkcd.com/comics/password_strength.png" style="width: 100%;" alt="xkcd style passwords">
            </div>
            </div>


                <div class="mastfoot">
                    <div class="inner">
                        <p>Bootstrap template inspired by <a href="https://twitter.com/mdo">@mdo</a>.</p>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  
</body>
</html>