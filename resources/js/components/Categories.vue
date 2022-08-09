<template>
  <div class="box pb-20">
    <CategoriesItem :categories="categories" @changed="getCategories" />
    <div v-if="hasChanged" class="fixed bottom-0 right-0 p-5 w-full bg-white flex items-center justify-end shadow-2xl border-t">
      <div class="text-white bg-primary-lighter group flex items-center ml-auto px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light" @click="saveCategories">
        Save changes
      </div>
    </div>
  </div>
</template>

<script>
  import CategoriesItem from "./CategoriesItem.vue";

  export default {
    components: {
      CategoriesItem
    },
    data: () => ({
      categories: [],
      originalCategories: [],
      flatCategories: [],
    }),
    watch: {
      categories: {
        handler(val) {
          this.reorderCategories(this.categories)
        },
        deep: true,
      }
    },
    computed: {
      hasChanged() {
        return JSON.stringify(this.originalCategories) !== JSON.stringify(this.categories)
      }
    },
    mounted() {
      this.getCategories()
    },
    methods: {
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
        axios.get('/api/product-categories')
          .then((res) => {
            this.categories = _.cloneDeep(res.data.data)
            this.originalCategories = _.cloneDeep(res.data.data)
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
