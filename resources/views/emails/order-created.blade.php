@php
  $order = App\Models\Order::all()->last();
@endphp

<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>New Order Created</title>
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
    </style>
  </head>
  <body style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" width="100%" bgcolor="#f6f6f6">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;" width="580" valign="top">
          <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px; border-top: 8px solid #214b76;border-bottom: 8px solid #214b76;" valign="top">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; " valign="top">
                        <h1 style="font-family: 'Tahoma',sans-serif; font-size: 26px; font-weight: bold; text-align: left; margin: 0; margin-bottom: 15px;">New Order #{{ $order->id }}</h1>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-top: 25px; margin-bottom: 15px;">You have received an order from Voot website. The order is as follows:</p>
                         @foreach($order->order as $o)
                          @php
                            $product = App\Models\Inventory::where('sku', $o['sku'])->first();
                            $pv = App\Models\ProductVariation::where('sku', $o['sku'])->first();
                          @endphp
                          <a href="/product/{{ $pv->product->slug }}" target="_blank" style="text-decoration: none; display:block; font-family: sans-serif; font-size: 14px; font-weight: 500; margin: 0; padding: 5px; border-top: 1px solid #eee; color: #1d68a7;">
                            {{ $product->name }} <span class="font-medium">( x{{ $o['qty'] }} )</span>
                          </a>
                        @endforeach
                        <p style="margin:0;border-top: 1px solid #eee;"></p>
                        @if($order->note)
                        <p style="padding-top:15px; margin-top:0;"><span style="font-weight: 600;color:#555">Note:</span> {{ $order->note }}<p>
                        @endif
                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;margin-top: 25px;">
                          <tr valign="top">
                            <td>
                              <p style="font-family: sans-serif; font-size: 16px; font-weight: bold; margin: 0; margin-bottom: 10px;">Customer Information:</p>
                              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px;">
                                <span style="font-weight: 600;color:#555;">Name:</span><br>{{ $order->user->name }}
                              </p>
                              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px;">
                                <span style="font-weight: 600;color:#555;">Email:</span><br>{{ $order->user->email }}
                              </p>
                              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">
                                <span style="font-weight: 600;color:#555;">SSN:</span><br>{{ $order->user->ssn }}
                              </p>
                            </td>
                            <td style="width: 50%;">
                              @if($order->shipping_method === App\Models\Order::DELIVERY)
                                <p style="font-family: sans-serif; font-size: 16px; font-weight: bold; margin: 0; margin-bottom: 10px;">Shipping Information:</p>
                              @else
                                <p style="font-family: sans-serif; font-size: 16px; font-weight: bold; margin: 0; margin-bottom: 10px;">Pickup Information:</p>
                              @endif
                              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px;">
                                <span style="font-weight: 600;color: #555;">Address:</span><br>{{ $order->orderAddress() }}
                              </p>
                              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 5px;">
                                @if($order->shipping_method === App\Models\Order::DELIVERY)
                                <span style="font-weight: 600;color: #555;">Shipping date:</span><br>
                                @else
                                <span style="font-weight: 600;color: #555;">Pickup date:</span><br>
                                @endif
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
                                <a href="{{ env('APP_URL') }}/backend/orders/" target="_blank" style="border: solid 1px #214b76; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: block; font-size: 14px; font-weight: bold; margin: 0 auto; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #214b76; border-color: #214b76; color: #ffffff;">View Order</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            <div class="footer" style="clear: both; margin-top: 10px; text-align: center; width: 100%;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                <tr>
                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;" valign="top" align="center">
                    <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">Sent from Voot website</span>
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>