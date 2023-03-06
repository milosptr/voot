<template>
  <draggable
    class="dragArea"
    tag="ul"
    :list="categories"
    :group="{ name: 'g1', put: (toSortable, fromSortable, draggedElement) => topLevelContainerFilter(toSortable, fromSortable, draggedElement) }"
    @end="$emit('changed')"
    item-key="name"
  >
    <template #item="{ element }">
      <li :class="{'hidden': !showUnavailable && !element.available}">
        <div class="flex justify-between items-center cursor-pointer bg-white border-b border-gray-100 hover:bg-gray-50">
          <div class="py-1 pl-4 whitespace-nowrap">
           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#454545" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="60" cy="60" r="8"></circle><circle cx="128" cy="60" r="8"></circle><circle cx="196" cy="60" r="8"></circle><circle cx="60" cy="128" r="8"></circle><circle cx="128" cy="128" r="8"></circle><circle cx="196" cy="128" r="8"></circle><circle cx="60" cy="196" r="8"></circle><circle cx="128" cy="196" r="8"></circle><circle cx="196" cy="196" r="8"></circle></svg>
          </div>
          <div class="w-20 py-1 whitespace-nowrap flex justify-center items-center">
            <div v-if="element.featured_image" class="w-8 h-8 rounded-full bg-center bg-cover bg-no-repeat" :style="`background-image: url('/${element.featured_image.file_path}');`"></div>
            <div v-else class="w-8 h-8 rounded-full bg-center bg-cover bg-no-repeat" style="background: #eee;"></div>
          </div>
          <div class="w-1/3 mr-auto py-1 whitespace-nowrap" @click="changeCategory(element)">
            <div class="flex items-start gap-2">
              <div>
                <div class="font-medium text-gray-700">
                  {{ element.name }}
                </div>
                <div class="text-xs font-light text-gray-400">
                  {{ element.slug }}
                </div>
              </div>
              <div class="group relative">
                <img v-if="element.children.length" :src="'/images/subcategories-icon.svg'" width="16" height="16" class="mt-1" alt="Subcategories" />
                <div class="absolute hidden group-hover:block left-4 top-0 py-2 px-3 rounded-lg shadow-md bg-white z-10">
                  <div class="flex flex-col gap-2 w-full">
                    <div v-for="c in element.children" :key="c.id" class="text-sm w-full">
                      {{ c.name }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-24 text-center py-1 whitespace-nowrap">
              <span v-if="element.available" class="px-2 inline-flex text-xs leading-5 tracking-wide font-normal rounded-full bg-green-100 text-green-800">
                Available
              </span>
              <span v-else class="px-2 inline-flex text-xs leading-5 tracking-wide font-normal rounded-full bg-gray-100 text-gray-800">
                Unavailable
              </span>
          </div>
          <div class="w-32 px-6 py-1 whitespace-nowrap text-sm text-gray-500">
              {{ element.total_products }} products
          </div>
          <div class="w-32 px-6 py-1 whitespace-nowrap">
            <div class="flex items-center justify-center">
              <a :href="'/backend/categories/edit/' + element.id" class="flex items-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
              </a>
              <div class="ml-5 flex items-center justify-center">
                <div class="w-5 h-5 cursor-pointer flex items-center relative" @click="deleteCategory(element.id)">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="#dc2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <CategoriesItem :categories="element.children" /> -->
      </li>
    </template>
  </draggable>
</template>
<script>
import draggable from "vuedraggable";
export default {
  name: "CategoriesItem",
  components: {
    draggable
  },
  props: {
    categories: {
      required: true,
      type: Array
    },
    showUnavailable: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    changeCategory(category) {
      if(category.children.length)
        this.$emit('changeCategory', category.id, category)
    },
    deleteCategory(id) {
      axios.delete('/api/product-categories/' + id)
        .then((res) => {
          location.reload()
        })
        .catch(() => {
          location.reload()
        })
    },
    topLevelContainerFilter(toSortable, fromSortable, draggedElement) {
      let isElement = (fromSortable.options.group.name === 'g1');
      let notContainerOrTopLevel = (toSortable.el.classList.contains('top__level') || !draggedElement.classList.contains('g1'))
      console.log('smth')

      return isElement && notContainerOrTopLevel;
    }
  }
};
</script>
<style scoped>
.dragArea {
  margin: 0;
  padding: 0;
}

li {
  list-style: none;
}

</style>
