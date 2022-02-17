@php
$selected = isset($_GET['customer']) ? $_GET['customer'] : 0;
@endphp
<div class="flex items-end mb-10">
  <div>
    <label for="order-customer-filter" class="block text-sm font-medium text-gray-700">Filter by customer</label>
    <select id="order-customer-filter" name="location" class="mt-2 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
      <option value='' {{ !$selected ? 'selected' : '' }}>All customers</option>
      @foreach(App\Services\UsersService::usersWithOrders() as $user)
        <option value="{{ $user->id }}" {{ $user->id == $selected ? 'selected' : '' }}>
          {{ $user->name }}
        </option>
      @endforeach
    </select>
  </div>
  @if(isset($_GET['s']) || isset($_GET['customer']))
  <div class="ml-auto">
    <a
      href="/backend/orders"
      class="border border-gray-400 text-gray-600 group flex items-center ml-5 px-6 py-2 text-sm font-normal rounded-md hover:text-white hover:bg-gray-400 bg-transparent"
    >
      Clear Filters
    </a>
  </div>
  @endif
</div>
