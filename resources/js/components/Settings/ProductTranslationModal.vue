<template>
  <div class="fixed top-0 left-0 w-full h-screen flex items-center justify-center">
    <div class="absolute left-0 top-0 w-full h-screen bg-gray-900 opacity-50 z-10" @click="$emit('close')"></div>
    <div class="relative w-full lg:w-2/3 bg-white rounded-md shadow py-12 px-6 z-20">
      <div class="flex">
        <div class="w-1/2 mr-3">
          <input
            id="products-category-search"
            type="text"
            class="w-full group px-3 py-2 text-sm font-normal rounded-md border-gray-500 bg-transparent mb-6"
            readonly
            :value="product.name"
          />
          <ckeditor :editor="editor" v-model="product.description" :config="editorConfig" @ready="onReady"></ckeditor>
        </div>
        <div class="w-1/2 ml-3">
          <input
            v-model="product.english_name"
            id="products-category-search"
            type="text"
            class="w-full group px-3 py-2 text-sm font-normal rounded-md border-gray-500 bg-transparent mb-6"
          />
          <ckeditor :editor="editor" v-model="product.english_description" :config="editorConfig"></ckeditor>
        </div>
      </div>
      <div class="w-full lg:w-1/3 ml-auto flex justify-between mt-10">
        <div class="w-2/5 text-center text-gray-600 border border-gray-200  px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-200 hover:text-white cursor-pointer" @click="$emit('close')">
          Cancel
        </div>
        <div class="w-2/5 text-center text-white border border-primary-lighter bg-primary-lighter px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light cursor-pointer" @click="save">
          Save
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import CKEditor from '@ckeditor/ckeditor5-vue'
  import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

  export default {
    components: {
      ckeditor: CKEditor.component,
    },
    props: {
      product: {
        type: Object,
        default: () => {}
      }
    },
    data: () => ({
      editor: ClassicEditor,
      editorConfig: {
        height: 200,
      },
    }),
    mounted() {
    },
    methods: {
      onReady(editor) {
        editor.isReadOnly = true
      },
      save() {
        axios.post('/api/products/update/', { product_id: this.product.id, english_name: this.product.english_name, english_description: this.product.english_description })
          .then((res) => {
            this.$emit('close')
          })
      }
    }
  }
</script>

<style>
  .ck.ck-editor__main .ck-content {
    max-height: 300px;
    height: 300px;
    overflow: scroll;
  }
</style>
