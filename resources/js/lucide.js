// Lucide Icons Setup
import { createIcons, icons } from 'lucide';

// Initialize Lucide icons
const initializeLucide = () => {
  createIcons({
    icons,
    attrs: {
      'stroke-width': 2,
    }
  });
};

// Auto-initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', initializeLucide);

// Export for manual initialization if needed
window.initializeLucide = initializeLucide;

// Make createIcons available globally for dynamic content
window.lucide = { createIcons };
