import './bootstrap'
import '../css/app.css'

import { createApp } from 'vue'
import SingleProductVariations from './components/Web/SingleProductVariations.vue'
import GoogleMaps from './components/Web/GoogleMaps.vue'
import ShoppingCart from './components/Web/ShoppingCart.vue'
import axios from 'axios'

const isResponsive =  !!('ontouchstart' in document.documentElement)

if(document.getElementById('single-product-variations')) {
  createApp({
    components: { SingleProductVariations },
    template: `<SingleProductVariations />`
  }).mount("#single-product-variations")
}
if(document.getElementById('google-maps-component')) {
  createApp({
    components: { GoogleMaps },
    template: `<GoogleMaps />`
  }).mount("#google-maps-component")
}

if(document.getElementById('shopping-cart-app')) {
  createApp({
    components: { ShoppingCart },
    template: `<ShoppingCart />`
  }).mount("#shopping-cart-app")
}

const subcategories = document.querySelectorAll('[data-open-subcategory]')
if(subcategories && subcategories) {
  subcategories.forEach((s) => {
    s.addEventListener('click', (e) => {
      const subcategoryEl = e.target.closest('div').querySelector('[data-open-subcategory]')
      const subcategory = subcategoryEl ? subcategoryEl.dataset['openSubcategory'] : null
      if(subcategory) {
        document.querySelector(`[data-subcategory="${subcategory}"]`).classList.toggle('categories-sidebar-opened')
        e.target.closest('svg').classList.toggle('accordion-open')
      }
    })
  })
}

const productGallery = document.getElementById('single-product-bigimage')
if(productGallery) {
  const options = {
    inlinePane: 500,
    containInline: true,
    hoverBoundingBox: true,
    paneContainer: document.querySelector('.drift-zoom-pane'),
  }

  if(document.getElementById('single-product-gallery')) {
    document.getElementById('single-product-gallery').addEventListener('click', (e) => {
      if(e.target.dataset.image) {
        document.querySelector('.single-product-bigimage-url').style = `background-image: url('${e.target.dataset.image}')`
        document.querySelector('.single-product-bigimage-url').dataset.zoom = `${e.target.dataset.image}`

        if(!isResponsive)
          new Drift(document.querySelector('.single-product-bigimage-url'), options);
      }
    })
    if(!isResponsive)
      new Drift(document.querySelector('.single-product-bigimage-url'), options)
  }
}

const searchBtn = document.getElementById('open-search-btn')
if(searchBtn) {
  searchBtn.addEventListener('click', (e) => {
    document.getElementById('nav-search').classList.toggle('hidden')
    searchBtn.classList.toggle('hidden')
    document.querySelector('#nav-search input').focus()
  })
}

const paginationPrev = document.getElementById('pagination--prev')
const paginationNext = document.getElementById('pagination--next')
if(paginationPrev || paginationNext) {
  paginationPrev.addEventListener('click', (e) => {
    const current = e.target.dataset.current
    if(current - 1)
      window.open(`?page=${current - 1}`, '_self')
  })
  paginationNext.addEventListener('click', (e) => {
    const current = e.target.dataset.current
    const page = parseInt(current) + 1;
    window.open(`?page=${page}`, '_self')
  })
}

const navigation = document.getElementById('main-menu')
const openMenuBtn = document.getElementById('open-menu-btn')
const closeMenuBtn = document.getElementById('close-menu-btn')

if(openMenuBtn && closeMenuBtn) {
  openMenuBtn.addEventListener('click', () => {
    navigation.classList.add('active')
  })
  closeMenuBtn.addEventListener('click', () => {
    navigation.classList.remove('active')
  })
}

if(document.getElementById('register-me')) {
  document.getElementById('ssn').addEventListener('change', (e) => {
    axios.get(`/api/check-ssn/${e.target.value}`)
    .then((res) => {
      if(res.data) {
        document.getElementById('account-exists-alert').classList.remove('hidden')
      } else {
        document.getElementById('account-exists-alert').classList.add('hidden')
      }
    })
  })
}
