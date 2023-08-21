<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="Photos/Black mini logo.png">
  <title>Car Reservation Form</title>

  <link rel="stylesheet" type="text/css" href="reservationcss.css">
  <script>
    var models = {
      Dacia: [
        { model: "Duster", price: 100 },
        { model: "Sandero", price: 100 }
      ],
      Jeep: [
        { model: "Cherokee", price: 400 },
        { model: "Renegade", price: 350 }
      ],
      Porsche: [
        { model: "Taycan", price: 350 },
        { model: "Cayenne", price: 400 }
      ],
      Audi: [
        { model: "Q8", price: 150 },
        { model: "A5", price: 150 }
      ],
      Toyota: [
        { model: "Prius", price: 250 },
        { model: "Camry", price: 250 }
      ],
      Volkswagen: [
        { model: "Tiguan", price: 200 },
        { model: "SID.4", price: 300 }
      ],
      Mercedes: [
        { model: "Benz class G", price: 450 },
        { model: "Benz class E", price: 500 }
      ],
      BMW: [
        { model: "3 Series", price: 250 },
        { model: "X5", price: 200 }
      ],
      Nissan: [
        { model: "Sentra", price: 150 },
        { model: "Juke", price: 100 }
      ],
      land_Rover: [
        { model: "Range Rover", price: 350 },
        { model: "Discovery", price: 300 }
      ]
    };

    function updateModels() {
      var marqueSelect = document.getElementById("marque");
      var modeleSelect = document.getElementById("modele");
      var priceElement = document.getElementById("price");
      var totalPriceElement = document.getElementById("total-price"); // New element to display total price
      var selectedMarque = marqueSelect.value;
      var selectedModel = modeleSelect.value;

      modeleSelect.innerHTML = ""; // Clear previous options
      priceElement.innerText = "";
      totalPriceElement.innerText = ""; // Clear previous total price

      if (selectedMarque !== "") {
        var modeleArray = models[selectedMarque];

        for (var i = 0; i < modeleArray.length; i++) {
          var option = document.createElement("option");
          option.text = modeleArray[i].model;
          modeleSelect.add(option);
        }

        // Find the selected model and display its price
        var selectedModelInfo = modeleArray.find(function (model) {
          return model.model === selectedModel;
        });

        if (selectedModelInfo) {
          priceElement.innerText = "Price: " + selectedModelInfo.price + " $";

          // Call showConfirmation() after updateModels() to ensure the correct total price is displayed
          showConfirmation();
        }
      }
    }

    function updatePrice() {
      var marqueSelect = document.getElementById("marque");
      var modeleSelect = document.getElementById("modele");
      var priceElement = document.getElementById("price");
      var selectedMarque = marqueSelect.value;
      var selectedModel = modeleSelect.value;

      priceElement.innerText = ""; // Clear previous price

      if (selectedMarque !== "") {
        var modeleArray = models[selectedMarque];

        // Find the selected model and display its price
        var selectedModelInfo = modeleArray.find(function (model) {
          return model.model === selectedModel;
        });

        if (selectedModelInfo) {
          priceElement.innerText = selectedModelInfo.price + " DH"; // Removed colon from price display

          // Update the total price by calling showConfirmation() function
          showConfirmation();
        } else {
          // If the selected model is not found, display an error message or handle it appropriately
          priceElement.innerText = "Price not available";
        }
      }
    }

    function showConfirmation() {
      var totalPriceElement = document.getElementById("total-price");
      var price = document.getElementById("price").innerText;
      var pickupDate = new Date(document.getElementById("pickup-date").value);
      var returnDate = new Date(document.getElementById("return-date").value);
      var duration = (returnDate - pickupDate) / (1000 * 60 * 60 * 24); // Duration in days
      var totalPrice = parseInt(price) * duration; // Remove split() and take the price as is

      // Display the total price on the page
      totalPriceElement.innerText = totalPrice + " DH"; // Remove colon from the total price

      // Set the value of the hidden input field with the total price
      var totalPriceInput = document.getElementById("total-price-input");
      totalPriceInput.value = totalPrice;
    }
    function updatePriceOnChange() {
    updatePrice();
    showConfirmation();
  }

  window.onload = function () {
    updateModels();
    showConfirmation();

    var marqueSelect = document.getElementById("marque");
    var modeleSelect = document.getElementById("modele");

    marqueSelect.addEventListener("change", function () {
      updateModels();
      updatePrice();
      showConfirmation();
    });

    modeleSelect.addEventListener("change", updatePriceOnChange);
  };
  </script>
