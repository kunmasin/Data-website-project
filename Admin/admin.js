function cables(containerClass) {
    // Hide all containers
    document.querySelectorAll('.container_gotv, .container_dstv, .container_startimes').forEach(function(container) {
        container.style.display = 'none';
    });
    // Show the selected container
    document.querySelector('.' + containerClass).style.display = 'block';
}

function updateMtnPrices() {
    // Get the values from the input fields
    var price500MB = document.getElementById("mtn-500mb").value;
    var price1GB = document.getElementById("mtn-1gb").value;
    var price2GB = document.getElementById("mtn-2gb").value;
    var price3GB = document.getElementById("mtn-3gb").value;
    var price4GB = document.getElementById("mtn-4gb").value;
    var price5GB = document.getElementById("mtn-5gb").value;

    // You can now use these values as needed, e.g., send them to a server
    console.log("MTN Prices Updated:");
    console.log("500 MB: NGN " + price500MB);
    console.log("1.0 GB: NGN " + price1GB);
    console.log("2.0 GB: NGN " + price2GB);
    console.log("3.0 GB: NGN " + price3GB);
    console.log("4.0 GB: NGN " + price4GB);
    console.log("5.0 GB: NGN " + price5GB);
    
    // Example: Show a confirmation message
    alert("MTN prices updated successfully!");
};

function updateMtnCGPrices() {
    // Get the values from the input fields
    var price500MB = document.getElementById("mtnCG-500mb").value;
    var price1GB = document.getElementById("mtnCG-1gb").value;
    var price2GB = document.getElementById("mtnCG-2gb").value;
    var price3GB = document.getElementById("mtnCG-3gb").value;
    var price4GB = document.getElementById("mtnCG-4gb").value;
    var price5GB = document.getElementById("mtnCG-5gb").value;

    // You can now use these values as needed, e.g., send them to a server
    console.log("MTN CG Prices Updated:");
    console.log("500 MB: NGN " + price500MB);
    console.log("1.0 GB: NGN " + price1GB);
    console.log("2.0 GB: NGN " + price2GB);
    console.log("3.0 GB: NGN " + price3GB);
    console.log("4.0 GB: NGN " + price4GB);
    console.log("5.0 GB: NGN " + price5GB);
    
    // Example: Show a confirmation message
    alert("MTN CG prices updated successfully!");
};

function updateAirtelPrices() {
    // Get the values from the input fields
    var price500MB = document.getElementById("airtel-500mb").value;
    var price1GB = document.getElementById("airtel-1gb").value;
    var price2GB = document.getElementById("airtel-2gb").value;
    var price3GB = document.getElementById("airtel-3gb").value;
    var price4GB = document.getElementById("airtel-4gb").value;
    var price5GB = document.getElementById("airtel-5gb").value;

    // You can now use these values as needed, e.g., send them to a server
    console.log("Airtel Prices Updated:");
    console.log("500 MB: NGN " + price500MB);
    console.log("1.0 GB: NGN " + price1GB);
    console.log("2.0 GB: NGN " + price2GB);
    console.log("3.0 GB: NGN " + price3GB);
    console.log("4.0 GB: NGN " + price4GB);
    console.log("5.0 GB: NGN " + price5GB);
    
    // Example: Show a confirmation message
    alert("Airetl Prices Updated Successfully!");
};


function updateGloPrices() {
    // Get the values from the input fields
    var price500MB = document.getElementById("glo-500mb").value;
    var price1GB = document.getElementById("glo-1gb").value;
    var price2GB = document.getElementById("glo-2gb").value;
    var price3GB = document.getElementById("glo-3gb").value;
    var price4GB = document.getElementById("glo-4gb").value;
    var price5GB = document.getElementById("glo-5gb").value;

    // You can now use these values as needed, e.g., send them to a server
    console.log("GLO Prices Updated:");
    console.log("500 MB: NGN " + price500MB);
    console.log("1.0 GB: NGN " + price1GB);
    console.log("2.0 GB: NGN " + price2GB);
    console.log("3.0 GB: NGN " + price3GB);
    console.log("4.0 GB: NGN " + price4GB);
    console.log("5.0 GB: NGN " + price5GB);
    
    // Example: Show a confirmation message
    alert("GLO prices updated successfully!");
};


function updateMobilePrices() {
    // Get the values from the input fields
    var price500MB = document.getElementById("mobile-500mb").value;
    var price1GB = document.getElementById("mobile-1gb").value;
    var price2GB = document.getElementById("mobile-2gb").value;
    var price3GB = document.getElementById("mobile-3gb").value;
    var price4GB = document.getElementById("mobile-4gb").value;
    var price5GB = document.getElementById("mobile-5gb").value;

    // You can now use these values as needed, e.g., send them to a server
    console.log("9Mobile Prices Updated:");
    console.log("500 MB: NGN " + price500MB);
    console.log("1.0 GB: NGN " + price1GB);
    console.log("2.0 GB: NGN " + price2GB);
    console.log("3.0 GB: NGN " + price3GB);
    console.log("4.0 GB: NGN " + price4GB);
    console.log("5.0 GB: NGN " + price5GB);
    
    // Example: Show a confirmation message
    alert("9Mobile Prices Updated Successfully!");
};


