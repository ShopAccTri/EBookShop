<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Hóa đơn #{{ $order->id}}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">Book Shopping</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Hóa đơn #{{ $order->id }}</span> <br>
                    <span>Ngày đặt: {{ date("d / m / Y")}}</span> <br>
                    <span>Zip code : {{ $order->pincode }}</span> <br>
                    <span>Địa chỉ: {{ $order->address }}</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Chi tiết hóa đơn</th>
                <th width="50%" colspan="2">Chi tiết người mua</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Hóa đơn ID:</td>
                <td>{{ $order->id }}</td>

                <td>Họ và tên:</td>
                <td>{{ $order->fullname }}</td>
            </tr>
            <tr>
                <td>Mã vận chuyển:</td>
                <td>{{ $order->tracking_no }}</td>

                <td>Địa chỉ email:</td>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <td>Ngày đặt hàng:</td>
                <td>{{ $order->created_at->format("H:i d-m-Y") }}</td>

                <td>Số điện thoại:</td>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <td>Phương thức thanh toan:</td>
                <td>{{ $order->payment_mode }}</td>

                <td>Địa chỉ:</td>
                <td>{{ $order->address }}</td>
            </tr>
            <tr>
                <td>Trạng thái hóa đơn:</td>
                <td>{{ $order->status_message }}</td>

                <td>Pin code:</td>
                <td>{{ $order->pincode }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Chi tiết hóa đơn
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrice = 0;
            @endphp
            @foreach ($order->orderItems as $orderItem)
                <tr>
                    <td width="10%">{{ $orderItem->id }}</td>
                    <td>{{ $orderItem->product->name }}</td>
                    <td width="10%">{{ number_format($orderItem->price, 0, ',', '.') . ' vn₫' }}
                    </td>
                    <td width="10%">{{ $orderItem->quantity }}</td>
                    <td width="15%" class="fw-bold">
                        {{ number_format($orderItem->quantity * $orderItem->price, 0, ',', '.') . ' vn₫' }}
                    </td>
                    @php
                        $totalPrice += $orderItem->quantity * $orderItem->price;
                    @endphp
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="fw-bold">Tổng tiền</td>
                <td colspan="1" class="fw-bold">
                    {{ number_format($totalPrice, 0, ',', '.') . ' vn₫' }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Cảm ơn bạn đã mua sắm ở Book Shopping
    </p>

</body>
</html>