<?php
// Vérifier si le formulaire de réservation a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Name = htmlspecialchars($_POST['username']);
    $CIN = htmlspecialchars($_POST['CIN']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : '';
    $phone = htmlspecialchars($_POST['phone']);
    $car = htmlspecialchars($_POST['car']);
    $car_model = htmlspecialchars($_POST['car_model']);
    $pickup_date = $_POST['pickup_date'];
    $return_date = $_POST['return_date'];
    $totalPrice = $_POST['total_price']; // Get the total price from the hidden input field

    if (
        !empty($Name) && !empty($CIN) && !empty($email) &&
        !empty($phone) && !empty($car) && !empty($car_model) &&
        !empty($pickup_date) && !empty($return_date)
    ) {
        require 'data.php';

        // Insert the reservation details, including the total price, into the database
        $sqlState = $pdo->prepare('INSERT INTO reservations (name, CIN, email, phone, car, model, total_price, pickup_date, return_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $result = $sqlState->execute([$Name, $CIN, $email, $phone, $car, $car_model, $totalPrice, $pickup_date, $return_date]);

        if (!$result) {
            $errorInfo = $sqlState->errorInfo();
            // Display or log the error information to debug the issue
            var_dump($errorInfo);
        } else {
            // La réservation est réussie, afficher une alerte de succès
            echo "<script>alert('Réservation réussie !');</script>";
            // Attendre quelques secondes avant de rediriger vers la page "index.html"
            echo "<script>setTimeout(function(){ window.location.href = 'index.html'; }, 100);</script>";
        }
    }
}
?>


<!-- Your form and HTML code here -->

<h1>Car Reservation Form</h1>
  
<form action="" method="POST">
  <label for="name">Name:</label>
  <input type="text" id="name" name="username" required>
  <label for="CIN">CIN:</label>
  <input type="text" id="CIN" name="CIN" required>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required>
    
  <label for="phone">Phone:</label>
  <input type="tel" id="phone" name="phone" required>
    
  <label for="car">Car:</label>
  <select id="marque" onchange="updateModels()" required name="car">
    <option value="">Select a brand</option>
    <option value="Dacia">Dacia</option>
    <option value="Toyota">Toyota</option>
    <option value="Audi">Audi</option>
    <option value="Mercedes">Mercedes</option>
    <option value="land_Rover">Rand Rover</option> <!-- Corrected value here -->
    <option value="BMW">BMW</option>
    <option value="Nissan">Nissan</option>
    <option value="Jeep">Jeep</option>
    <option value="Porsche">Porsche</option>
    <option value="Volkswagen">Volkswagen</option>
  </select>

  <label for="modele">Model:</label>
    <select id="modele" name="car_model" required onchange="updatePrice()"></select>

    <label for="price">Price</label>
    <span id="price"></span>

    <label for="pickup-date">Pickup Date:</label>
    <input type="date" id="pickup-date" name="pickup_date" required onchange="showConfirmation()">

    <label for="return-date">Return Date:</label>
    <input type="date" id="return-date" name="return_date" required onchange="showConfirmation()">

<label for="total-price">Total Price:</label>
    <span id="total-price" name="total_price"></span>
    <input type="hidden" id="total-price-input" name="total_price">
<input type="submit" value="Valide" name="book">
</form>
</body>
</html>