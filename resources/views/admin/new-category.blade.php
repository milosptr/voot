@extends('layouts.master-admin')

@section('backbutton')
  <a href="/backend/categories" class="text-pprimary-light group flex items-center px-4 py-2 text-sm font-normal rounded-md">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
  </a>
@endsection
@section('title', 'Create New Category')
@section('page-title', 'Create New Category')

@section('content')
<div class="mt-10 sm:mt-0">
  <div class="w-1/2">
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form id="addNewCategory" action="/api/product-category" method="POST">
        @csrf
        <div class="overflow-hidden sm:rounded-md">
          <div class="py-6">
            <div class="">
              <div>
                <label for="dropzone" class="block text-sm font-medium text-gray-700">
                Category image
                </label>
                <div class="mt-2">
                  <label for="dropzone" id="dropzone-placeholder" class="flex items-center justify-center text-center cursor-pointer">
                    Drag & Drop your picture or Browse
                  </label>
                  <input
                    id="dropzone"
                    type="file"
                    name="file"
                    hidden
                  >
                  </div>
              </div>
              <div class="mt-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Category name</label>
                <input type="text" name="name" id="name" class="mt-1  block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
              </div>
              <div class="mt-6">
                <label for="slug" class="block text-sm font-medium text-gray-700">Category slug <span class="font-normal">(autofilled)</span></label>
                <input type="text" name="slug" id="slug" class="mt-1  block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
              </div>
              <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="font-normal">(optional)</span></label>
                <input type="text" name="description" id="description" class="mt-1  block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="mt-6">
                <label for="parent" class="block text-sm font-medium text-gray-700">Parent</label>
                <select id="parent" name="parent_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none  sm:text-sm" required>
                  <option value='0' selected>No Parent</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @foreach($category->children as $subcategory)
                      <option value="{{ $subcategory->id }}">{{ '— '.$subcategory->name }}</option>
                      @foreach($subcategory->children as $subsubcategory)
                        <option value="{{ $subsubcategory->id }}">{{ '— —'.$subsubcategory->name }}</option>
                      @endforeach
                    @endforeach
                  @endforeach
                </select>
              </div>

              <div class="flex items-center mt-6">
                <input type="checkbox" id="available" name="available" checked />
                <label for="available" class="block text-sm font-medium text-gray-700 ml-6">Is this category available?</label>
              </div>

          </div>
          <div class="py-3 mt-10">
            <button type="submit" class="inline-flex justify-center py-2 px-12 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-lighter hover:bg-primary-light focus:outline-none">
              Add Category
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  const categoryNameInput = document.getElementById('name')
  if(categoryNameInput) {
    categoryNameInput.addEventListener('input', (e) => {
      axios.post('/api/slugify', { name: e.target.value})
        .then((res) => {
          document.getElementById('slug').value = res.data.slug
        })
    })
  }
</script>
@endsection
