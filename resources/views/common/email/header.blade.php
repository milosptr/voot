<style>
  .status-box {
    line-height: 1rem;
    letter-spacing: 0.025em;
    text-transform: uppercase;
    font-weight: 700;
    text-align: center;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 1rem;
    padding-right: 1rem;
    border-width: 1px;
    border-radius: 0.375rem;
    display: inline-block;
    margin-top: 0.25rem;
    box-sizing: border-box;
    box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0.05) 0px 1px 2px 0px;
    font-size: 12px;
    width: 120px;
    text-align: center;
  }

  .requested {
    background: rgb(228, 228, 231);
    color: rgb(113, 113, 122);
  }

  .accepted {
    background:rgb(191, 219, 254);
    color: rgb(29, 104, 167);
  }
  .in-progress,
  .pending {
    background:rgb(254, 215, 170);
    color: rgb(251, 146, 60);
  }
  .on-delivery {
    background: rgb(186, 230, 253);
    color: rgb(2, 132, 199);
  }
  .done {
    background: rgb(167, 243, 208);
    color: rgb(5, 150, 105);
  }
</style>
<tr valign="center">
  <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; text-align:right;" valign="center">
    <table width="100%" style="margin-bottom: 10px;">
      <tr>
        <td style="text-align: left;">
        @if(isset($order))
          <div style="margin: 0; font-size: 10px; font-weight: 500; text-transform: uppercase; color: #444; text-align:center; width: 120px;">Order status</div>
          <div class="status-box {{ App\Models\Order::slugifyStatus($order->order_status) }}">{{ App\Models\Order::statusText($order->order_status) }}</div>
        @endif
        </td>
        <td>
          <div style="background: rgb(16, 37, 58);padding: 8px 12px; display:inline-block;">
            <img src="{{ env('APP_URL') }}/images/voot-logo.png" alt="Voot" height="38">
          </div>
        </td>
      </tr>
    </table>
  </td>
</tr>
