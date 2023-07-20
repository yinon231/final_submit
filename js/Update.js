const formUpdate = document.getElementById('update');
if (formUpdate) {
  // Add form submit event listener
  formUpdate.addEventListener('submit', function(event) {
    // Get the select element
    var selectElement = document.querySelector('select[name="type"]');

    // Check if the select field is empty
    if (selectElement.value === '' || selectElement.value == 'Choose diabetes type') {
      // Prevent form submission
      event.preventDefault();

      // Show an error message or perform any desired action
      alert('Please select a diabetes type');
    }
  });
}
