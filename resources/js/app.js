const { default: axios } = require('axios')
require('./bootstrap')
require('./scripts/Drift.min.js')

import { createApp } from 'vue'
import SingleProductVariations from './components/Web/SingleProductVariations.vue'
import GoogleMaps from './components/Web/GoogleMaps.vue'
import ShoppingCart from './components/Web/ShoppingCart.vue'

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
        document.querySelector(`[data-subcategory="${subcategory}"]`).classList.toggle('max-h-96')
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

  document.getElementById('single-product-gallery').addEventListener('click', (e) => {
    if(e.target.dataset.image) {
      document.querySelector('.single-product-bigimage-url').style = `background-image: url('${e.target.dataset.image}')`
      document.querySelector('.single-product-bigimage-url').dataset.zoom = `${e.target.dataset.image}`


      new Drift(document.querySelector('.single-product-bigimage-url'), options);
    }
  })
  new Drift(document.querySelector('.single-product-bigimage-url'), options)
}

const searchBtn = document.getElementById('open-search-btn')
if(searchBtn) {
  searchBtn.addEventListener('click', (e) => {
    document.getElementById('nav-search').classList.toggle('hidden')
    searchBtn.classList.toggle('hidden')
    document.querySelector('#nav-search input').focus()
  })
}
