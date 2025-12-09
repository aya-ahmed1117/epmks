<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .greeting-banner {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .greeting-banner img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .greeting-text {
            position: absolute;
            bottom: 20px;
            left: 30px;
            background-color: rgba(0,0,0,0.6);
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card-body iframe {
            width: 100%;
            border: none;
        }
        .card-header {
            background-color: #f8f9fa;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <?php
    require_once("inc/config.inc");
    $time = date("H");
    $s_username = isset($s_username) ? $s_username : "Guest";
    $greeting = "";
    $image = "";

    if ($time < "12") {
        $greeting = "Good morning";
        $image = "images/good_mornig1.jpg";
    } elseif ($time >= "12" && $time < "17") {
        $greeting = "Good afternoon";
        $image = "images/afternoon_mew.jpg";
    } elseif ($time >= "17" && $time < "19") {
        $greeting = "Good evening";
        $image = "images/eveningNew.jpg";
    } else {
        $greeting = "Good night";
        $image = "images/eveningNew2.jpg";
    }
    ?>

    <div class="greeting-banner">
        <img src="<?php echo $image; ?>" alt="Greeting Image">
        <div class="greeting-text"><?php echo "$greeting, $s_username!"; ?></div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">Prayer Times in Egypt</div>
                <div class="card-body">
                    <iframe src="https://timesprayer.com/widgets.php?frame=2&amp;lang=en&amp;name=egypt&amp;time=0&amp;fcolor=45637d&amp;tcolor=26B5BF&amp;frcolor=fef598" height="250"></iframe>
                </div>
            </div>
        </div>

       <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-header text-center fw-bold">Daily Quote</div>
            <div class="card-body d-flex flex-column justify-content-center align-items-center" style="background: url('images/bg-preview.png') center/cover no-repeat; min-height: 250px;">
                <blockquote class="blockquote text-white text-center bg-dark bg-opacity-50 p-3 rounded" style="max-width: 90%;">
                    <?php
                    $first_query = sqlsrv_query($con, "SELECT Quotes FROM [Aya_Web_APP].[dbo].[Tbl_Daily_Quotes] WHERE dayy = DATEPART(day, GETDATE())");
                    if ($output_query = sqlsrv_fetch_array($first_query)) {
                        echo '<p class="mb-0 fs-5">' . $output_query["Quotes"] . '</p>';
                    } else {
                        echo '<p class="mb-0">No quote found for today.</p>';
                    }
                    ?>
                </blockquote>
            </div>
        </div>
    </div>


        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">Online Courses</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="https://www.edx.org/"><img src="images/EdX_Logo.png" style="width:20px;"> EDX</a></li>
                        <li class="list-group-item"><a href="https://www.coursera.org/"><img src="images/coursera.png" style="width:20px;"> Coursera</a></li>
                        <li class="list-group-item"><a href="https://www.udemy.com/"><img src="images/udemy.png" style="width:20px;"> Udemy</a></li>
                        <li class="list-group-item"><a href="https://www.futurelearn.com/"><img src="images/future-learn5.png" style="width:20px;"> FutureLearn</a></li>
                        <li class="list-group-item"><a href="https://www.udacity.com/"><img src="images/udacity-icon.png" style="width:20px;"> Udacity</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">Mini Game</div>
                <div class="card-body">
                  <iframe style="width: 100%; height: 400px; overflow: hidden; border: none;" src="https://playpager.com/embed/cubes/index.html" title="Cubes Game" scrolling="no"></iframe>



                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">Online Weather</div>
                <div class="card-body">
                    <div id="wwo-weather-widget-2"></div>
                    <script type='text/javascript' src='https://www.worldweatheronline.com/widget/v5/weather-widget.ashx?loc=683802&wid=2&tu=1&div=wwo-weather-widget-2' async></script>
                    <noscript><a href="https://www.worldweatheronline.com/cairo-weather/al-qahirah/eg.aspx">Cairo, Al Qahirah weather forecast hourly</a></noscript>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
