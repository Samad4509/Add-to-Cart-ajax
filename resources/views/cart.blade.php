@extends('layout')

  

@section('content')

<table id="cart" class="table table-hover table-condensed">

    <thead>

        <tr>

            <th style="width:50%">Product</th>

            <th style="width:10%">Price</th>

            <th style="width:8%">Quantity</th>

            <th style="width:22%" class="text-center">Subtotal</th>

            <th style="width:10%"></th>

        </tr>

    </thead>

    <tbody>

        @php $total = 0 @endphp

        @if(session('cart'))
        @php
            $total = 0;
            $discount = 0;
            $cartCount = count(session('cart')); // Get the number of products in the cart
        @endphp

        @foreach(session('cart') as $id => $details)
            @php 
                $total += $details['price'] * $details['quantity']; 
            @endphp

            <tr data-id="{{ $id }}">
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive"/></div>
                        <div class="col-sm-9">
                            <h4 class="nomargin">{{ $details['name'] }}</h4>
                        </div>
                    </div>
                </td>

                <td data-th="Price">${{ $details['price'] }}</td>

                <td data-th="Quantity">
                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                </td>

                <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>

                <td class="actions" data-th="">
                    <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                </td>
            </tr>
        @endforeach

        @if($cartCount > 3) <!-- Check if the cart has more than 3 items -->
            @php
                $discount = $total * 0.20; // Apply 20% discount
                $total -= $discount; // Deduct the discount from the total
            @endphp
        @endif

        <tr>
            <td colspan="4" class="text-right"><strong>Total:</strong></td>
            <td class="text-center">${{ number_format($total, 2) }}</td>
        </tr>

        @if($cartCount > 3) <!-- Show the discount message if applicable -->
            <tr>
                <td colspan="4" class="text-right"><strong>Discount (20%):</strong></td>
                <td class="text-center">- ${{ number_format($discount, 2) }}</td>
            </tr>
        @endif
    @endif


    </tbody>

    <tfoot>

        <tr>

            <td colspan="5" class="text-right">

                <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>

                <button class="btn btn-success">Checkout</button>

            </td>

        </tr>

    </tfoot>

</table>

@endsection

  

@section('scripts')

<script type="text/javascript">

  

    $(".update-cart").change(function (e) {

        e.preventDefault();

  

        var ele = $(this);

  

        $.ajax({

            url: '{{ route('update.cart') }}',

            method: "patch",

            data: {

                _token: '{{ csrf_token() }}', 

                id: ele.parents("tr").attr("data-id"), 

                quantity: ele.parents("tr").find(".quantity").val()

            },

            success: function (response) {

               window.location.reload();

            }

        });

    });

  

    $(".remove-from-cart").click(function (e) {

        e.preventDefault();

  

        var ele = $(this);

  

        if(confirm("Are you sure want to remove?")) {

            $.ajax({

                url: '{{ route('remove.from.cart') }}',

                method: "DELETE",

                data: {

                    _token: '{{ csrf_token() }}', 

                    id: ele.parents("tr").attr("data-id")

                },

                success: function (response) {

                    window.location.reload();

                }

            });

        }

    });

  

</script>

@endsection