<div class="{{ App\Models\Order::statusClasses($status) }}">
  {{ App\Models\Order::statusText($status) }}
</div>
