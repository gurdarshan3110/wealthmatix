
<div class="col-xxl-12">
    <div class="card card-flush">
                            
        <!--begin::Card body-->
        <div class="card-body">
            <style>
      
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .invoice-header,
        .invoice-body {
            margin-bottom: 20px;
        }
        .invoice-header h2 {
            margin: 0;
        }
        .invoice-details {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            text-align: right;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            .invoice, .invoice * {
                visibility: visible;
            }
            .invoice {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>

<div class="container invoice">
    <div class="invoice-header">
        <div class="d-flex">
            <img alt="Logo" src="{{ asset('/assets/images/watermark.png') }}" class="h-100px" />
        </div>
        <h2 class="text-center">Invoice</h2>
    </div>

    <div class="invoice-details">
        <div class="d-flex justify-content-between">
            <span><strong>Invoice Number:</strong> {{$bill->bill_number}}</span>
            <span><strong>Date:</strong> {{date('d M Y', strtotime($bill->bill_date))}}</span>
        </div>

        <div class="d-flex justify-content-between">
            <span><strong>Customer:</strong> {{$bill->transfer_to->name}}</span>
            <span><strong>Phone No:</strong> {{$bill->transfer_to->phone_no}}</span>
        </div>
        
    </div>

    <div class="invoice-body">
        <table class="table">
            <thead>
                <tr>
                    <th width="40%">Item</th>
                    <th width="20%">Batch No</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $saleprice=0;
                ?>
                @foreach($bill->variants as $item)
                <tr>
                    <td>{{$item->variant->item->name}}</td>
                    <td>{{$item->batch_no}}</td>
                    <td>{{$item->quantity}}</td>
                    <td class="text-right">Rs {{$item->sale_price}}</td>
                    <td class="text-right">Rs {{$item->sale_price*$item->quantity}}</td>
                </tr>
                <?php
                    $saleprice = $saleprice + $item->sale_price;
                ?>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        <p><strong>Total:</strong> Rs{{$saleprice}}</p>
    </div>

</div>
<div class="text-center mt-2">
        <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
    </div>

