<template>
  <div>
    <div v-for="(icon, index) in icons" :key="index" class="single-variant py-5 border-t border-gray-200 flex items-end">
      <div class="w-14 h-14">
        <label :for="'variation-img-'+index" class="dropzone-placeholder h-full flex items-center justify-center text-center cursor-pointer">
          <img v-if="icon.file_path" :src="icon.file_path" alt="variation-image" class="w-14 h-14 rounded-md" />
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" viewBox="0 0 24 24" fill="none" stroke="#d4d4d8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
          <input type="file" :id="'variation-img-'+index" @change="uploadImage($event,icon, index)" hidden />
        </label>
      </div>
      <div class="w-1/2 px-3 ml-3">
          <label :for="'name-'+ index" class="block text-sm font-medium text-gray-700">Name</label>
          <input v-model="icon.name" type="text" :id="'name-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"  />
      </div>
      <div v-if="icon.id" class="px-3 ml-3 mb-2 cursor-pointer">
        <img :src="'/images/trash.svg'" width="24" height="24" alt="delete">
      </div>
    </div>
    <div class="flex justify-between">
      <div tabindex="0" class="w-48 mr-3 text-center text-gray-600 border border-gray-400 bg-transparent px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white cursor-pointer" @keydown.enter="addNewIcon" @click="addNewIcon">
        Add new icon
      </div>
      <div tabindex="0" class="w-32 select-none text-center text-white border border-primary-light bg-primary-light px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-primary-lighter hover:text-white cursor-pointer" @keydown.enter="save" @click="save">
        Save
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'ProductIcons',
    data: () => ({
      icons: []
    }),
    mounted() {
      axios.get('/api/settings-icons')
        .then((res) => {
          this.icons = res.data
          this.addNewIcon()
        })
        .catch(() => {
          this.addNewIcon()
        })
    },
    methods: {
      addNewIcon() {
        this.icons.push({ id: 0, name: '', file_path: '' })
      },
      save() {
        this.icons = this.icons.filter((i) => {
          if(i.name !== '')
            return i
        })
        axios.post('/api/settings-icons', this.icons)
          .then(() => {
            this.$emit('saved')
            this.addNewIcon()
          })
      },
      uploadImage(e, icon, index) {
        const formData = new FormData()
        formData.append('file', e.target.files[0])
        axios.post('/api/assets', formData)
          .then((response) => {
            this.icons[index].file_path = '/' + response.data.file_path
          })
      }
    }
  }
</script>
