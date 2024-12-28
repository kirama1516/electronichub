// Get references to the input and preview elements
const imageInput = document.getElementById('image');
const previewImage = document.getElementById('preview');

// Add an event listener to the file input
imageInput.addEventListener('change', function(event) {
    const file = event.target.files[0]; // Get the selected file
    
    if (file) {
        const reader = new FileReader(); // Create a FileReader

        // When the file is loaded, set the preview image source
        reader.onload = function(e) {
            previewImage.src = e.target.result; // Set the preview image's src
            previewImage.style.display = 'block'; // Show the preview image
        };

        reader.readAsDataURL(file); // Read the file as a data URL
    } else {
        // Hide the preview image if no file is selected
        previewImage.style.display = 'none';
        previewImage.src = '';
    }
});