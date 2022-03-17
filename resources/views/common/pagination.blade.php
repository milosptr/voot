<nav class="mt-10 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" aria-label="Pagination">
  <div class="hidden sm:block">
    <p class="text-sm text-gray-700">
      Showing
      <span class="font-medium">{{ isset($_GET['page']) && $_GET['page'] > 1 ? ($_GET['page'] - 1) * $pagination['per_page'] : '1' }}</span>
      to
      <span class="font-medium">{{ isset($_GET['page']) ?  $_GET['page'] * $pagination['per_page'] : $pagination['per_page'] }}</span>
      of
      <span class="font-medium">{{ $pagination['total'] }}</span>
      results
    </p>
  </div>
  <div class="flex-1 flex justify-between sm:justify-end">
    @if(isset($_GET['page']) && $_GET['page'] > 1)
    <div id="pagination--prev" data-current="{{ $pagination['current_page'] }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer"> Previous </div>
    @else
    <div id="pagination--prev" class="px-1"></div>
    @endif
    @if($pagination['current_page'] + 1 == $pagination['last_page'])
      <div class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-gray-50 hover:bg-gray-50 cursor-not-allowed"> Next </div>
    @else
      <div id="pagination--next" data-current="{{ $pagination['current_page'] }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 cursor-pointer"> Next </div>
    @endif
  </div>
</nav>
