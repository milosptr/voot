const { default: axios } = require("axios")
const dayjs = require("dayjs")
// Admin Dashboard
if(document.querySelector('.admin-dashboard')) {
  document.querySelectorAll('[href="'+window.location.pathname+'"]')[0]?.classList.add('bg-primary-light')
  document.querySelectorAll('[href="'+window.location.pathname+'"]')[1]?.classList.add('bg-primary-light')

  if(document.querySelector('.format-the-date')) {
    document.querySelectorAll('.format-the-date').forEach((e) => {
      e.innerText = dayjs(e.innerText).format('DD MMM YY') + ' at ' + dayjs(e.innerText).format('HH:mm')
    })
  }

  if(document.querySelector('.delete-product-btn')) {
    const deleteBtns = document.querySelectorAll('.delete-product-btn')
    deleteBtns.forEach((b) => {
      b.addEventListener('click', (e) => {
        const name = e.target.dataset.name
        const formAction = '/api/product-category/delete/' + e.target.dataset.id

        document.getElementById('delete-category-modal').classList.remove('hidden')
        document.getElementById('delete-category-name').innerText = name
        document.querySelector('#delete-category-modal form').action = formAction
      })
    })
    document.getElementById('close-category-modal').addEventListener('click', (e) => {
      document.getElementById('delete-category-modal').classList.add('hidden')
    })
  }

  if(document.querySelector('.ckeditor')) {
    const editor = CKEDITOR.replace( 'wysiwyg-editor', {
      removePlugins: 'elementspath, resize, save, font'
    });
    editor.setData(document.getElementById('product-description').value)

    editor.on( 'change', debounce(function( evt ) {
        document.getElementById('product-description').innerHTML = evt.editor.getData()
    }, 500))
  }

  if(document.querySelector('.selected-categories')) {
    const categoriesWrapper = document.querySelector('.selected-categories')
    let categories = document.querySelector('input#categories').value
    document.getElementById('category').addEventListener('input', (e) => {
      let name = document.querySelector(`#category option[value="${e.target.value}"]`).text
      name = name.replace('— ', '').replace('— ', '')
      categoriesWrapper.innerHTML += `
      <div class="flex justify-between items-center selected-category-item py-1 border-b border-gray-100">
      <div class="pl-2">${name}</div>
      <div data-category="${e.target.value}" class="remove-from-categories pr-2 tracking-widest text-3xl font-thin leading-none text-gray-400 cursor-pointer hover:text-rose-500">&times;</div>
      </div>
      `
      categories = categories === "" ? e.target.value : categories.concat(', ' + e.target.value)
      document.querySelector('input#categories').value = categories
      resetCategorySelect(document.querySelectorAll('#category option'))
      addEventListenerForRemovingCategory()
    })
  }
}

if(document.querySelector('.add-single-product')) {
  const productOptions = [{
    name: '',
    values: [],
  }]
}

if(document.querySelectorAll('[data-link]').length) {
  document.querySelectorAll('[data-link]').forEach((td) => {
    td.addEventListener('click', (e) => {
      if(e.target.closest('tr'))
        window.open(e.target.closest('tr').dataset.link)
    })
  })
}

if(document.querySelector('.show-history-btn')) {
  document.querySelector('.show-history-btn').addEventListener('click', (e) => {
    document.querySelector('.history-box').style.height = 'auto'
    document.querySelector('.show-history-btn').remove()
  })
}

if(document.getElementById('products-category-filter')) {
  const productsCategoryFilter = document.getElementById('products-category-filter')
  productsCategoryFilter.addEventListener('change', (e) => {
    e.target.value ? setUrlQueryString("category", e.target.value) : unsetUrlQueryString("category")
  })
}
if(document.getElementById('order-customer-filter')) {
  const orderCustomerFilter = document.getElementById('order-customer-filter')
  orderCustomerFilter.addEventListener('change', (e) => {
    e.target.value ? setUrlQueryString("customer", e.target.value) : unsetUrlQueryString("customer")
  })
}
if(document.getElementById('order-customer-filter-status')) {
  const orderCustomerFilter = document.getElementById('order-customer-filter-status')
  orderCustomerFilter.addEventListener('change', (e) => {
    e.target.value ? setUrlQueryString("status", e.target.value) : unsetUrlQueryString("status")
  })
}

if(document.getElementById('products-category-search')){
  if(window.location.search.length) searchProducts()
  const productsCategorySearch = document.getElementById('products-category-search')
  const onSearch = debounce(function() {
    const search = document.getElementById('products-category-search').value
    setUrlQueryString('s', search, 0)
    searchProducts()
  }, 450);

  productsCategorySearch.addEventListener('keydown', onSearch);
}

