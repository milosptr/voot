import './bootstrap'
import '../css/app.css'
import './scripts/backend'

import { createApp } from 'vue'

import Variations from './components/Variations/Variations.vue'
import Media from './components/Media/Media.vue'
import CustomerLogo from './components/Media/CustomerLogo.vue'
import ProductTags from './components/ProductTags.vue'
import ProductDocuments from './components/ProductDocuments.vue'
import ProductInformation from './components/ProductInformation.vue'
import ProductTable from './components/ProductTable.vue'
import ProductIcons from './components/ProductIcons.vue'
import Settings from './components/Settings.vue'
import OrdersChart from './components/OrdersChart.vue'
import Categories from './components/Categories.vue'
import EditOrder from './components/EditOrder.vue'
import EditSingleProduct from './components/EditSingleProduct.vue'
import MembersInfo from './components/MembersInfo.vue'
import MyClients from './components/MyClients.vue'
import { CKEditor } from '@ckeditor/ckeditor5-vue'
import store from './store'

if (document.getElementById('variations-app')) {
  createApp({
    components: { Variations },
    template: `<Variations />`
  }).mount('#variations-app')
}
if (document.getElementById('media-upload')) {
  createApp({
    components: { Media },
    template: `<Media />`
  }).mount('#media-upload')
}
if (document.getElementById('adminCategories')) {
  createApp({
    components: { Categories },
    template: `<Categories />`
  }).mount('#adminCategories')
}

if (document.getElementById('product-tags')) {
  createApp({
    components: { ProductTags },
    template: `<ProductTags />`
  }).mount('#product-tags')
}

if (document.getElementById('product-documents')) {
  createApp({
    components: { ProductDocuments },
    template: `<ProductDocuments />`
  }).mount('#product-documents')
}

if (document.getElementById('single-product-info')) {
  createApp({
    components: { ProductInformation },
    template: `<ProductInformation />`
  }).mount('#single-product-info')
}

if (document.getElementById('single-product-table')) {
  createApp({
    components: { ProductTable },
    template: `<ProductTable />`
  }).mount('#single-product-table')
}

if (document.getElementById('product-icons')) {
  createApp({
    components: { ProductIcons },
    template: `<ProductIcons />`
  }).mount('#product-icons')
}

if (document.getElementById('settings')) {
  createApp({
    components: { Settings },
    template: `<Settings />`
  }).mount('#settings')
}
if (document.getElementById('upload-customer-logo')) {
  createApp({
    components: { CustomerLogo },
    template: `<CustomerLogo />`
  }).mount('#upload-customer-logo')
}
if (document.getElementById('ordersChart')) {
  createApp({
    components: { OrdersChart },
    template: `<OrdersChart />`
  }).mount('#ordersChart')
}
if (document.getElementById('edit-order')) {
  createApp({
    components: { EditOrder },
    template: `<EditOrder />`
  }).mount('#edit-order')
}
if (document.getElementById('editSingleProduct')) {
  createApp({
    components: { EditSingleProduct },
    template: `<EditSingleProduct />`
  })
    .use(store)
    .mount('#editSingleProduct')
}
if (document.getElementById('members-info')) {
  createApp({
    components: { MembersInfo },
    template: `<MembersInfo />`
  })
    .use(store)
    .mount('#members-info')
}

if (document.getElementById('my-clients-section')) {
  createApp({
    components: { MyClients },
    template: `<MyClients />`
  })
    .use(store)
    .mount('#my-clients-section')
}

// JS
const adminNav = document.getElementById('admin-navigation')
const openAdminNav = document.getElementById('open-admin-navigation')
const closeAdminNav = document.getElementById('close-admin-navigation')

if (openAdminNav && closeAdminNav) {
  openAdminNav.addEventListener('click', () => {
    adminNav.classList.add('active')
  })
  closeAdminNav.addEventListener('click', () => {
    adminNav.classList.remove('active')
  })
}
