import './bootstrap';
import Alpine from 'alpinejs';

// Import Chart.js
import Chart from 'chart.js/auto';

// Register Chart globally
window.Chart = Chart;

// Initialize Alpine
window.Alpine = Alpine;

// Custom Alpine directives
Alpine.directive('tooltip', (el, { expression }) => {
    const tooltip = document.createElement('div');
    tooltip.className = 'opacity-0 invisible absolute z-50 px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm transition-opacity duration-300 whitespace-nowrap';
    tooltip.textContent = expression;
    el.parentNode.appendChild(tooltip);

    el.addEventListener('mouseenter', () => {
        const rect = el.getBoundingClientRect();
        tooltip.style.top = `${rect.top - tooltip.offsetHeight - 10}px`;
        tooltip.style.left = `${rect.left + rect.width / 2 - tooltip.offsetWidth / 2}px`;
        tooltip.classList.remove('opacity-0', 'invisible');
        tooltip.classList.add('opacity-100', 'visible');
    });

    el.addEventListener('mouseleave', () => {
        tooltip.classList.remove('opacity-100', 'visible');
        tooltip.classList.add('opacity-0', 'invisible');
    });
});

// Custom data for charts
Alpine.data('dashboardCharts', () => ({
    init() {
        this.$nextTick(() => {
            this.initCharts();
        });
    },

    initCharts() {
        // Asset Distribution Chart
        const assetCtx = document.getElementById('assetDistributionChart');
        if (assetCtx) {
            new Chart(assetCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Elektronik', 'Kendaraan', 'Furniture', 'Bangunan', 'Lainnya'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(139, 92, 246, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(239, 68, 68, 0.8)'
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        }

        // Performance Trend Chart
        const performanceCtx = document.getElementById('performanceTrendChart');
        if (performanceCtx) {
            new Chart(performanceCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    datasets: [{
                        label: 'Kinerja Aset',
                        data: [65, 75, 80, 85, 82, 90],
                        borderColor: 'rgba(59, 130, 246, 1)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }
    }
}));

// Initialize components
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss alerts after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('[role="alert"]').forEach(alert => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        });
    }, 5000);

    // Initialize tooltips
    document.querySelectorAll('[x-tooltip]').forEach(el => {
        const tooltip = document.createElement('div');
        tooltip.className = 'absolute z-50 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 pointer-events-none transition-opacity';
        tooltip.textContent = el.getAttribute('x-tooltip');
        document.body.appendChild(tooltip);

        el.addEventListener('mouseenter', (e) => {
            const rect = el.getBoundingClientRect();
            tooltip.style.top = `${rect.top - tooltip.offsetHeight - 5}px`;
            tooltip.style.left = `${rect.left + rect.width / 2 - tooltip.offsetWidth / 2}px`;
            tooltip.classList.remove('opacity-0');
            tooltip.classList.add('opacity-100');
        });

        el.addEventListener('mouseleave', () => {
            tooltip.classList.remove('opacity-100');
            tooltip.classList.add('opacity-0');
        });
    });
});

Alpine.start();
