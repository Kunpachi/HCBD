// // ===== Vuexy JS (pastikan path benar dan tidak duplikat) =====
// import '../vendor/vendor/js/helpers.js'
// import '../vendor/vendor/js/menu.js'
// import '../vendor/vendor/js/dropdown-hover.js'
// import '../vendor/vendor/js/mega-dropdown.js'
// import '../vendor/vendor/js/bootstrap.js'
// import '../vendor/vendor/js/template-customizer.js'


// // ===== Laravel's bootstrap.js (Axios/Echo), bukan Bootstrap CSS/JS =====
// import './bootstrap.js'

// // ===== Chart components =====
// import './charts/latest-statistics.js'
// import './charts/devices-donut.js'

// // Satu listener terpusat agar tidak double init
// document.addEventListener('DOMContentLoaded', () => {
//   try {
//     if (window.__appInitDone) return
//     window.__appInitDone = true

//     // 1) Hover-to-open + restore collapsed state
//     // 1) Hover-to-open + restore collapsed state
//     if (window.Helpers) {
//       document.body.classList.add('layout-menu-hover')
//       const COLLAPSE_KEY = 'menuCollapsed'
//       const saved = localStorage.getItem(COLLAPSE_KEY)
//       window.Helpers.setCollapsed(saved ? saved === '1' : true, true)

//       const toggler = document.querySelector('.layout-menu-toggle')
//       toggler?.addEventListener('click', (e) => {
//         e.preventDefault()
//         window.Helpers.toggleCollapsed()
//         const collapsedNow = document.documentElement.classList.contains('layout-menu-collapsed')
//         localStorage.setItem(COLLAPSE_KEY, collapsedNow ? '1' : '0')
//       })
//     } else {
//       console.warn('window.Helpers tidak tersedia. Cek urutan import Vuexy JS.')
//     }

//     // 2) Init Menu Vuexy
//     // const menuEl = document.getElementById('layout-menu')
//     // if (typeof window.Menu === 'function' && menuEl) {
//     //   if (!window.__vuexyMenu) {
//     //     window.__vuexyMenu = new window.Menu(menuEl, {
//     //       orientation: '',
//     //       animate: true,
//     //       accordion: true,
//     //       showDropdownOnHover: false,
//     //       closeChildren: true,
//     //     })
//     //   }
//     // } else {
//     //   console.warn('window.Helpers tidak tersedia. Cek urutan import Vuexy JS.')
//     // }

//     // 2) Pin toggle (circle icon)
//     const html = document.documentElement
//     const pinBtn = document.querySelector('#menu-pin-toggle')
//     const PIN_KEY = 'menuPinned'
//     const CLASS_COLLAPSED = 'layout-menu-collapsed'

//     const updateIcon = () => {
//       const pinned = localStorage.getItem(PIN_KEY) === '1'
//       const icon = pinBtn?.querySelector('i')
//       if (icon) icon.className = pinned ? 'ti ti-circle-filled text-primary' : 'ti ti-circle'
//     }

//     pinBtn?.addEventListener('click', (e) => {
//       e.preventDefault()
//       const pinned = !(localStorage.getItem(PIN_KEY) === '1')
//       localStorage.setItem(PIN_KEY, pinned ? '1' : '0')

//       if (pinned) {
//         html.classList.remove(CLASS_COLLAPSED)
//         document.body.classList.remove(CLASS_COLLAPSED)
//       } else {
//         html.classList.add(CLASS_COLLAPSED)
//         document.body.classList.add(CLASS_COLLAPSED)
//       }
//       updateIcon()
//     })

//     updateIcon()
//     if (localStorage.getItem(PIN_KEY) !== '1') {
//       html.classList.add(CLASS_COLLAPSED)
//       document.body.classList.add(CLASS_COLLAPSED)
//     }

//     // 3) Init Menu Vuexy
//     const menuEl = document.getElementById('layout-menu')
//     if (typeof window.Menu === 'function' && menuEl) {
//       if (!window.__vuexyMenu) {
//         window.__vuexyMenu = new window.Menu(menuEl, {
//           orientation: '',
//           animate: true,
//           accordion: true,
//           showDropdownOnHover: false,
//           closeChildren: true,
//         })
//       }
//     } else {
//       console.warn('Vuexy menu.js belum termuat atau #layout-menu tidak ditemukan.')
//     }
//   } catch (err) {
//     console.error('Gagal init app:', err)
//   }
// })

