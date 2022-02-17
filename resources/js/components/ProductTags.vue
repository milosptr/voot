<template>
  <div class="flex flex-col gap-4">
    <div class="relative flex items-center">
      <input v-model="newtag" type="text" class="w-full shadow-sm sm:text-sm border-gray-300 rounded" @keydown.enter.prevent="add" >
      <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
        <kbd class="inline-flex items-center border border-gray-200 rounded px-2 text-sm font-sans font-medium text-gray-400">
          ↵ ENTER
        </kbd>
      </div>
    </div>
    <input id="product-tags-list" type="text" name="tags" hidden />
    <input id="product-remove-tags" type="text" name="remove-tags" hidden />
    <div v-if="tags.length" class="flex flex-wrap gap-2">
      <div v-for="(tag, index) in tags" :key="index"
        class="flex items-center bg-gray-100 text-sm font-mediume px-4 py-1 rounded-md hover:bg-red-500 hover:text-white ease-in-out duration-200 cursor-trash"
        @click="remove(index, tag.id)"
      >
        #{{ tag.name }}
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      newtag: '',
      tags: [],
      tagsToRemove: [],
      product_id: null
    }),
    computed: {
      joinedTags() {
        return this.tags.filter((t) => t.id === 0).map((t) => t.name).join(',')
      }
    },
    mounted() {
      this.product_id = document.getElementById('product-documents').dataset.key
      if(this.product_id) {
        axios.get(`/api/product-tags/${this.product_id}`)
          .then((res) => {
            this.tags = res.data
          })
      }
    },
    methods: {
      add(e) {
        e.preventDefault()
        this.tags.push({ id: 0, name: this.newtag.trim() })
        this.newtag = ''
        document.getElementById('product-tags-list').setAttribute('value', this.joinedTags)
      },
      remove(index, id) {
        this.tags.splice(index, 1)
        if(id) {
          this.tagsToRemove.push(id)
        }
        document.getElementById('product-tags-list').setAttribute('value', this.joinedTags)
        document.getElementById('product-remove-tags').setAttribute('value', this.tagsToRemove.join(','))
      }
    }
  }
</script>
