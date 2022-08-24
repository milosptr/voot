<template>
  <div>
    <div v-for="(color, index) in colors" :key="index" class="single-variant py-5 border-t border-gray-200 flex items-end">
      <div class="w-1/3 px-3 ml-3">
          <label :for="'name-'+ index" class="block text-sm font-medium text-gray-700">Name</label>
          <input v-model="color.name" type="text" :id="'name-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
      </div>
      <div class="w-1/3 px-3 ml-3">
          <label :for="'name-'+ index" class="block text-sm font-medium text-gray-700">Name English</label>
          <input v-model="color.name_en" type="text" :id="'name-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
      </div>
      <div class="px-3 ml-3">
        <label :for="'color-'+ index" class="block text-sm font-medium text-gray-700">Color</label>
        <input v-model="color.hex" type="color" class="mt-1 rounded-full overflow-hidden">
      </div>
      <div v-if="color.id" class="px-3 ml-3 mb-2 cursor-pointer" @click="deleteColor(color.id)">
        <img :src="'/images/trash.svg'" width="24" height="24" alt="delete">
      </div>
  </div>
    <div class="flex justify-between">
      <div tabindex="0" class="w-48 mr-3 text-center text-gray-600 border border-gray-400 bg-transparent px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white cursor-pointer" @keydown.enter="addNewIcon" @click="addNewIcon">
        Add new color
      </div>
      <div tabindex="0" class="w-32 select-none text-center text-white border border-primary-light bg-primary-light px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-primary-lighter hover:text-white cursor-pointer" @keydown.enter="save" @click="save">
        Save
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'Colors',
    data: () => ({
      colors: []
    }),
    mounted() {
      axios.get('/api/colors')
        .then((res) => {
          this.colors = res.data
          this.addNewColor()
        })
        .catch(() => {
          this.addNewColor()
        })
    },
    methods: {
      addNewColor() {
        this.colors.push({ id: 0, name: '', name_en: '', hex: '#ffffff' })
      },
      deleteColor(id) {
        axios.delete('/api/colors/' + id)
        .then((res) => {
          this.colors = res.data
          this.addNewColor()
        })
      },
      save() {
        this.colors = this.colors.filter((i) => {
          if(i.name !== '')
            return i
        })
        axios.post('/api/colors', this.colors)
          .then((res) => {
            this.colors = res.data
            this.$emit('saved')
            this.addNewColor()
          })
      },
    }
  }
</script>

<style scoped>
  input[type="color"] {
	-webkit-appearance: none;
	border: 1px solid #999;
	width: 38px;
	height: 38px;
}
input[type="color"]::-webkit-color-swatch-wrapper {
	padding: 0;
}
input[type="color"]::-webkit-color-swatch {
	border: none;
}
</style>
