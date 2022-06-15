@if($status == App\Models\Order::AX_STATUS_SAVED)
<div class="order-status-box w-20 text-center mt-1 inline-block shadow-sm text-sm sm:text-xs rounded-md uppercase font-bold tracking-wide bg-green-200 text-green-500 border-1 border-green-200 py-1 px-2 mb-1 ">
  SAVED
</div>
@else
<div class="order-status-box w-20 text-center mt-1 inline-block shadow-sm text-sm sm:text-xs rounded-md uppercase font-bold tracking-wide bg-gray-200 text-gray-500 border-1 border-gray-200 py-1 px-2 mb-1 ">
 failed
</div>
@endif
