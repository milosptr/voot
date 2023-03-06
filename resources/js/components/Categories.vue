<template>
   <div>
    <div class="flex flex-wrap justify-between items-center gap-3 mb-3">
      <div>
        <span v-if="parentCategory" class="text-sm text-primary-light font-semibold cursor-pointer" @click="changeParentCategory(0)">Go back</span>
      </div>
      <div class="flex justify-between items-center w-[160px] select-none" @click="showUnavailable">
        <input type="checkbox" :checked="displayUnavailable" readonly />
        <span class="text-sm font-semibold cursor-pointer">{{ displayUnavailable ? 'Hide' : 'Show' }} Unavailable</span>
      </div>
    </div>
    <div class="min-w-full bg-gray-50">
      <div class="flex justify-between items-center">
        <div class="w-32 text-center px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
          -
        </div>
        <div class="w-20 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
          Image
        </div>
        <div class="w-1/3 mr-auto py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Name / Slug
        </div>
        <div class="w-24 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
          Status
        </div>
        <div class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Products
        </div>
        <div class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Actions
        </div>
      </div>
    </div>
    <div class="box pb-20">
      <CategoriesItem :categories="categories" :showUnavailable="displayUnavailable" @changed="updateCategories" @changeCategory="changeParentCategory"/>
      <div v-if="hasChanged" class="fixed bottom-0 right-0 p-5 w-full bg-white flex items-center justify-end shadow-2xl border-t">
        <div class="text-white bg-primary-lighter group flex items-center ml-auto px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light" @click="saveCategories">
          Save changes
        </div>
      </div>
    </div>
    <Toastr v-if="showToastr" title="Reordering successfully saved" />
   </div>
</template>

<script>
  import CategoriesItem from "./CategoriesItem.vue";
  import Toastr from "./common/Toastr.vue";

  export default {
    components: {
    CategoriesItem,
    Toastr
    },
    data: () => ({
      categories: [],
      originalCategories: [],
      flatCategories: [],
      parent: 0,
      parentCategory: 0,
      displayUnavailable: false,
      showToastr: false,
    }),
    mounted() {
      this.getCategories()
    },
    methods: {
      updateCategories() {
        const orderedCategories = this.categories.map((c, i) => ({ id: c.id, order: i }))
        axios.post('/api/v2/sorted-categories', orderedCategories)
          .then(() => {
            this.getCategories()
            this.showToastr = true
            setTimeout(() => {
              this.showToastr = false
            }, 2000)
          })
      },
      changeParentCategory(id) {
        this.parent = id
        this.getCategories()
      },
      showUnavailable() {
        this.displayUnavailable = !this.displayUnavailable
      },
      isArrayEqual(x, y) {
        return _(x).xorWith(y, _.isEqual).isEmpty();
      },
      saveCategories() {
        axios.post('/api/sorted-categories', this.categories)
          .then(() => {
            location.reload()
          })
      },
      getCategories() {
        axios.get('/api/product-categories/parent/'+this.parent)
          .then((res) => {
            this.categories = _.cloneDeep(res.data.data)
            if(res.data.data.length)
              this.parentCategory = res.data.data[0]?.parent_id
          })
      },
      reorderCategories(categories, parent = 0) {
        categories.forEach((item, idx) => {
          item.order = idx
          item.parent_id = parent
          if(item.children && item.children.length)
            this.reorderCategories(item.children, item.id)
        })
      },
      extractCategories(categories) {
        categories.forEach((c) => {
          this.flatCategories.push(c)
          if(c.children && c.children.length)
            this.extractCategories(c.children)
        })
      }
    }
  }
</script>

<style>
  .he-tree .tree-placeholder-node {
      background: #f5f5f5;
      border: 2px dashed #1d68a7;
      height: 57px
  }
</style>
