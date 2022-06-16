<template>
  <Tree :value="categories" :ondragstart="(tree, store) => isDraggable(tree,store)" :ondragend="(tree, store) => onDragEnd(tree, store)">
    <template v-slot="{ node, index, path }">
      <div :data-key="node.id" class="flex justify-between items-center cursor-pointer bg-white border-b border-gray-100 hover:bg-gray-50">
        <div class="py-2 pl-4 whitespace-nowrap" :style="indentWidth(path)">
            <svg v-if="node.parent_id" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#454545" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="60" cy="60" r="8"></circle><circle cx="128" cy="60" r="8"></circle><circle cx="196" cy="60" r="8"></circle><circle cx="60" cy="128" r="8"></circle><circle cx="128" cy="128" r="8"></circle><circle cx="196" cy="128" r="8"></circle><circle cx="60" cy="196" r="8"></circle><circle cx="128" cy="196" r="8"></circle><circle cx="196" cy="196" r="8"></circle></svg>
        </div>
        <div class="w-20 py-2 whitespace-nowrap flex justify-center items-center">
          <div v-if="node.featured_image" class="w-10 h-10 rounded-full bg-center bg-cover bg-no-repeat" :style="`background-image: url('/${node.featured_image.file_path}');`"></div>
          <div v-else class="w-10 h-10 rounded-full bg-center bg-cover bg-no-repeat" style="background: #eee;"></div>
        </div>
        <div class="w-1/3 mr-auto py-2 whitespace-nowrap">
          <div class="font-medium text-gray-700">
            {{ node.name }}
          </div>
          <div class="text-xs font-light text-gray-400">
            {{ node.slug }}
          </div>
        </div>
        <div class="w-24 text-center py-2 whitespace-nowrap">
            <span v-if="node.available" class="px-2 inline-flex text-xs leading-5 tracking-wide font-normal rounded-full bg-green-100 text-green-800">
              Available
            </span>
            <span v-else class="px-2 inline-flex text-xs leading-5 tracking-wide font-normal rounded-full bg-gray-100 text-gray-800">
              Unavailable
            </span>
        </div>
        <div class="w-32 px-6 py-2 whitespace-nowrap text-sm text-gray-500">
            {{ node.total_products }} products
        </div>
        <div class="w-32 px-6 py-2 whitespace-nowrap">
          <div class="flex items-center justify-center">
            <a :href="'/backend/categories/edit/' + node.id" class="flex items-center">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </a>
            <div class="ml-5 flex items-center justify-center">
              <div :data-id="node.id" :data-name="node.name" class="delete-product-btn w-5 h-5 cursor-pointer flex items-center relative">
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </Tree>
</template>

<script>
  import {Tree, Draggable, Fold} from 'he-tree-vue'

  export default {
     components: {
      Tree: Tree.mixPlugins([Draggable, Fold])
    },
    data: () => ({
      drag: false,
      categories: [],
    }),
    mounted() {
      axios.get('/api/product-categories')
        .then((res) => {
          this.categories = res.data.data
        })
    },
    methods: {
      isDraggable(tree, store) {
        return !!store.dragNode.parent_id
      },
      onDragEnd(tree,store) {
        if(store.targetPath.length > 3)
          return false
        setTimeout(() => {
          this.saveNewCategoryTree()
        }, 200);
        return true
      },
      indentWidth(path) {
        const indent = 128 - (path.length - 1) * 20
        return `width: ${indent}px`
      },
      saveNewCategoryTree() {
        axios.post('/api/sorted-categories', this.categories)
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
