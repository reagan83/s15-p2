<?php

// words file (created by gatherwords.php)
$words_filename = 'words.txt';
$words_csv = array_map('str_getcsv', file($words_filename));

// collapse silly created 2d array (from array_map function) to 1d array
$words_arr = $words_csv[0];

//print_r($csv);
$i = 0;
foreach ($words_arr as $word) {
    print ($word);
    $i = $i + 1;
    if ($i > 5) {
        break;
    }
}

// default form values
$password_num_words = 4;
$password_include_numbers = false;
$password_include_specialchars = false;
$password_include_uppercase = false;

$form_submitted = false;

if (!empty($_GET)) {
    echo "<br>submitted!<br>";
    $form_submitted = true;
}

if ($form_submitted == true) {
    if ($_GET["num_words"] != null) {
        $password_num_words = $_GET["num_words"];
        echo "<br>num words:" . $password_num_words;
    }

    if ($_GET["include_numbers"] != null) {
        $password_include_numbers = $_GET["include_numbers"];
        echo "<br>include_numbers:" . $password_include_numbers;
    }

    if ($_GET["include_specialchars"] != null) {
        $password_include_specialchars = $_GET["include_specialchars"];
        echo "<br>include_specialchars:" . $password_include_specialchars;
    }

    if ($_GET["include_uppercase"] != null) {
        $password_include_uppercase = $_GET["include_uppercase"];
        echo "<br>include_uppercase:" . $password_include_uppercase;
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
                    <h1 class="cover-heading">Password Generator (P2)</h1>
                    <p class="lead"></p>
                </div>
            </div>
            <div class="container">
            <div class="row">
            <div class="col-md-3 col-md-offset-4" role="main">
                <form method="get" name="pwoptions" role="form">

                    <div class="form-group">
                        <label for="num_words">How many words in password?</label>
                        <input type="text" class="form-control" name="num_words" value="4">
                    </div>
                    <div class="checkbox">
                        <label>
                          <input type="checkbox" name="include_numbers"> Include numbers?
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                          <input type="checkbox" name="include_specialchars"> Include special characters?
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                          <input type="checkbox" name="include_uppercase"> Upper case first letter of password?
                        </label>
                    </div>

                    <button type="submit" class="btn btn-success">Generate Password!</button>
                </form>

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