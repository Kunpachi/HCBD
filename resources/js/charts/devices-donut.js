import ApexCharts from 'apexcharts'

function safeParse(raw) {
  if (!raw) return null
  try {
    const once = JSON.parse(raw)
    return typeof once === 'string' ? JSON.parse(once) : once
  } catch {
    try { return JSON.parse(raw) } catch { return null }
  }
}

function renderLegend(container, labels, series, colors) {
  if (!container) return
  const total = series.reduce((a, b) => a + b, 0) || 1
  const items = labels.map((label, i) => {
    const pct = Math.round((series[i] / total) * 100)
    return `
      <div class="tw-flex tw-flex-col tw-gap-1">
        <div class="tw-text-gray-700 tw-font-medium">${label}</div>
        <div class="tw-flex tw-items-center tw-gap-2">
          <span class="tw-inline-block tw-h-1.5 tw-w-10 tw-rounded-full" style="background:${colors[i]}"></span>
          <span class="tw-text-gray-400 tw-text-sm">${pct} %</span>
        </div>
      </div>
    `
  })
  container.innerHTML = items.join('')
}

export function mountDevicesDonut(chartId = 'devices-donut-chart') {
  const el = document.getElementById(chartId)
  if (!el) return

  const labels = safeParse(el.getAttribute('data-labels')) || ['Desktop','Tablet','Mobile']
  const series = safeParse(el.getAttribute('data-series')) || [80,10,10]

  // Warna mendekati contoh
  const colors = ['#7065F0', '#19C8B7', '#F7A827']

  const options = {
    chart: { type: 'donut', height: 320, toolbar: { show: false }, foreColor: '#6b7280' },
    labels,
    series,
    colors,
    stroke: { width: 0 },
    dataLabels: { enabled: false },
    legend: { show: false },
    plotOptions: {
      pie: {
        donut: {
          size: '75%',
          labels: { show: false }
        }
      }
    },
    states: {
      hover: { filter: { type: 'lighten', value: 0.02 } },
      active: { filter: { type: 'darken', value: 0.02 } }
    }
  }

  const chart = new ApexCharts(el, options)
  chart.render().then(() => {
    const legendContainer = document.querySelector(`[data-legend-for="${chartId}"]`)
    renderLegend(legendContainer, labels, series, colors)
  })
}

document.addEventListener('DOMContentLoaded', () => {
  // Mount default id
  mountDevicesDonut('devices-donut-chart')
})