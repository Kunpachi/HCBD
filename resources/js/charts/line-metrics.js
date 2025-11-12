import ApexCharts from 'apexcharts'

function safeParse(raw) {
  if (!raw) return null
  try {
    // Atribut HTML adalah string JSON; sekali parse cukup
    return JSON.parse(raw)
  } catch (e) {
    console.warn('[line-metrics] Gagal parse JSON:', raw, e)
    return null
  }
}

function buildOptions(el) {
  const seriesData = safeParse(el.getAttribute('data-series')) || []
  const labelsData = safeParse(el.getAttribute('data-labels')) || []
  const color = el.getAttribute('data-color') || '#F7A827'
  const height = parseInt(el.getAttribute('data-height') || '320', 10)
  const smooth = el.getAttribute('data-smooth') === '1'
  const showGrid = el.getAttribute('data-grid') === '1'
  const showMarkers = el.getAttribute('data-markers') === '1'

  return {
    chart: {
      type: 'line',
      height,
      toolbar: { show: false },
      foreColor: '#6b7280'
    },
    series: [{ name: 'Value', data: seriesData }],
    stroke: {
      curve: smooth ? 'smooth' : 'straight',
      width: 3,
      colors: [color]
    },
    markers: {
      size: showMarkers ? 4 : 0,
      strokeColors: color,
      hover: { sizeOffset: 2 }
    },
    xaxis: {
      categories: labelsData,
      axisBorder: { show: false },
      axisTicks: { show: false },
      labels: { style: { fontSize: '12px' } }
    },
    yaxis: {
      labels: { formatter: v => Math.round(v), style: { fontSize: '12px' } }
    },
    grid: {
      show: showGrid,
      borderColor: '#e5e7eb',
      strokeDashArray: 5,
      xaxis: { lines: { show: false } },
      yaxis: { lines: { show: true } }
    },
    tooltip: {
      theme: 'light',
      y: { formatter: val => `${val}` }
    },
    colors: [color],
    dataLabels: { enabled: false },
    legend: { show: false }
  }
}

function mountSingle(el) {
  const options = buildOptions(el)
  const chart = new ApexCharts(el, options)
  chart.render()
  return chart
}

export function mountLineMetricCharts() {
  const els = document.querySelectorAll('[data-line-chart="true"]')
  console.debug(`[line-metrics] found ${els.length} chart container(s)`)
  els.forEach(el => {
    if (!el.__lineChartMounted) {
      el.__lineChartMounted = true
      mountSingle(el)
    }
  })
}

document.addEventListener('DOMContentLoaded', () => {
  try {
    mountLineMetricCharts()
  } catch (e) {
    console.error('[line-metrics] init error', e)
  }
})