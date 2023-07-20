
document.addEventListener("DOMContentLoaded", function () {
    // Fetch the meal data from foods.json file
    fetch('json/foods.json')
      .then(response => response.json())
      .then(data => {
        const morningFoods = data.morningFoods;
        const lunchFoods = data.lunchFoods;
        const dinnerFoods = data.dinnerFoods;
        const snacksFoods = data.snacksFoods;        
        const mealSelect = document.getElementById("meal");
        const searchFoodInput = document.getElementById("searchFood");
        const searchResultsContainer = document.getElementById("searchResults");
        const foodList = {
          morning: document.getElementById("morning-food-list"),
          lunch: document.getElementById("lunch-food-list"),
          dinner: document.getElementById("dinner-food-list"),
          snacks: document.getElementById("snacks-food-list")
        };
        const totalCalories = document.getElementById("total-calories");
        const sugarLevel = document.getElementById("sugar-level");
        const diabeticAssessment = document.getElementById("diabetic-assessment");
        // Populate the food select options based on the selected meal
        function populateFoodOptions() {
          const selectedMeal = mealSelect.value;
          const selectedFoods = getFoodsByMeal(selectedMeal);        
            while (searchResultsContainer.firstChild)        
            {        
                searchResultsContainer.firstChild.remove();        
            }        
            // Clear the search results container        
            if(searchResultsContainer.firstChild=="")        
            {        
                searchResultsContainer.style.display="none";        
          }        
            else        
            {        
              searchResultsContainer.style.display="block";        
          }
           
          // Clear the search food input        
            searchFoodInput.value = '';
          // Populate the search results container
          selectedFoods.forEach(food => {
            const foodItem = document.createElement("div");
            foodItem.classList.add("search-result");
            foodItem.textContent = `${food.name} (Calories: ${food.calories}, Sugar: ${food.sugar})`;
            foodItem.setAttribute("data-food", JSON.stringify(food));
            foodItem.addEventListener("click", function () {
              selectFood(food);
            });
            searchResultsContainer.appendChild(foodItem);
          });
        }
        // Get the appropriate food array based on the selected meal
        function getFoodsByMeal(meal) {
          switch (meal) {
            case "morning":
              return morningFoods;
            case "lunch":
              return lunchFoods;
            case "dinner":
              return dinnerFoods;
            case "snacks":
              return snacksFoods;
            default:
              return [];
          }
        }
        // Search for food based on user input
        function searchFood() {
          const searchTerm = searchFoodInput.value.toLowerCase();
          const selectedMeal = mealSelect.value;
          const selectedFoods = getFoodsByMeal(selectedMeal);
          const searchResults = selectedFoods.filter(food => food.name.toLowerCase().includes(searchTerm));
          // Clear the search results container
          searchResultsContainer.innerHTML = '';
          // Populate the search results container
          searchResults.forEach(food => {
            const foodItem = document.createElement("div");
            foodItem.classList.add("search-result");
            foodItem.textContent = `${food.name} (Calories: ${food.calories}, Sugar: ${food.sugar})`;
            foodItem.setAttribute("data-food", JSON.stringify(food));
            foodItem.addEventListener("click", function () {
              selectFood(food);
            });
            searchResultsContainer.appendChild(foodItem);
          });
        }
        // Select a food from the search results
        function selectFood(food) {
          searchFoodInput.value = food.name;
          searchResultsContainer.innerHTML = '';
          // Add the selected food to the menu
          const selectedMeal = mealSelect.value;
          const foodListElement = foodList[selectedMeal];
          const foodItem = document.createElement("li");
          foodItem.classList.add("list-group-item");
          foodItem.textContent = `${food.name} (Calories: ${food.calories}, Sugar: ${food.sugar})`;
          foodItem.setAttribute("data-calories", food.calories);
          foodItem.setAttribute("data-sugar", food.sugar);
          const deleteButton = document.createElement("button");
          deleteButton.textContent = "Delete";
          deleteButton.classList.add("btn", "btn-danger", "btn-sm", "ml-2");
          deleteButton.style.display = "flex";
          deleteButton.style.alignItems = "center";
          deleteButton.style.marginTop = "0.5rem";
          deleteButton.addEventListener("click", function () {
            removeFood(selectedMeal, foodItem);
          });
          foodItem.appendChild(deleteButton);
          foodListElement.appendChild(foodItem);
          const currentCalories = parseFloat(totalCalories.textContent);
          const currentSugarLevel = parseFloat(sugarLevel.textContent);
          totalCalories.textContent = currentCalories + food.calories;
          sugarLevel.textContent = currentSugarLevel + food.sugar;
          // Perform diabetic assessment
          if (currentCalories + food.calories > 2000 || currentSugarLevel + food.sugar > 50) {
            diabeticAssessment.textContent = "Not suitable for a diabetic";
            diabeticAssessment.style.color = "red";
          } else {
            diabeticAssessment.textContent = "Suitable for a diabetic";
            diabeticAssessment.style.color = "green";
          }
        }
        // Remove food from the selected meal in the menu
        function removeFood(meal, foodItem) {
          const selectedMeal = meal;
          const foodListElement = foodList[selectedMeal];
          const foodCalories = parseFloat(foodItem.getAttribute("data-calories"));
          const foodSugar = parseFloat(foodItem.getAttribute("data-sugar"));
          foodListElement.removeChild(foodItem);
          const currentCalories = parseFloat(totalCalories.textContent);
          const currentSugarLevel = parseFloat(sugarLevel.textContent);
          totalCalories.textContent = currentCalories - foodCalories;
          sugarLevel.textContent = currentSugarLevel - foodSugar;
          // Perform diabetic assessment
          if (currentCalories - foodCalories > 2000 || currentSugarLevel - foodSugar > 50) {
            diabeticAssessment.textContent = "Not suitable for a diabetic";
            diabeticAssessment.style.color = "red";
          } else {
            diabeticAssessment.textContent = "Suitable for a diabetic";
            diabeticAssessment.style.color = "green";
          }
        }
        // Event listener for the meal select change
        mealSelect.addEventListener("change", populateFoodOptions);
        // Event listener for the search food input
        searchFoodInput.addEventListener("input", searchFood);
      })
      .catch(error => console.error('Error fetching meal data:', error));
  });