<template>
  <div class="mt-6">
    <div v-for="(page, index) in pages" class="border-b border-gray-200 pb-6 mb-6" :key="index">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label :for="'title-'+ index" class="block text-sm font-medium text-gray-700">Title</label>
          <input v-model="page.title" type="text" :id="'title-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" @change="createSlug(index)"  />
        </div>
        <div>
          <label :for="'slug-'+ index" class="block text-sm font-medium text-gray-700">Slug (auto generating)</label>
          <input v-model="page.slug" type="text" :id="'slug-'+ index" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" readonly />
        </div>
      </div>
      <label :for="'content-'+ index" class="block text-sm font-medium text-gray-700 mt-6 mb-1">Page content</label>
      <ckeditor :editor="editor" v-model="page.content" :config="editorConfig"></ckeditor>
    </div>
     <div class="flex justify-between">
      <div tabindex="0" class="w-48 mr-3 text-center text-gray-600 border border-gray-400 bg-transparent px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white cursor-pointer" @keydown.enter="addPage" @click="addPage">
        Add page
      </div>
      <div tabindex="0" class="w-32 select-none text-center text-white border border-primary-light bg-primary-light px-6 py-2 mt-5 text-sm font-normal rounded-md hover:bg-primary-lighter hover:text-white cursor-pointer" @keydown.enter="save" @click="save">
        Save
      </div>
    </div>
  </div>
</template>

<script>
  import CKEditor from '@ckeditor/ckeditor5-vue'
  import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
  import slugify from 'slugify'

  export default {
    components: {
      ckeditor: CKEditor.component,
    },
    data: () => ({
      pages: [],
      editor: ClassicEditor,
      editorConfig: {
        height: 200,
      },
    }),
    mounted() {
      axios.get('/api/pages')
        .then((res) => {
          this.pages = res.data
        })
    },
    methods: {
      addPage() {
        this.pages.push({})
      },
      createSlug(index) {
        const options = { lower: true, trim: true, locale: 'en' }
        this.pages[index].slug = slugify(this.pages[index].title, options)
      },
      save() {
        const pages = this.pages.filter((p) => p.title)
        axios.post('/api/pages', this.pages)
        .then((res) => {
          this.$emit('saved')
        })
      },
    }
  }
</script>
