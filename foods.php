<?php
// Check if the 'id' parameter is set and not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
  // Store the 'id' parameter in a variable
  $id = $_GET['id'];

  // Create the back button link with the same 'id' parameter
  $backLink = "patient.php?id=" . $id;
} else {
  // Handle the case where 'id' is not available (you can set a default URL or handle it as needed)
  $backLink = "patient.php"; // Change 'default-page.php' to the appropriate default URL
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Smart Menu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200;300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/final_foods.css">
</head>

<body>
  <div class="container">
  <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <!-- Back Button -->
                <a class='button_back btn btn-sm btn-dark' href="<?php echo $backLink; ?>"><i class='fas fa-arrow-left'></i> Back</a>
            </div>
        </div>
        <br>
    <h1 class="text-center logo-title">
      <i class="fa fa-cutlery"></i>
      <span style="font-weight:900">Smart</span> MENU</h1>
    <div class="form-group">
      <label for="meal">Select a Meal:</label>
      <select class="form-control" id="meal">
        <option value="">-- Select Meal --</option>
        <option value="morning">Morning</option>
        <option value="lunch">Lunch</option>
        <option value="dinner">Dinner</option>
        <option value="snacks">Snacks</option>
      </select>
    </div>

    <div class="form-group">
      <label for="food">Search Food:</label>
      <input type="text" class="form-control" id="searchFood" placeholder="Enter food name">
      <div id="searchResults" class="search-results-container"></div>
    </div>

    <div class="text-center">
      <button class="btn btn-dark" onclick="addFood()"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Food
      </button>
    </div>

    <div id="menu">
      <h2>Menu</h2>
      <div class="card-deck">
        <!-- Morning Card -->
        <div id="morning-menu" class="card">
          <span class="card-img-top1" alt="Morning Image"></span>
          <div class="card-body">
            <h3 class="card-title">Morning</h3>
            <ul id="morning-food-list" class="list-group list-group-flush"></ul>
          </div>
        </div>
        <!-- Lunch Card -->
        <div id="lunch-menu" class="card">
          <span class="card-img-top2" alt="Morning Image"></span>
          <div class="card-body">
            <h3 class="card-title">Lunch</h3>
            <ul id="lunch-food-list" class="list-group list-group-flush"></ul>
          </div>
        </div>
        <!-- Dinner Card -->
        <div id="dinner-menu" class="card">
          <span class="card-img-top3" alt="Morning Image"></span>
          <div class="card-body">
            <h3 class="card-title">Dinner</h3>
            <ul id="dinner-food-list" class="list-group list-group-flush"></ul>
          </div>
        </div>
        <!-- Snacks Card -->
        <div id="snacks-menu" class="card">
          <span class="card-img-top4" alt="Morning Image"></span>
          <div class="card-body">
            <h3 class="card-title">Snacks</h3>
            <ul id="snacks-food-list" class="list-group list-group-flush"></ul>
          </div>
        </div>
      </div>
      <div class="mt-4 text-center">
        <h3 class="mb-3">Total</h3>
        <div class="row justify-content-center">
          <div class="col-md-6">
            <p class="mb-2">Total Calories: <span id="total-calories">0</span></p>
            <p class="mb-2">Sugar Level: <span id="sugar-level">0</span></p>
            <p id="diabetic-assessment" class="mb-0"></p>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- Include Bootstrap JS (Optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/final_foods.js"></script>
</body>

</html>
