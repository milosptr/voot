<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     @if(isset($isCustomer) && $isCustomer)
      <title>Þín Pöntun #{{ $order->id }}</title>
     @else
      <title>Ný pöntun</title>
    @endif
    <style>
      @media only screen and (max-width: 620px) {
        table.body h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important;
        }

        table.body p,
        table.body ul,
        table.body ol,
        table.body td,
        table.body span,
        table.body a {
            font-size: 16px !important;
          }

          table.body .wrapper,
        table.body .article {
            padding: 10px !important;
          }

          table.body .content {
            padding: 0 !important;
          }

          table.body .container {
            padding: 0 !important;
            width: 100% !important;
          }

          table.body .main {
            border-left-width: 0 !important;
            border-radius: 0 !important;
            border-right-width: 0 !important;
          }

          table.body .btn table {
            width: 100% !important;
          }

          table.body .btn a {
            width: 100% !important;
          }

          table.body .img-responsive {
            height: auto !important;
            max-width: 100% !important;
            width: auto !important;
          }
        }
        @media all {
          .ExternalClass {
            width: 100%;
          }

          .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
          }

          .apple-link a {
            color: inherit !important;
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            text-decoration: none !important;
          }

          #MessageViewBody a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
          }

          .btn-primary table td:hover {
            background-color: #34495e !important;
          }

          .btn-primary a:hover {
            background-color: #34495e !important;
            border-color: #34495e !important;
          }
        }
        table.body .fs-13 {
          font-size: 13px;
        }

        @media(max-width: 450px) {
          table.body .fs-13 {
            font-size: 13px!important;
          }
          table.body p,
          table.body span,
          .footer table *,
          .footer table span  {
            font-size: 14px!important;
          }

        }
    </style>
  </head>
  <body style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" width="100%" bgcolor="#f6f6f6">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;" width="580" valign="top">
          <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 680px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="background: #fff; font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px; border-top: 8px solid #214b76;border-bottom: 8px solid #214b76;" valign="top">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; " valign="top">
                        @if(isset($isCustomer) && $isCustomer)
                          <h1 style="font-family: 'Tahoma',sans-serif; font-size: 26px; font-weight: bold; text-align: left; margin: 0; margin-bottom: 15px;">Þín Pöntun #{{ $order->id }}</h1>
                        @else
                          <h1 style="font-family: 'Tahoma',sans-serif; font-size: 26px; font-weight: bold; text-align: left; margin: 0; margin-bottom: 15px;">Ný pöntun #{{ $order->id }}</h1>
                        @endif
                         @if(isset($isCustomer) && $isCustomer)
                          <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-top: 25px; margin-bottom: 15px;">Takk fyrir að panta! Pöntun þín er eftirfarandi:</p>
                         @else
                          <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-top: 25px; margin-bottom: 15px;">Þér hefur borist ný pöntun frá heimasíðu Voot. Pöntun þín er eftirfarandi:</p>
                         @endif
                         <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                          <tr>
                            <td style="font-family: sans-serif; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #333; vertical-align: center; border-bottom: 2px solid #eee; padding-bottom: 1px;" valign="center">Vörunúmer</td>
                            <td style="font-family: sans-serif; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #333; vertical-align: center; border-bottom: 2px solid #eee; padding-bottom: 1px;" valign="center">Nafn</td>
                            <td style="font-family: sans-serif; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #333; vertical-align: center; border-bottom: 2px solid #eee; padding-bottom: 1px;text-align:center;" valign="center">Magn</td>
                          </tr>
                          @foreach($order->order as $o)
                            @php
                              $product = App\Models\Inventory::where('sku', $o['sku'])->first();
                              $pv = App\Models\ProductVariation::where('sku', $o['sku'])->first();
                              if(!$product || !$pv) {
                                $product = App\Models\Product::where('sku', $o['sku'])->first();
                                $pv = new stdClass;
                                $pv->product = $product;
                              }
                            @endphp
                            <tr>
                              <td class="fs-13" style="font-family: sans-serif; vertical-align: center; border-bottom: 1px solid #eee; " valign="center">
                                {{ $o['sku'] }}
                              </td>
                              <td class="fs-13" style="font-family: sans-serif; vertical-align: center; border-bottom: 1px solid #eee; " valign="center">
                                <a href="{{ env('APP_URL') }}/product/{{ $pv->product->slug }}" target="_blank" class="fs-13" style="text-decoration: none; display:block; font-family: sans-serif; font-weight: 500; margin: 0;padding: 6px 0;color: #1d68a7;">
                                  {{ $product->name }}
                                </a>
                              </td>
                              <td class="fs-13" style="font-family: sans-serif; vertical-align: center; border-bottom: 1px solid #eee;text-align:center;" valign="center">
                                {{ $o['qty'] }}
                              </td>
                            </tr>
                          @endforeach
                        </table>
                        <p style="margin:0;border-top: 1px solid #eee;"></p>
                        @if($order->note)
                        <p style="padding-top:15px; margin-top:0;"><span style="font-weight: 600;color:#555">Note:</span> {{ $order->note }}<p>
                        @endif
                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;margin-top: 25px;">
                          <tr valign="top">
                            <td>
                              <p style="font-family: sans-serif; font-size: 16px; font-weight: bold; margin: 0; margin-bottom: 10px;">Upplýsingar viðskiptavinar:</p>
                              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px;">
                                <span style="font-weight: 600;color:#555;">Nafn:</span><br>{{ $order->user->name }}
                              </p>
                              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px;">
                                <span style="font-weight: 600;color:#555;">Netfang:</span><br>{{ $order->user->email }}
                              </p>
                              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">
                                <span style="font-weight: 600;color:#555;">Kennitala:</span><br>{{ $order->user->ssn }}
                              </p>
                              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">
                                <span style="font-weight: 600;color:#555;">Simanúmer:</span><br>{{ $order->user->phone }}
                              </p>
                            </td>
                            <td style="width: 50%;">
                              @if($order->shipping_method === App\Models\Order::DELIVERY)
                                <p style="font-family: sans-serif; font-size: 16px; font-weight: bold; margin: 0; margin-bottom: 10px;">Sendingarupplýsingar:</p>
                              @else
                                <p style="font-family: sans-serif; font-size: 16px; font-weight: bold; margin: 0; margin-bottom: 10px;">Upplýsingar um afhendingu:</p>
                              @endif
                              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px;">
                                <span style="font-weight: 600;color: #555;">Heimilsfang:</span><br>
                                {{ $order->orderAddress() }}
                              </p>
                              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px;">
                                <span style="font-weight: 600;color: #555;">Afhendingar dagur:</span><br>
                                <span style="letter-spacing: 1px;">{{ Carbon\Carbon::parse($order->shipping_date)->format('d/m/Y') }}</span>
                              </p>
                            </td>
                          </tr>
                        </table>
                        <p></p>

                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt;margin-top:20px; width: 100%;">
                          <tbody>
                            <tr>
                              <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; border-radius: 5px; text-align: center; background-color: #214b76;" valign="top" align="center" bgcolor="#214b76">
                                @if(isset($isCustomer) && $isCustomer)
                                  <a href="{{ env('APP_URL') }}/app/orders/{{ $order->id }}" target="_blank" style="border: solid 1px #214b76; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: block; font-size: 14px; font-weight: bold; margin: 0 auto; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #214b76; border-color: #214b76; color: #ffffff;">Skoða pöntun</a>
                                @else
                                  <a href="{{ env('APP_URL') }}/backend/orders/{{ $order->id }}" target="_blank" style="border: solid 1px #214b76; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: block; font-size: 14px; font-weight: bold; margin: 0 auto; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #214b76; border-color: #214b76; color: #ffffff;">Skoða pöntun</a>
                                @endif
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    @if(isset($isCustomer) && $isCustomer)
                      @include('common.email.newsletter')
                    @endif
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            @include('common.email.footer')
            <!-- END FOOTER -->

          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
