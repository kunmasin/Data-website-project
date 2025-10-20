// Function to show the relevant container and hide others
function showContainer(containerId) {
    // Get all container elements
    var containers = document.querySelectorAll('.container');
    // Hide all containers
    containers.forEach(function(container) {
        container.style.display = 'none';
    });
    // Show the selected container
    document.getElementById(containerId).style.display = 'block';
}

// Set default view
document.addEventListener("DOMContentLoaded", function() {
    showContainer('container_airtime'); // Default to Airtime on load
});


// Function to show the relevant container and hide others
function showContainer(containerId) {
    // Get all container elements
    var containers = document.querySelectorAll('.container');
    // Hide all containers
    containers.forEach(function(container) {
        container.style.display = 'none';
    });
    // Show the selected container
    document.getElementById(containerId).style.display = 'block';
}

// Set default view
document.addEventListener("DOMContentLoaded", function() {
    showContainer('container_data'); // Default to Airtime on load
});

// Function to show the relevant container and hide others
function showContainer(containerId) {
    // Get all container elements
    var containers = document.querySelectorAll('.container');
    // Hide all containers
    containers.forEach(function(container) {
        container.style.display = 'none';
    });
    // Show the selected container
    document.getElementById(containerId).style.display = 'block';
}

// Set default view
document.addEventListener("DOMContentLoaded", function() {
    showContainer('container_bill'); // Default to Airtime on load
});


// Function to show the relevant container and hide others
function showContainer(containerId) {
    // Get all container elements
    var containers = document.querySelectorAll('.container');
    // Hide all containers
    containers.forEach(function(container) {
        container.style.display = 'none';
    });
    // Show the selected container
    document.getElementById(containerId).style.display = 'block';
}

// Set default view
document.addEventListener("DOMContentLoaded", function() {
    showContainer('container_cables'); // Default to Airtime on load
})

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('inDline');
    const button = document.getElementById('sidebarCollapse');
    const closeButton = document.getElementById('closeSidebar');
    
    // Toggle sidebar visibility on button click
    button.addEventListener('click', function() {
        if (sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
        } else {
            sidebar.classList.add('show');
        }
    });
    
    // Close sidebar on close button click
    closeButton.addEventListener('click', function() {
        sidebar.classList.remove('show');
    });
});