function updateGoTVPrice() {
    // Get the values from the input fields
    var price500MB = document.getElementById("gotv-max").value;
    var price1GB = document.getElementById("gotv-smallie").value;
    var price2GB = document.getElementById("gotv-jinja").value;
    var price3GB = document.getElementById("gotv-jolli").value;

    // You can now use these values as needed, e.g., send them to a server
    console.log("GoTV Prices Updated:");
    console.log("GoTv Max: NGN " + price500MB);
    console.log("GoTV Smallie: NGN " + price1GB);
    console.log("GoTv Jinja: NGN " + price2GB);
    console.log("GoTv Smallie: NGN " + priceGoTvJolli);
    
    // Example: Show a confirmation message
    alert("GoTv Prices Updated Successfully!");
};

function updateStartimesPrice() {
    // Get the values from the input fields
    var price500MB = document.getElementById("startimes-basic").value;
    var price1GB = document.getElementById("startimes-smart").value;
    var price2GB = document.getElementById("startimes-nova").value;
    var price3GB = document.getElementById("startimes-super").value;

    // You can now use these values as needed, e.g., send them to a server
    console.log("Startimes Prices Updated:");
    console.log("Startimes-Basic: NGN " + price500MB);
    console.log("Startimes-Smart: NGN " + price1GB);
    console.log("Startimes-Nova: NGN " + price2GB);
    console.log("Startimes-Super: NGN " + priceGoTvJolli);
    
    // Example: Show a confirmation message
    alert("Startimes Prices Updated Successfully!");
};

function updateDSTVPrice() {
    // Get the values from the input fields
    var price500MB = document.getElementById("DSTV-Padi").value;
    var price1GB = document.getElementById("DSTV-Great Wall Standalone").value;
    var price2GB = document.getElementById("DSTV-Yanga").value;
    var price3GB = document.getElementById("DSTV-Compact").value;

    // You can now use these values as needed, e.g., send them to a server
    console.log("DSTV Prices Updated:");
    console.log("DSTV-Padi: NGN " + price500MB);
    console.log("DSTV-Great Wall Standalone: NGN " + price1GB);
    console.log("DSTV-Yanga: NGN " + price2GB);
    console.log("DSTV-Compact: NGN " + priceGoTvJolli);
    
    // Example: Show a confirmation message
    alert("DSTV Prices Updated Successfully!");
};

function showContainer(containerClass) {
    // Hide all containers
    document.querySelectorAll('.container_mtn, .container_mtn_cg, .container_airtel, .container_glo, .container_mobile').forEach(function(container) {
        container.style.display = 'none';
    });
    // Show the selected container
    document.querySelector('.' + containerClass).style.display = 'block';
}

function showMTNContainers() {
    // Hide all containers
    document.querySelectorAll('.container_mtn, .container_mtn_cg, .container_airtel, .container_glo, .container_mobile').forEach(function(container) {
        container.style.display = 'none';
    });
    // Show both MTN containers
    document.querySelector('.container_mtn').style.display = 'block';
    document.querySelector('.container_mtn_cg').style.display = 'block';
};


function showAIRTELContainers() {
    // Hide all containers
    document.querySelectorAll('.container_mtn, .container_mtn_cg, .container_airtel, .container_glo, .container_mobile').forEach(function(container) {
        container.style.display = 'none';
    });
    // Show Airtel containers
    document.querySelector('.container_airtel').style.display = 'block';
}

function showGLOContainers() {
    // Hide all containers
    document.querySelectorAll('.container_mtn, .container_mtn_cg, .container_airtel, .container_glo, .container_mobile').forEach(function(container) {
        container.style.display = 'none';
    });
    // Show Glo containers
    document.querySelector('.container_glo').style.display = 'block';
}

function showMobileContainers() {
    // Hide all containers
    document.querySelectorAll('.container_mtn, .container_mtn_cg, .container_airtel, .container_glo, .container_mobile').forEach(function(container) {
        container.style.display = 'none';
    });
    // Show 9Mobile Containers
    document.querySelector('.container_mobile').style.display = 'block';
};

function cableshide() {
    // Hide all cable plan containers
    document.querySelector('.container_gotv').style.display = 'none';
    document.querySelector('.container_dstv').style.display = 'none';
    document.querySelector('.container_startimes').style.display = 'none';
    }

function cablesshow(containerClass) {
    cableshide(); // Hide all containers first
    document.querySelector(`.${containerClass}`).style.display = 'none'; // Show the selected container
    };

// script.js

// script.js

function showData() {
    // Show data content, hide cable content and buttons
    document.querySelector('.data-content').style.display = 'block';
    document.querySelector('.cable-content').style.display = 'none';
    document.querySelector('.cables-buttons').style.display = 'none';
};

function showCable() {
    // Show cable buttons, hide data buttons and other cable content
    document.querySelector('.data-content').style.display = 'none';
    document.querySelector('.data-buttons').style.display='block';
    document.querySelector('.cable-content').style.display = 'block';
    document.querySelector('.cables-buttons').style.display = 'flex';
    cablesshow(''); // Hide all cable content initially
};

function cablesshow(containerClass) {
    // Hide all cable content containers
    document.querySelectorAll('.cable-content > div').forEach(div => {
        if (div.classList.contains('cables-buttons')) return; // Skip the button container
        div.style.display = 'none';
    });

    // Show the selected cable content container
    if (containerClass) {
        document.querySelector(`.${containerClass}`).style.display = 'block';
    }
};

    function updateGoTVPrice() {
        // Your update logic here
    }
    
    function updateDSTVPrice() {
        // Your update logic here
    }
    
    function updateStartimesPrice() {
        // Your update logic here
    };
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
});


