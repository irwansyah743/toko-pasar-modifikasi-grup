<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        body {
            padding: 3em;
        }

        * {
            font-family: Verdana, Arial, sans-serif;
            box-sizing: border-box;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: rgb(7, 0, 89);
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: rgb(7, 0, 89);
            ;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: rgb(7, 0, 89); font-size: 26px;"><strong>tokoPasarModifikasiGrup</strong></h2>
            </td>
            <td align="right">
                <pre class="font">
               tokoPasarModifikasiGrup
               Email:support@tokoPasarModifikasiGrup.com <br>

            </pre>
            </td>
        </tr>

    </table>


    <table width="100%" style="background:white; padding:2px;""></table>
    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Name:</strong> {{ $orderDetail->user->name }} <br>
                    <strong>Email:</strong> {{ $orderDetail->user->email }} <br>
                    <strong>Phone:</strong> {{ $orderDetail->user->phone }} <br>

                    <strong>Alamat:</strong> {{ $orderDetail->shipping->alamat }} <br>
                    <strong>Post Code:</strong> {{ $orderDetail->shipping->kode_pos }}
                </p>
            </td>
            <td>
                <p class="font">
                <h3><span style="color: rgb(7, 0, 89);">Order:</span> {{ $orderDetail->id_pesanan }}</h3>
                Order Date: {{ $orderDetail->created_at }} <br>
                Payment Type : {{ ucwords($orderDetail->tipe_pembayaran) }} </span>
                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>Products</h3>
    <table width="100%">
        <thead style="background-color: rgb(7, 0, 89); color:#FFFFFF;">
            <tr class="font">
                <th>Product Name</th>
                <th>Size</th>
                <th>Color</th>
                <th>Code</th>
                <th>Quantity</th>
                <th>Unit Price </th>
                <th>Total </th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal = 0;
            @endphp
            @foreach ($orderItems as $orderItem)
                <tr class="font">
                    <td style="padding:4px;">{{ $orderItem->product->nama_produk }}</td>
                    <td style="padding:4px;">
                        {{ ucwords($orderItem->size) }}
                    </td>
                    <td style="padding:4px;">{{ ucwords($orderItem->color) }}</td>
                    <td style="padding:4px;">{{ $orderItem->product->kode_produk }}</td>
                    <td style="padding:4px;">{{ $orderItem->qty }}</td>
                    <td style="padding:4px;">
                        {{ $orderItem->product->harga_diskon ? $orderItem->product->harga_diskon : $orderItem->product->harga_jual }}
                    </td>
                    <td style="padding:4px;">
                        {{ $orderItem->product->harga_diskon ? $orderItem->product->harga_diskon * $orderItem->qty : $orderItem->product->harga_jual * $orderItem->qty }}
                    </td>
                </tr>
                @php
                    $subtotal += $orderItem->product->harga_diskon ? $orderItem->product->harga_diskon * $orderItem->qty : $orderItem->product->harga_jual * $orderItem->qty;
                @endphp
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: rgb(7, 0, 89);">Subtotal: </span>Rp. {{ $subtotal }}</h2>
                @if ($subtotal != $orderDetail->nominal_total)
                    <h2><span style="color: rgb(7, 0, 89);">Discount: </span>
                        Rp. {{ $subtotal - $orderDetail->nominal_total }} | Rp.
                        {{ (100 / $subtotal) * ($subtotal - $orderDetail->nominal_total) }}%
                    </h2>
                @endif
                <h2><span style="color: rgb(7, 0, 89);">Total: </span>Rp. {{ $orderDetail->nominal_total }}</h2>
                {{-- <h2><span style="color: rgb(7, 0, 89);">Full Payment PAID</h2> --}}
            </td>
        </tr>
    </table>
    <div class=" mt-3">
        <p>Thanks For Buying Our Products..!!</p>
    </div>
    <div class="authority float-right mt-5">
        <p>Irwansyah</p>
        <h5>Ceo of Toko Pasar Modifikasi grup</h5>
    </div>
</body>

</html>
