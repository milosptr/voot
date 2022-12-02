<template>
  <div v-if="$store.getters.productLoaded" class="grid sm:grid-cols-3 gap-6">
    <div class="sm:col-span-2 grid grid-cols-1 gap-6">
      <div class="bg-white overflow-hidden shadow rounded-lg px-4 py-5 sm:p-6">
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
          <input :value="product.name" @input="updateField('name', $event)" type="text" name="name" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required="">
        </div>
        <div class="mt-6">
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <ckeditor :editor="editor" :model-value="product.description" @input="updateEditorField('description', $event)" :config="editorConfig"></ckeditor>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-6">
          <div class="">
            <label for="latin" class="block text-sm font-medium text-gray-700">Latin (species)</label>
            <input :value="product.species" @input="updateField('species', $event)" type="text" name="species" id="latin" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
          </div>
          <div class="">
            <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
            <input :value="product.label" @input="updateField('label', $event)" type="text" name="label" id="label" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
          </div>
        </div>
      </div>
      <div class="bg-white overflow-hidden shadow rounded-lg px-4 py-5 sm:p-6">
        <div class="text-lg text-black font-medium">Inventory</div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <div class="">
            <label for="sku" class="block text-sm font-medium text-gray-700">SKU (Stock Keeping Unit)</label>
            <input :value="product.sku" @input="updateField('sku', $event)" type="text" name="sku" id="sku" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required="">
            <div v-if="product.duplicates.count" class="text-red-500 text-sm mt-1 ml-1 cursor-pointer" @click="toggleDuplicatesModal">{{ product.duplicates.count }} duplicated SKUs</div>
          </div>
          <div class="">
            <label for="quantity_name" class="block text-sm font-medium text-gray-700">Quantity name</label>
            <select
              id="quantity_name"
              class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
              :value="product.quantity_name"
              @change="updateField('quantity_name', $event)"
            >
              <option value="0">Quantity / Magn</option>
              <option value="1">Pallets / Bretti</option>
              <option value="2">Meters / Metrar</option>
              <option value="3">Par / Pairs</option>
              <option value="4">Stk / Peaces</option>
              <option value="5">Rúlla / Rolls</option>
              <option value="6">Pakki / Packages</option>
              <option value="7">Poki / Bags</option>
              <option value="8">Tunna / Barrels</option>
              <option value="9">Kassi / Boxes</option>
              <option value="10">Balli / Packs</option>
              <option value="11">Brúsi / Cans</option>
              <option value="12">Búnt / Bundle</option>
            </select>
          </div>
        </div>
      </div>
      <ProductDocuments />
      <ProductInformation />
      <ProductVariations />
      <ProductTable v-if="product && product.id" />
    </div>
    <div class="flex flex-col gap-6">
      <ProductAvailability />
      <ProductCategories />
      <ProductIcons />
      <Media />
    </div>
    <DuplicatesModal :show="showDuplicatesModal" :products="product.duplicates.products" @close="showDuplicatesModal = false" />
  </div>
</template>

<script>
  import CKEditor from '@ckeditor/ckeditor5-vue'
  import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
  import ProductDocuments from './ProductDocuments.vue'
  import ProductInformation from './ProductInformation.vue'
  import ProductAvailability from './ProductAvailability.vue'
  import ProductCategories from './ProductCategories.vue'
  import ProductIcons from './ProductIcons.vue'
  import ProductTable from './ProductTable.vue'
  import ProductVariations from './Variations/ProductVariations.vue'
  import Media from './Media/Media.vue'
  import DuplicatesModal from './Modals/DuplicatesModal.vue'

  export default {
    components: {
      ckeditor: CKEditor.component,
      ProductDocuments,
      ProductInformation,
      ProductAvailability,
      ProductCategories,
      ProductIcons,
      ProductVariations,
      ProductTable,
      Media,
      DuplicatesModal,
    },
    data: () => ({
      editor: ClassicEditor,
      editorConfig: {
        height: 200,
      },
      showDuplicatesModal: false,
    }),
    computed: {
      product() {
        return this.$store.getters.product
      }
    },
    mounted() {
      const id = document.getElementById('editSingleProduct').dataset.key
      this.$store.dispatch('getProduct', id)
      this.$store.dispatch('getCategories')
      this.$store.dispatch('getIcons')
    },
    methods: {
      toggleDuplicatesModal() {
        this.showDuplicatesModal = !this.showDuplicatesModal
      },
      updateField(key, evt) {
        if(key === 'quantity_name')
          this.$store.commit('updateProductField', {key, value: parseInt(evt.target.value)})
        this.$store.commit('updateProductField', {key, value: evt.target.value})
      },
      updateEditorField(key, value) {
       this.$store.commit('updateProductField', {key, value})
      },
    }
  }
</script>
