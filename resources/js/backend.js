const { default: axios } = require('axios')
require('./bootstrap')
require('./scripts/backend')

import { createApp } from "vue"
import Variations from './components/Variations/Variations.vue'
import Media from './components/Media/Media.vue'
import ProductTags from './components/ProductTags.vue'
import ProductDocuments from './components/ProductDocuments.vue'
import ProductInformation from './components/ProductInformation.vue'
import ProductTable from './components/ProductTable.vue'
import ProductIcons from './components/ProductIcons.vue'
import Settings from './components/Settings.vue'

if(document.getElementById('variations-app')) {
  createApp({
    components: { Variations },
    template: `<Variations />`
  }).mount("#variations-app");
}
if(document.getElementById('media-upload')) {
  createApp({
    components: { Media },
    template: `<Media />`
  }).mount("#media-upload");
}

if(document.getElementById('product-tags')) {
  createApp({
    components: { ProductTags },
    template: `<ProductTags />`
  }).mount("#product-tags");
}

if(document.getElementById('product-documents')) {
  createApp({
    components: { ProductDocuments },
    template: `<ProductDocuments />`
  }).mount("#product-documents");
}

if(document.getElementById('single-product-info')) {
  createApp({
    components: { ProductInformation },
    template: `<ProductInformation />`
  }).mount("#single-product-info")
}

if(document.getElementById('single-product-table')) {
  createApp({
    components: { ProductTable },
    template: `<ProductTable />`
  }).mount("#single-product-table")
}

if(document.getElementById('product-icons')) {
  createApp({
    components: { ProductIcons },
    template: `<ProductIcons />`
  }).mount("#product-icons");
}

if(document.getElementById('settings')) {
  createApp({
    components: { Settings },
    template: `<Settings />`
  }).mount("#settings")
}
