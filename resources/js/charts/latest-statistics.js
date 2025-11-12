import ApexCharts from 'apexcharts'

// Helper: parse JSON aman
function parseJson(str) {
  if (!str) return null
  try { return JSON.parse(JSON.parse(str)) } catch { return null }
}

export function mountLatestStatistics() {
  const el = document.getElementById('latest-stats-chart')
  if (!el) return

  const seriesDataAttr = el.getAttribute('data-series')
  const categoriesAttr = el.getAttribute('data-categories')

  const data = parseJson(seriesDataAttr) || [270, 85, 185, 200, 120, 80, 50, 80, 120, 150, 225, 275, 185, 95, 130, 220, 300, 250, 180]
  const categories = parseJson(categoriesAttr) || ['2A','2B','2C','2D','2E','2F','3A','3B','3C','3D','3E','4A','4B','4C','4D','4E','5A','5B','6A',]

  const options = {
    chart: {
      type: 'bar',
      height: 320,
      toolbar: { show: false },
      foreColor: '#6b7280' // gray-500
    },
    series: [{ name: 'Users', data }],
    colors: ['#16c9b2'], // turqoise-ish
    plotOptions: {
      bar: {
        columnWidth: '35%',
        borderRadius: 6,
        distributed: false
      }
    },
    dataLabels: { enabled: false },
    grid: {
      borderColor: '#eee',
      strokeDashArray: 5,
      xaxis: { lines: { show: false } },
      yaxis: { lines: { show: true } }
    },
    xaxis: {
      categories,
      axisBorder: { show: false },
      axisTicks: { show: false },
      labels: {
        rotate: -45,
        style: { fontSize: '12px' }
      }
    },
    yaxis: {
      min: 0,
      max: 400,
      tickAmount: 4,
      labels: { formatter: (v) => Math.round(v) }
    },
    tooltip: {
      theme: 'light',
      y: { formatter: (val) => `${val}` }
    },
    states: {
      hover: { filter: { type: 'lighten', value: 0.02 } },
      active: { filter: { type: 'darken', value: 0.02 } }
    },
    responsive: [
      { breakpoint: 992, options: { plotOptions: { bar: { columnWidth: '45%' } } } },
      { breakpoint: 576, options: { plotOptions: { bar: { columnWidth: '55%' } }, xaxis: { labels: { rotate: -35 } } } },
    ]
  }

  const chart = new ApexCharts(el, options)
  chart.render()
}

// Auto-mount saat DOM siap
document.addEventListener('DOMContentLoaded', () => {
  mountLatestStatistics()
})