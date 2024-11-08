
function toggleDarkMode() {
    const body = document.body;
    const isDarkMode = body.classList.toggle('dark-mode');
    
 
    localStorage.setItem('darkMode', isDarkMode);
    
    const icon = document.querySelector('.theme-toggle i');
    if (icon) {
      icon.className = isDarkMode ? 'fas fa-sun' : 'fas fa-moon';
    }
  }
  

  function loadThemePreference() {
    const darkModeEnabled = localStorage.getItem('darkMode') === 'true';
    if (darkModeEnabled) {
      document.body.classList.add('dark-mode');
      const icon = document.querySelector('.theme-toggle i');
      if (icon) {
        icon.className = 'fas fa-sun';
      }
    }
  }
  

  document.addEventListener('DOMContentLoaded', () => {
    
    loadThemePreference();
    
    const themeToggle = document.querySelector('.theme-toggle');
    if (themeToggle) {
      themeToggle.addEventListener('click', toggleDarkMode);
    }
  });