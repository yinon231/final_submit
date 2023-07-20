function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
      $('#imagePreview').hide();
      $('#imagePreview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$(document).ready(function() {
  $('#settings').click(function(e) {
    e.preventDefault();
    $('.dropdown-menu').toggle();
});
  $("#imageUpload").change(function() {
    console.log(1);
    readURL(this);
  });
  $("#myTab a").click(function(e) {
    e.preventDefault();
    $(this).tab("show");
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.querySelector(".search");
  if (searchInput) {
    searchInput.addEventListener("keyup", function () {
      const searchValue = searchInput.value.toLowerCase();
      const allProfileRows = document.querySelectorAll(".profile-small, .row-profile");
      let noResult = true;

      allProfileRows.forEach(function (profile) {
        const nameElement = profile.querySelector("#bold") || profile.querySelector(".col-3");
        if (nameElement) {
          const name = nameElement.textContent.toLowerCase();
          if (name.includes(searchValue)) {
            profile.style.display = "flex";
            noResult = false;
          } else {
            profile.style.display = "none";
          }
        }
      });

      const noResultMessage = document.querySelector("#no-result-message");
      if (noResult) {
        noResultMessage.style.display = "block";
      } else {
        noResultMessage.style.display = "none";
      }

    });
  }
});

// active //

function toggleActive(element) {
  // get all the nav links
  let navLinks = $('.nav-link');

  // loop through all the nav links
  navLinks.each(function() {
    // check if the current nav link is the one that was clicked
    if ($(this)[0] === element) {
      // add the active class to the clicked element
      $(this).addClass('active');
      $(this).css('background-color', '#6495ED');
    } else {
      // remove the active class from all other nav links
      $(this).removeClass('active');
      $(this).css('background-color', '');
    }
  });
}

const formDel = document.querySelectorAll('.deleteForm');
if (formDel) {
  // Add form submit event listener
  formDel.forEach(formDel=>formDel.addEventListener('submit', function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Display the Bootstrap modal
    var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    confirmDeleteModal.show();
    const deleteButton = document.getElementById("delete");
    deleteButton.onclick = () => {
      formDel.submit();
    }
  }));
}

const formDel1 = document.querySelectorAll('.deleteForm1');
if (formDel1) {
  // Add form submit event listener
  formDel1.forEach(formDel1=>formDel1.addEventListener('submit', function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Display the Bootstrap modal
    var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    confirmDeleteModal.show();
    const deleteButton = document.getElementById("delete");
    deleteButton.onclick = () => {
      formDel.submit();
    }
  }));
}


    





