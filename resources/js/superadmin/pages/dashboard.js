// Dashboard-specific JavaScript
import {
    createSparkline,
    colors
} from '../components/charts.js';
import {
    initDataTable
} from '../components/datatables.js';

// Make functions available globally for inline event handlers
window.createSparkline = createSparkline;
window.chartColors = colors;
window.initDataTable = initDataTable;

/**
 * Determine chart color based on data trend
 * @param {Array} data - Array of data values
 * @param {number} growth - Growth percentage
 * @returns {string} Color hex code
 */
function getDynamicChartColor(data, growth) {
    // If growth percentage indicates increase, use green; otherwise use red
    return growth >= 0 ? colors.success : colors.danger;
}

/**
 * Initialize all dashboard charts
 */
export function initDashboardCharts() {
    // Get chart data from global variables (set by inline script)
    const adminData = window.dashboardChartData?.admin || [];
    const mentorData = window.dashboardChartData?.mentor || [];
    const menteeData = window.dashboardChartData?.mentee || [];

    // Get growth percentages from blade (they should be available in the page)
    // We'll extract them from the DOM or use a reasonable default
    const adminGrowth = window.adminGrowth ?? 0;
    const mentorGrowth = window.mentorGrowth ?? 0;
    const menteeGrowth = window.menteeGrowth ?? 0;

    console.log('Dashboard Chart Data:', { adminData, mentorData, menteeData });

    // Use default data if empty
    const finalAdminData = adminData.length > 0 ? adminData : [0, 0, 0, 0, 0, 0, 0, 0, 0];
    const finalMentorData = mentorData.length > 0 ? mentorData : [0, 0, 0, 0, 0, 0, 0, 0, 0];
    const finalMenteeData = menteeData.length > 0 ? menteeData : [0, 0, 0, 0, 0, 0, 0, 0, 0];

    // Determine dynamic colors based on growth
    const adminColor = getDynamicChartColor(finalAdminData, adminGrowth);
    const mentorColor = getDynamicChartColor(finalMentorData, mentorGrowth);
    const menteeColor = getDynamicChartColor(finalMenteeData, menteeGrowth);

    console.log('Chart colors:', { adminColor, mentorColor, menteeColor });

    console.log('Rendering sparkline charts...');

    try {
        // Render sparkline admin
        const adminChart = createSparkline('#sparkline-income', finalAdminData, {
            color: adminColor
        });
        console.log('Admin chart rendered:', adminChart);

        // Render sparkline mentor
        const mentorChart = createSparkline('#sparkline-cash', finalMentorData, {
            color: mentorColor
        });
        console.log('Mentor chart rendered:', mentorChart);

        // Render sparkline mentee
        const menteeChart = createSparkline('#sparkline-profit', finalMenteeData, {
            color: menteeColor
        });
        console.log('Mentee chart rendered:', menteeChart);

        console.log('All sparkline charts rendered successfully');
    } catch (error) {
        console.error('Error rendering sparkline charts:', error);
    }
}

/**
 * Initialize admin table functionality
 */
export function initAdminTable() {
    let selectedRow, actionType, selectedAdminId, selectedAdminName;

    const searchInput = document.getElementById('searchAdmin');
    const filterStatus = document.getElementById('filterStatus');

    function getRows() {
        return document.querySelectorAll('#adminTable tr');
    }

    function filterTable() {
        const search = searchInput?.value.toLowerCase() || '';
        const status = filterStatus?.value || 'all';

        getRows().forEach(row => {
            const text = row.innerText.toLowerCase();
            const rowStatus = row.dataset.status;

            const matchSearch = text.includes(search);
            const matchStatus = status === 'all' || rowStatus === status;

            row.style.display = (matchSearch && matchStatus) ? '' : 'none';
        });
    }

    searchInput?.addEventListener('keyup', filterTable);
    filterStatus?.addEventListener('change', filterTable);

    // Modal status
    const statusModal = document.getElementById('statusModal');
    if (statusModal) {
        statusModal.addEventListener('show.bs.modal', function(event) {
            const btn = event.relatedTarget;
            selectedAdminId = btn.dataset.id;
            selectedAdminName = btn.dataset.name;
            actionType = btn.dataset.action;

            document.getElementById('modalTitle').innerText =
                actionType === 'nonaktif' ? 'Nonaktifkan Admin' : 'Aktifkan Admin';

            document.getElementById('modalMessage').innerHTML =
                actionType === 'nonaktif' ?
                `Apakah yakin menonaktifkan <b>${selectedAdminName}</b>?` :
                `Apakah yakin mengaktifkan kembali <b>${selectedAdminName}</b>?`;
        });
    }

    // Confirm action
    const confirmBtn = document.getElementById('confirmAction');
    if (confirmBtn) {
        confirmBtn.onclick = async function() {
            const row = document.querySelector(`tr[data-id="${selectedAdminId}"]`);
            if (!row) return;

            const statusCell = row.querySelector('.status');
            const toggleBtn = row.querySelector('.toggle-status');

            try {
                const newStatus = actionType === 'nonaktif' ? 'nonaktif' : 'aktif';

                const response = await fetch(`/superadmin/dashboard/admin/${selectedAdminId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                });

                const result = await response.json();

                if (result.success) {
                    row.dataset.status = newStatus;

                    if (newStatus === 'nonaktif') {
                        statusCell.innerHTML = '<span class="badge-nonaktif">Nonaktif</span>';
                        toggleBtn.textContent = 'Aktifkan';
                        toggleBtn.className = 'btn btn-outline-secondary btn-sm toggle-status';
                        toggleBtn.dataset.action = 'aktif';
                    } else {
                        statusCell.innerHTML = '<span class="badge-aktif">Aktif</span>';
                        toggleBtn.textContent = 'Nonaktifkan';
                        toggleBtn.className = 'btn btn-outline-danger btn-sm toggle-status';
                        toggleBtn.dataset.action = 'nonaktif';
                    }

                    filterTable();
                    bootstrap.Modal.getInstance(document.getElementById('statusModal'))?.hide();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memproses permintaan');
            }
        };
    }
}

/**
 * Initialize dashboard on DOM ready
 */
document.addEventListener('DOMContentLoaded', () => {
    console.log('Initializing dashboard...');
    initDashboardCharts();
    initAdminTable();
});
