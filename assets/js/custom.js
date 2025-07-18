// Function to show a specific content section and update active sidebar link
function showSection(sectionId) {
    // Hide all content sections
    document.querySelectorAll('.content-section').forEach(section => {
        section.classList.remove('active');
    });

    // Show the target section
    const targetSection = document.querySelector(sectionId);
    if (targetSection) {
        targetSection.classList.add('active');
        // Update the navbar title for mobile view
        if (currentSectionTitle) {
            currentSectionTitle.textContent = targetSection.querySelector('h4, h5').textContent;
        }
    }

    // Update active state for sidebar links
    document.querySelectorAll('.sidebar ul li a').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === sectionId) {
            link.classList.add('active');
        }
    });
}