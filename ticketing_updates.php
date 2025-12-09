<?php
include("pages.php");
$self = $_SESSION['id'];
$role_id = $_SESSION['role_id'];
?>

<title>Update Tickets</title>
<head>
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
  <link rel="manifest" href="/manifest.json">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
    }

    .main {
      max-width: 1200px;
      margin: auto;
      padding: 40px 20px;
    }

    .cards {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 0;
      list-style: none;
    }

    .cards_item {
      width: 100%;
      max-width: 300px;
    }

    .card2 {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .card2:hover {
      transform: translateY(-5px);
    }

    .card_image img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .card_content {
      padding: 20px;
    }

    .card_title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #333;
    }

    .card_text {
      font-size: 14px;
      margin-bottom: 15px;
      color: #666;
    }

    .btn {
      display: inline-block;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      background-color: #0dcaf0;
      color: #fff;
      text-transform: uppercase;
      text-align: center;
      font-size: 14px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #0bb2d4;
    }
  </style>
</head>

<div class="main">
  <ul class="cards">

    <li class="cards_item">
      <div class="card2">
        <div class="card_image">
          <img src="images/person-with.png" alt="Change Sub Group">
        </div>
        <div class="card_content">
          <h2 class="card_title">Change Sub Group</h2>
          <p class="card_text">Change the employee's sub group easily.</p>
          <a class="btn" href="change_subGroup.php">Change</a>
        </div>
      </div>
    </li>

    <li class="cards_item">
      <div class="card2">
        <div class="card_image">
          <img src="images/1-89-512.png" alt="Change to staff">
        </div>
        <div class="card_content">
          <h2 class="card_title">Change to Staff</h2>
          <p class="card_text">Convert outsource employees to staff.</p>
          <a class="btn" href="outsource_to_staff.php">Convert</a>
        </div>
      </div>
    </li>

    <li class="cards_item">
      <div class="card2">
        <div class="card_image">
          <img src="images/swapinggg.png" alt="Internal Transfer">
        </div>
        <div class="card_content">
          <h2 class="card_title">Internal Transfer</h2>
          <p class="card_text">Move employees internally between teams.</p>
          <a class="btn" href="change_managment.php">Transfer</a>
        </div>
      </div>
    </li>

    <li class="cards_item">
      <div class="card2">
        <div class="card_image">
          <img src="images/Close-Icon-by-Valeree.png" alt="Delete Records">
        </div>
        <div class="card_content">
          <h2 class="card_title">Delete Records</h2>
          <p class="card_text">Remove specific employee records from system.</p>
          <a class="btn" href="delete_query.php">Delete</a>
        </div>
      </div>
    </li>

    <li class="cards_item">
      <div class="card2">
        <div class="card_image">
          <img src="images/resignationss.jfif" alt="Resignation">
        </div>
        <div class="card_content">
          <h2 class="card_title">Resignation</h2>
          <p class="card_text">Process and manage resignations with ease.</p>
          <a class="btn" href="resignation_update.php">Update</a>
        </div>
      </div>
    </li>

  </ul>
</div>

<?php include("footer.html"); ?>