//// ===== Vuexy JS (pastikan path benar) =====
import '../vendor/vendor/js/helpers.js'
import '../vendor/vendor/js/menu.js'
import '../vendor/vendor/js/dropdown-hover.js'
import '../vendor/vendor/js/mega-dropdown.js'
import '../vendor/vendor/js/bootstrap.js'
import '../vendor/vendor/js/template-customizer.js'

//// ===== Laravel's bootstrap.js (Axios/Echo), bukan Bootstrap CSS/JS =====
import './bootstrap.js'

//// ===== Chart components (opsional) =====
import './charts/latest-statistics.js'
import './charts/devices-donut.js'
import './charts/line-metrics.js'
document.addEventListener('DOMContentLoaded', () => {
  try {
    if (window.__appInitDone) return
    window.__appInitDone = true

    // — (A) Pastikan overlay tidak menutup klik (guard)
    const overlay = document.querySelector('.layout-overlay')
    if (overlay) {
      overlay.style.pointerEvents = 'none'
      overlay.style.opacity = '0'
    }

    // — (B) Hover-to-open + restore collapsed state
    if (window.Helpers && typeof window.Helpers.setCollapsed === 'function') {
      document.body.classList.add('layout-menu-hover')

      const COLLAPSE_KEY = 'menuCollapsed'
      const saved = localStorage.getItem(COLLAPSE_KEY)
      window.Helpers.setCollapsed(saved ? saved === '1' : true, true)

      const toggler = document.querySelector('.layout-menu-toggle')
      toggler?.addEventListener('click', (e) => {
        e.preventDefault()
        window.Helpers.toggleCollapsed()
        const collapsedNow = document.documentElement.classList.contains('layout-menu-collapsed')
        localStorage.setItem(COLLAPSE_KEY, collapsedNow ? '1' : '0')
      })
    } else {
      console.warn('[Init] window.Helpers tidak tersedia. Cek urutan import helpers.js')
    }

    // — (C) Pin toggle (circle icon)
    const html = document.documentElement
    const pinBtn = document.querySelector('#menu-pin-toggle')
    const PIN_KEY = 'menuPinned'
    const CLASS_COLLAPSED = 'layout-menu-collapsed'

    const updateIcon = () => {
      const pinned = localStorage.getItem(PIN_KEY) === '1'
      const icon = pinBtn?.querySelector('i')
      if (icon) icon.className = pinned ? 'ti ti-circle-filled text-primary' : 'ti ti-circle'
    }

    pinBtn?.addEventListener('click', (e) => {
      e.preventDefault()
      const pinned = !(localStorage.getItem(PIN_KEY) === '1')
      localStorage.setItem(PIN_KEY, pinned ? '1' : '0')

      if (pinned) {
        html.classList.remove(CLASS_COLLAPSED)
        document.body.classList.remove(CLASS_COLLAPSED)
      } else {
        html.classList.add(CLASS_COLLAPSED)
        document.body.classList.add(CLASS_COLLAPSED)
      }
      updateIcon()
    })

    updateIcon()
    if (localStorage.getItem(PIN_KEY) !== '1') {
      html.classList.add(CLASS_COLLAPSED)
      document.body.classList.add(CLASS_COLLAPSED)
    }

    // — (D) Init Menu Vuexy
    const menuEl = document.getElementById('layout-menu')
    if (typeof window.Menu === 'function' && menuEl) {
      if (!window.__vuexyMenu) {
        window.__vuexyMenu = new window.Menu(menuEl, {
          orientation: '',
          animate: true,
          accordion: true,
          showDropdownOnHover: false,
          closeChildren: true,
        })
      }
    } else {
      console.warn('[Init] Vuexy menu.js belum termuat atau #layout-menu tidak ditemukan')
    }

    // — (E) Aktifkan dropdown Bootstrap secara eksplisit (agar pasti jalan)
    try {
      // bootstrap dari vendor UMD biasanya expose ke window.bootstrap
      const Dropdown = window.bootstrap?.Dropdown
      if (Dropdown) {
        document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach((el) => {
          // hindari double init
          if (!el.__dropdown) el.__dropdown = new Dropdown(el)
        })
      }
    } catch (e) {
      console.warn('[Init] Bootstrap Dropdown gagal inisialisasi:', e)
    }
  } catch (err) {
    console.error('Gagal init app:', err)
  }
})