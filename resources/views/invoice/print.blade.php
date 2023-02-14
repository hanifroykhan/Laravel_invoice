<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <style>
       
    body{margin-top:20px;
    background:#eee;
}

/*Invoice*/
.invoice .top-left {
    font-size:65px;
	color:#3ba0ff;
}

.invoice .top-right {
	text-align:right;
	padding-right:20px;
}

.invoice .table-row {
	margin-left:-15px;
	margin-right:-15px;
	margin-top:25px;
}

.invoice .payment-info {
	font-weight:500;
}

.invoice .table-row .table>thead {
	border-top:1px solid #ddd;
}

.invoice .table-row .table>thead>tr>th {
	border-bottom:none;
}

.invoice .table>tbody>tr>td {
	padding:8px 20px;
}

.invoice .invoice-total {
	margin-right:-10px;
	font-size:16px;
}

.invoice .last-row {
	border-bottom:1px solid #ddd;
}

.invoice-ribbon {
	width:85px;
	height:88px;
	overflow:hidden;
	position:absolute;
	top:-1px;
	right:14px;
}

.ribbon-inner {
	text-align:center;
	-webkit-transform:rotate(45deg);
	-moz-transform:rotate(45deg);
	-ms-transform:rotate(45deg);
	-o-transform:rotate(45deg);
	position:relative;
	padding:7px 0;
	left:-5px;
	top:11px;
	width:120px;
	background-color:#66c591;
	font-size:15px;
	color:#fff;
}

.ribbon-inner:before,.ribbon-inner:after {
	content:"";
	position:absolute;
}

.ribbon-inner:before {
	left:0;
}

.ribbon-inner:after {
	right:0;
}

@media(max-width:575px) {
	.invoice .top-left,.invoice .top-right,.invoice .payment-details {
		text-align:center;
	}

	.invoice .from,.invoice .to,.invoice .payment-details {
		float:none;
		width:100%;
		text-align:center;
		margin-bottom:25px;
	}

	.invoice p.lead,.invoice .from p.lead,.invoice .to p.lead,.invoice .payment-details p.lead {
		font-size:22px;
	}

	.invoice .btn {
		margin-top:10px;
	}
}

@media print {
	.invoice {
		width:900px;
		height:800px;
	}
}
    </style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    
<div class="container bootstrap snippets bootdeys">
<div class="row">
      <div class="col-sm-12">
              <div class="panel panel-default invoice" id="invoice">
              <div class="panel-body">
                <div class="invoice-ribbon"><div class="ribbon-inner">PAID</div></div>
                <div class="row">
    
                    <div class="col-sm-6 top-left">
                        <i class="fa fa-rocket"></i>
                    </div>

                    <div class="col-sm-6 top-right">
                            <h3 class="marginright">#{{ $invoice->id }}</</h3>
                            <br>
                            <span class="marginright">{{ $invoice->created_at->format('D, d M Y') }}</span>
                    </div>
                </div>
                <hr>
                <div class="row">
    
                    <div class="col-xs-4 from">
                        <p class="lead marginbottom">From : Discovery Designs</p>
                        <p>41 St Vincent Place</p>
                        <p>Glasgow G1 2ER</p>
                        <p>Scotland</p>
                    </div>

                    <div class="col-xs-4 to">
                        <p class="lead marginbottom">To : {{ $invoice->customer->name }}</p>
                        <p>425 Market Street</p>
                        <br>
                        <p>{{ $invoice->customer->address }}</p>
                        
                    </div>

                    <div class="col-xs-4 text-right payment-details">
                        <p class="lead marginbottom payment-info">Payment details</p>
                        <p>#{{ $invoice->id }}</p>
                        <p>{{ $invoice->created_at->format('D, d M Y') }}</p>
                        <p>{{ $invoice->created_at->format('D, d M Y') }}(Upon Receipt)</p>
                        <p> {{ $invoice->customer->subject }}</p>
                    </div>
                </div>
                <div class="row table-row">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th class="text-center" style="width:5%">#</th>
                          <th class="text-center" style="width:20%">Item</th>
                          <th class="text-right" style="width:15%">Description</th>
                          <th class="text-right" style="width:15%">Quantity</th>
                          <th class="text-right" style="width:15%">Unit Price</th>
                          <th class="text-right" style="width:15%">Total Price</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php $no = 1 @endphp
                      @foreach ($invoice->detail as $row)
                        <tr>
                            <td>{{ $no++}}</td>
                          <td>{{ $row->product->title }}</td>
                          <td>{{ $row->product->description }}</td>
                          <td>{{ $row->qty }}</td>
                          <td>Rp {{ number_format($row->price) }}</td>
                          <td>Rp {{ $row->subtotal }}</td>
                        </tr>
                      @endforeach
                        </tr>
                       </tbody>
                    </table>
                </div>
                <div class="row">
	
			    <div class="col-xs-6 text-right pull-right invoice-total">
					  <p>Subtotal  : Rp {{ number_format($invoice->total) }}</p>
			          <p>TAX (10%) : Rp {{ number_format($invoice->tax) }} </p>
			          <p>Total : Rp {{ number_format($invoice->total_price) }} </p>

			    </div>
			    </div>
                </div>
              </div>
      </div>
</div>
</div>