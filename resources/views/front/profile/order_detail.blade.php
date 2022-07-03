@extends('front.master')
@section('content')
    <div class="body-content mt-4">
        <div class="container">
            <div class="row">
                @include('front.common.user_sidebar')

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Shipping Details</h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC;">
                            <table class="table">
                                <tr>
                                    <th> Shipping Name: </th>
                                    <th> {{ $orderDetail->user->name }} </th>
                                </tr>

                                <tr>
                                    <th> Shipping Phone: </th>
                                    <th> {{ $orderDetail->user->phone }} </th>
                                </tr>

                                <tr>
                                    <th> Shipping Email: </th>
                                    <th> {{ $orderDetail->user->email }} </th>
                                </tr>

                                <tr>
                                    <th> Division: </th>
                                    <th> {{ $orderDetail->shipping->provinsi }} </th>
                                </tr>

                                <tr>
                                    <th> District: </th>
                                    <th> {{ $orderDetail->shipping->kabupaten }} </th>
                                </tr>

                                <tr>
                                    <th> State: </th>
                                    <th> {{ $orderDetail->shipping->kecamatan }} </th>
                                </tr>

                                <tr>
                                    <th> Post Code: </th>
                                    <th> {{ $orderDetail->shipping->post_code }} </th>
                                </tr>

                                <tr>
                                    <th> Order Date: </th>
                                    <th> {{ $orderDetail->order_date }} </th>
                                </tr>
                                <tr>
                                    <th> Delivery Status: </th>
                                    <th>
                                        <span class="badge badge-pill badge-warning"
                                            style="background:{{ $orderDetail->shipping->delivery_status == 0 ? '#EF3737' : '#418DB9' }} ; ">{{ $orderDetail->shipping->delivery_status == 0 ? 'Waitlist' : 'Sent' }}
                                        </span>
                                    </th>
                                </tr>
                                @if ($orderDetail->shipping->delivery_status == 1)
                                    <tr>
                                        <th> Resi NO: </th>
                                        <th>
                                            <span class="badge badge-pill badge-warning"
                                                style="background:#EF3737 ; ">{{ $orderDetail->shipping->resi }}
                                            </span>
                                        </th>
                                    </tr>
                                @endif

                            </table>


                        </div>

                    </div>

                </div> <!-- // end col md -5 -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Details

                            </h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC;">
                            <table class="table">
                                <tr>
                                    <th> Name: </th>
                                    <th> {{ $orderDetail->user->name }} </th>
                                </tr>

                                <tr>
                                    <th> Phone: </th>
                                    <th> {{ $orderDetail->user->phone }} </th>
                                </tr>

                                <tr>
                                    <th> Payment Type: </th>
                                    <th> {{ ucwords($orderDetail->payment_type) }} </th>
                                </tr>

                                <tr>
                                    <th> Trans ID: </th>
                                    <th> {{ $orderDetail->transaction_id }} </th>
                                </tr>

                                <tr>
                                    <th> Order ID: </th>
                                    <th class="text-danger"> {{ $orderDetail->order_id }} </th>
                                </tr>

                                <tr>
                                    <th> Order Total: </th>
                                    <th>{{ $orderDetail->gross_amount }} </th>
                                </tr>

                                <tr>
                                    <th> Order: </th>
                                    <th>
                                        <span class="badge badge-pill badge-warning"
                                            style="background: #418DB9;">{{ $orderDetail->status }} </span>
                                    </th>
                                </tr>



                            </table>


                        </div>

                    </div>

                </div> <!-- // 2ND end col md -5 -->

                <div class="row">



                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                    <tr style="background: #e2e2e2;">
                                        <td class="col-md-1">
                                            <label for=""> Image</label>
                                        </td>

                                        <td class="col-md-3">
                                            <label for=""> Product Name </label>
                                        </td>

                                        <td class="col-md-3">
                                            <label for=""> Product Code</label>
                                        </td>


                                        <td class="col-md-2">
                                            <label for=""> Color </label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> Size </label>
                                        </td>

                                        <td class="col-md-1">
                                            <label for=""> Quantity </label>
                                        </td>

                                        <td class="col-md-1">
                                            <label for=""> Price </label>
                                        </td>

                                    </tr>

                                    @foreach ($orderItem as $item)
                                        <tr>
                                            <td class="col-md-1">
                                                <label for=""><img
                                                        src="{{ asset('storage/' . $item->product->product_thambnail) }}"
                                                        height="50px;" width="50px;"> </label>
                                            </td>

                                            <td class="col-md-3">
                                                <label for=""> {{ $item->product->product_name }}</label>
                                            </td>


                                            <td class="col-md-3">
                                                <label for=""> {{ $item->product->product_code }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for=""> {{ ucwords($item->color) }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for=""> {{ ucwords($item->size) }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for=""> {{ $item->qty }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for="">
                                                    Rp.{{ $item->product->discount_price ? $item->product->discount_price : $item->product->selling_price }}
                                                    (Rp.
                                                    {{ $item->product->discount_price ? $item->product->discount_price * $item->qty : $item->product->selling_price * $item->qty }})
                                                </label>
                                            </td>

                                        </tr>
                                    @endforeach





                                </tbody>

                            </table>

                        </div>





                    </div> <!-- / end col md 8 -->












                </div> <!-- // END ORDER ITEM ROW -->



            </div> <!-- // end row -->

        </div>

    </div>
@endsection
