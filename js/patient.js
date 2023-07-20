
function showTabContent(tabName) {
    // Hide all tab content
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(tab => tab.style.display = 'none');
  
    // Show the selected tab content and add active class to the button
    const selectedTab = document.getElementById(tabName);
    selectedTab.style.display = 'block';
  }
  
  function showText(text, tabName,date,id) {
    const originalURL = "http://se.shenkar.ac.il/students/2022-2023/web1/dev_203/patient.php?id="+id;
  
    // Reset the URL to the original URL
    window.history.replaceState({}, document.title, originalURL);
    const activeTabContent = document.getElementById(tabName).querySelector('.text-container');
    if (activeTabContent) {
        // Update the content inside the existing text container
        activeTabContent.textContent = text;
    } 
  
    let newURL = window.location.href +'&date='+date+'&tabname='+tabName;
    window.location.href = newURL;
  
  }
