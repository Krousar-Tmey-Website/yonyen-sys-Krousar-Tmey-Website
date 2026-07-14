/* ============================================
   ADMIN DONATIONS - DASHBOARD CHART
============================================ */

document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('monthlyChart');
    if (!canvas) return;

    // ── Data from Blade @json ──
    // These are set as data attributes on the canvas by the Blade view
    const months = JSON.parse(canvas.dataset.months || '[]');
    const totals = JSON.parse(canvas.dataset.totals || '[]');
    const counts = JSON.parse(canvas.dataset.counts || '[]');

    if (!months.length) return;

    const monthNames = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const barColor = 'rgba(45, 111, 163, 0.75)';
    const barBorder = 'rgba(45, 111, 163, 1)';
    const lineColor = 'rgba(141, 168, 58, 0.8)';
    const lineFill = 'rgba(141, 168, 58, 0.1)';
    const linePoint = 'rgba(141, 168, 58, 1)';

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: months.map(m => monthNames[parseInt(m)] || m),
            datasets: [
                {
                    label: 'Amount ($)',
                    data: totals,
                    backgroundColor: barColor,
                    borderColor: barBorder,
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                    order: 1,
                    yAxisID: 'y',
                },
                {
                    label: 'Donations',
                    data: counts,
                    backgroundColor: lineFill,
                    borderColor: lineColor,
                    borderWidth: 2,
                    type: 'line',
                    tension: 0.4,
                    pointRadius: 3,
                    pointBackgroundColor: linePoint,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    fill: true,
                    order: 0,
                    yAxisID: 'y1',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        padding: 16,
                        font: { size: 12, weight: '500' },
                        usePointStyle: true,
                        color: '#374151',
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                    padding: 12,
                    titleFont: { size: 13, weight: '600' },
                    bodyFont: { size: 12 },
                    cornerRadius: 8,
                    callbacks: {
                        label: function(ctx) {
                            const v = Number(ctx.parsed.y).toLocaleString('en-US', { minimumFractionDigits: 2 });
                            return ctx.dataset.label === 'Amount ($)'
                                ? 'Amount: $ ' + v
                                : 'Count: ' + ctx.parsed.y;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true, position: 'left',
                    grid: { color: 'rgba(0,0,0,0.04)', drawBorder: false },
                    border: { display: false },
                    ticks: { font: { size: 11 }, padding: 8, color: '#9ca3af', maxTicksLimit: 6, callback: v => '$' + v.toLocaleString() }
                },
                y1: {
                    beginAtZero: true, position: 'right',
                    grid: { display: false }, border: { display: false },
                    ticks: { font: { size: 11 }, padding: 8, color: '#9ca3af', stepSize: 1 }
                },
                x: {
                    grid: { display: false }, border: { display: false },
                    ticks: { font: { size: 11, weight: '600' }, color: '#6b7280', maxRotation: 0 }
                }
            }
        }
    });
});