if (document.getElementById('clients-search')) {
  if (window.location.search.length) searchClients();
  const clientSearch = document.getElementById('clients-search');
  clientSearch.addEventListener('change', (e) => {
    setUrlQueryString('s', e.target.value, 0);
    searchClients()
  })
}

if(document.getElementById('fileDrop')) {
  FilePond.registerPlugin(
    FilePondPluginImagePreview,
  );

  const input = document.getElementById('fileDrop')
  const categoryFileDrop = FilePond.create(input, {
		labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
    imagePreviewHeight: 250,
    imageCropAspectRatio: '1:1',
    stylePanelLayout: 'compact square',
    styleLoadIndicatorPosition: 'center center',
	})

  categoryFileDrop.setOptions({
    server: {
      process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
        const formData = new FormData()
        formData.append(fieldName, file, file.name)
        if(document.getElementById('editCategory'))
          formData.append('category_id', parseInt(document.getElementById('editCategory').dataset.categoryId))
        if(document.getElementById('addNewCategory'))
          formData.append('category_id', parseInt(document.getElementById('addNewCategory').dataset.categoryId))

        const request = new XMLHttpRequest()
        request.open('POST', '/api/assets')

        request.upload.onprogress = (e) => {
          progress(e.lengthComputable, e.loaded, e.total);
        }

        request.send(formData)

        request.onload = () => {
          if (request.status >= 200 && request.status < 300) {
            load(request.responseText)
            document.querySelector('.category-featured-image').remove()
          } else {
            error('Something went wrong!')
          }
        }

        // Should expose an abort method so the request can be cancelled
        return {
          abort: () => {
              // This function is entered if the user has tapped the cancel button
              request.abort();

              // Let FilePond know the request has been cancelled
              abort();
          },
        }
      }
    }
  })
}
if(document.getElementById('sortable-category-products')){
  const categoryProducts = document.getElementById('sortable-category-products')
  new Sortable(document.getElementById('sortable-category-products'), {
    handle: 'svg',
    animation: 150,
    ghostClass: 'bg-gray-50',
    dragClass: 'opacity-0',
    onUpdate: function (evt) {
      const newOrder = [];
      [...categoryProducts.children].forEach((p, i) => {
        newOrder.push({ product_id: p.dataset.key, category_order: i })
      })
      axios.post('/api/product-category-order', newOrder)
    },
  })
}

function searchProducts() {
  axios.post('/api/products/search', Object.fromEntries(new URLSearchParams(window.location.search)))
    .then((res) => {
      document.getElementById('products-tbody-list').innerHTML = res.data
    })
}

function searchClients() {
  axios.post('/api/clients/search', Object.fromEntries(new URLSearchParams(window.location.search)))
    .then((res) => {
      document.getElementById('client-list').innerHTML = res.data
    })
}

function setUrlQueryString(name, value, change = 1) {
  let searchParams = new URLSearchParams(window.location.search)
  searchParams.set(name, value)
  if(change) {
    window.location.search = searchParams.toString()
  } else {
    const newUrl = window.location.origin + window.location.pathname + '?' + searchParams.toString()
    window.history.pushState({ path:newUrl },'',newUrl);
  }
  if(name == 's')
    unsetUrlQueryString('page')
}

function unsetUrlQueryString(name) {
  let searchParams = new URLSearchParams(window.location.search)
  searchParams.delete(name)
  window.location.search = searchParams.toString()
}

function resetCategorySelect(options) {
  options.forEach((o, i) => {
    if(i === 0) o.selected = 'selected'
    else delete o.selected
  })
}

function addEventListenerForRemovingCategory() {
  const categories = document.querySelectorAll('.remove-from-categories')
  categories.forEach((c) => {
      c.addEventListener('click', (e) => {
      const category = e.target.dataset.category
      let selected = document.querySelector('input#categories').value
      document.querySelector('input#categories').value = selected.split(', ').filter((c) => c !== category)
      e.target.parentNode.remove()
    })
  })
}

const paginationPrev = document.getElementById('pagination--prev')
const paginationNext = document.getElementById('pagination--next')
if(paginationPrev || paginationNext) {
  paginationPrev.addEventListener('click', (e) => {
    const current = e.target.dataset.current
    if(current - 1)
      setUrlQueryString('page', parseInt(current) - 1)
  })
  paginationNext.addEventListener('click', (e) => {
    const current = e.target.dataset.current
    setUrlQueryString('page', parseInt(current) + 1)
  })
}









function debounce(func, wait) {
  let timeout;

  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };

    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
};
