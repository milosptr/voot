<template>
  <div class="flex flex-col gap-4">
    <div class="mt-6 text-sm font-medium text-gray-700">Add tags</div>
    <div class="relative flex items-center">
      <input v-model="newtag" type="text" class="w-full shadow-sm sm:text-sm border-gray-300 rounded" @keydown.enter.prevent="add" >
      <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
        <kbd class="inline-flex items-center border border-gray-200 rounded px-2 text-sm font-sans font-medium text-gray-400">
          ↵ ENTER
        </kbd>
      </div>
    </div>
    <div class="flex flex-wrap gap-2">
      <div v-for="(tag, index) in tags" :key="index"
        class="flex items-center bg-gray-100 text-sm font-mediume px-4 py-1 rounded-md hover:bg-red-500 hover:text-white ease-in-out duration-200 cursor-trash"
        @click="remove(tag.name)"
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
    }),
    computed: {
      tags() {
        return this.$store.getters.product.tags
      }
    },
    methods: {
      add(e) {
        e.preventDefault()
        if(!this.tags.some((t) => t.name === this.newtag))
          axios.post('/api/tags', { name: this.newtag.trim() })
            .then((res) => {
              this.$store.commit('addTag', res.data)
            })
        this.newtag = ''
      },
      remove(tag) {
        this.$store.commit('removeTag', tag)
      }
    }
  }
</script>
