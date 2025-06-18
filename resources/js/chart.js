// Chart.js Setup
import { Chart, registerables } from 'chart.js';

// Register all Chart.js components
Chart.register(...registerables);

// Make Chart available globally
window.Chart = Chart;

// Export Chart for ES module usage
export default Chart;
