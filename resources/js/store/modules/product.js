const product = {
  state: () => ({
    product: {},
    categories: [],
    icons: [],
    productLoaded: false,
  }),

  actions: {
    getProduct({ commit }, id) {
      axios.get('/api/products/' + id)
        .then((res) => {
          commit('setProduct', res.data.data)
        })
    },
    getCategories({ commit }) {
      axios.get('/api/product-categories')
        .then((res) => {
          commit('setCategories', res.data.data)
        })
    },
    getIcons({ commit }) {
      axios.get('/api/settings-icons')
        .then((res) => {
          commit('setIcons', res.data)
        })
    },
    updateProduct({ commit, state }) {
      axios.post('/api/products/edit/' + state.product.id, state.product)
        .then((res) => {
            document.body.insertAdjacentHTML('beforeend', `
            <div class="success-alert fixed right-0 top-0 mt-10 m-10 shadow bg-green-100 border-l-4 border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
              <strong class="font-bold">Success!</strong>
              <span class="block sm:inline">Product successfully updated.</span>
            </div>
          `)
          history.go()
          setTimeout(() => {
            document.querySelector('.success-alert').remove()
          }, 4000);
      })
    }
  },

  mutations: {
    setProduct( state, product ) {
      state.product = product
      state.productLoaded = true
    },
    setCategories( state, categories ) {
      state.categories = categories
    },
    setIcons( state, icons ) {
      state.icons = icons
    },
    updateProductField(state, obj) {
      state.product[obj.key] = obj.value
    },
    appendDocument(state, documents) {
      state.product.documents.push(...documents)
    },
    removeDocument(state, id) {
      state.product.documents = state.product.documents.filter((d) => d.id !== id)
    },
    addInformation(state) {
      state.product.informations.push({ name: '', value: '' })
    },
    setInformation(state, data) {
      state.product.informations[data.index][data.key] = data.value
    },
    addCategory(state, category) {
      state.product.categories.push(category)
    },
    removeCategory(state, id) {
      state.product.categories = state.product.categories.filter((c) => c.id !== id)
    },
    addTag(state, tag) {
      state.product.tags.push(tag)
    },
    removeTag(state, tag) {
      state.product.tags = state.product.tags.filter((t) => t.name !== tag)
    },
    addIcon(state, icon) {
      state.product.icons.push(icon)
    },
    removeIcon(state, id) {
      state.product.icons = state.product.icons.filter((i) => i.id !== id)
    },
    addVariant(state) {
      state.product.variations.push({ id: 0, value: '', sku: '', })
    },
    removeVariant(state, index) {
      state.product.variations.splice(index, 1)
    },
    updateVariantField(state, data) {
      state.product.variations[data.index][data.key] = data.value
    },
  },

  getters: {
    product: (state) => state.product,
    categories: (state) => state.categories,
    icons: (state) => state.icons,
    productLoaded: (state) => state.productLoaded,
  }
}

export default product
