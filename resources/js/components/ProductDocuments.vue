<template>
  <div class="bg-white overflow-hidden shadow rounded-lg mt-6">
    <div class="px-4 py-5 sm:p-6">
      <div class="text-lg text-black font-medium">Product Documents</div>
      <div class="text-gray-500 text-sm">(documents will be saved only if product is updated)</div>
      <div class="flex gap-4 mt-4">
        <input v-model="documentName" name="doc_name" type="text" placeholder="Document name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
        <label for="product-documents-upload" class="w-full relative flex items-center shadow-sm sm:text-sm border-gray-300 border rounded-md cursor-pointer hover:border-primary-lighter" style="height: 38px">
          <input id="product-documents-upload" type="file" multiple hidden @change="calculateFiles()" />
          <div v-if="inputFiles" class="absolute inset-y-0 left-0 flex items-center 5 pl-4 font-bold uppercase tracking-wider text-primary-lighter text-xs leading-none">
            {{ inputFilesText }}
          </div>
          <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
            <kbd class="inline-flex items-center border border-gray-200 rounded px-2 text-sm font-sans font-medium text-gray-400">
              ＋ CLICK TO UPLOAD
            </kbd>
          </div>
        </label>
        <div class="text-center text-gray-600 border border-gray-200 px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-200 cursor-pointer" @click="upload()">Add</div>
      </div>
      <div class="flex flex-col gap-4">
        <div class="mt-4">
          <div v-for="document in documents" :key="document.id" class="flex justify-between items-center selected-category-item py-1 border-b border-gray-100 cursor-pointer"
            @click="openDocument(document)">
            <div class="pl-2 text-sm">{{ document.name }}</div>
            <div class="pr-2 tracking-widest text-3xl font-thin leading-none text-gray-400 cursor-pointer hover:text-rose-500" @click.stop="remove(document.id)">×</div>
          </div>
        </div>
        <input id="documents-id" type="text" name="documents" hidden />
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      documentName: '',
      inputFiles: 0,
      documents: [],
      documentIds: [],
      product_id: null,
    }),
    computed: {
      inputFilesText() {
        if(this.inputFiles > 1)
          return this.inputFiles + ' files'
        return this.inputFiles + ' file'
      }
    },
    mounted() {
      this.product_id = document.getElementById('product-documents').dataset.key
      if(this.product_id)
        axios.get(`/api/documents/${this.product_id}`)
          .then((response) => {
            const ids = response.data.map((i) => i.id)
            this.documents.push(...response.data)
            this.documentIds.push(...ids)
          })
    },
    methods: {
      calculateFiles() {
        this.inputFiles = document.getElementById('product-documents-upload').files.length
      },
      upload() {
        const formData = new FormData()
        const documentFiles = document.getElementById('product-documents-upload').files
        for (let i = 0; i < documentFiles.length; i++) {
            formData.append("documents[]", documentFiles[i]);
        }
        formData.append('name', this.documentName)

        axios.post('/api/documents', formData)
          .then((response) => {
            const ids = response.data.map((i) => i.id)
            this.documents.push(...response.data)
            this.documentIds.push(...ids)
            this.reset()
            document.getElementById('documents-id').setAttribute('value', this.documentIds.join(','))
          })
      },
      openDocument(doc) {
        const url = "/" + doc.file_path
        window.open(url, '_blank')
      },
      reset() {
        this.documentName = ''
        this.inputFiles = 0
        document.getElementById('product-documents-upload').value = ""
      },
      remove(id) {
        axios.delete(`/api/documents/${id}`).then((r) => {
          this.documentIds = this.documentIds.filter((i) => id !== i)
          this.documents = this.documents.filter((item) => item.id !== id)
          document.getElementById('documents-id').setAttribute('value', this.documentIds.join(','))
        })
      }
    }
  }
</script>
