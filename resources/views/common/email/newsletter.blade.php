@php
  $newsletter = App\Models\Newsletter::all()->last();
@endphp
@if(isset($newsletter))
<style>
  .newsletter-product-box {
    display:block;
    width: 31%;
    margin: 1%;
    border: 1px solid #eee;
    border-radius: 8px;
    float: left;
    padding: 6px;
    box-sizing: border-box;
    text-decoration: none;
  }

  @media(max-width: 450px) {
    .newsletter-product-box {
      width: 48%;
    }
  }
</style>
  <tr>
    <td>
      <div style="border-top: solid 4px #eee; margin-top: 32px;"></div>
      <div style="margin-top:32px;">
        <p style="font-family: sans-serif; font-size: 20px; font-weight: bold; margin: 0; margin-bottom: 10px;">{{ $newsletter->title }}</p>
        <div style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px;">
          {!! $newsletter->content !!}
        </div>
      </div>
      <div style="margin-top: 20px;">
        @foreach($newsletter->listProducts as $p)
        <a href="{{ env('APP_URL') . $p->productUrl }}" class="newsletter-product-box">
          <div style="">
            @if($p->featured_image)
             <div style="width: 100%;height: 140px; background: url('{{ env('APP_URL') . '/' . $p->featured_image->file_path }}'); background-size: contain; background-position:center;background-repeat: no-repeat;"></div>
            @else
              <div style="width: 100%;height: 140px; background: url('{{ env('APP_URL') . '/images/product-placeholder.png' }}'); background-size: contain; background-position:center;background-repeat: no-repeat;"></div>
            @endif
          </div>
          <div style="text-align: center; font-family: sans-serif; font-size: 14px; font-weight: bold; margin-top: 6px; text-decoration: none; color: #333; min-height: 59px;">
            {{ $p->name }}
          </div>
        </a>
        @endforeach
      </div>
    </td>
  </tr>
@endif
