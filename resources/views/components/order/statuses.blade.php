<div class="order-status-box {{ App\Models\Order::statusClasses($status) }} {{ $class ?? '' }} ">
  {{ App\Models\Order::statusText($status) }}
</div>
