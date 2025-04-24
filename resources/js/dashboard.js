// Dashboard Sidebar Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize sidebar sections
    const sidebarSections = document.querySelectorAll('[data-sidebar-section]');
    
    sidebarSections.forEach(section => {
        const button = section.querySelector('[data-section-toggle]');
        const content = section.querySelector('[data-section-content]');
        
        if (button && content) {
            button.addEventListener('click', () => {
                const isOpen = content.classList.contains('hidden');
                content.classList.toggle('hidden');
                
                // Update arrow icon
                const arrow = button.querySelector('svg');
                if (arrow) {
                    arrow.classList.toggle('transform');
                    arrow.classList.toggle('rotate-180');
                }
            });
        }
    });

    // Smooth scrolling for sidebar links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Initialize tooltips if any
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(tooltip => {
        tooltip.addEventListener('mouseenter', showTooltip);
        tooltip.addEventListener('mouseleave', hideTooltip);
    });
});

// Tooltip functions
function showTooltip(e) {
    const tooltip = e.target;
    const tooltipText = tooltip.getAttribute('data-tooltip');
    
    const tooltipElement = document.createElement('div');
    tooltipElement.className = 'tooltip';
    tooltipElement.textContent = tooltipText;
    
    document.body.appendChild(tooltipElement);
    
    const rect = tooltip.getBoundingClientRect();
    tooltipElement.style.top = `${rect.top - tooltipElement.offsetHeight - 10}px`;
    tooltipElement.style.left = `${rect.left + (rect.width / 2) - (tooltipElement.offsetWidth / 2)}px`;
}

function hideTooltip() {
    const tooltip = document.querySelector('.tooltip');
    if (tooltip) {
        tooltip.remove();
    }
}

// Export functions if needed
export { showTooltip, hideTooltip }; 