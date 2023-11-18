<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;

    public $fullname, $email, $phone, $pincode, $address, $payment_mode =  NULL, $payment_id =  NULL;

    public $listeners = [
        "validationForAll",
        // "transactionEmit" => "paidOnlineOrder",
    ];

    public function paidOnlineOrder($value){
        $this->payment_id = $value;
        $this->payment_mode = "Thanh toán bằng Paypal";

        $codOrder = $this->placeOrder();

        if($codOrder){
            Cart::where("user_id",auth()->user()->id)->delete();

            session()->flash("message","Đặt hàng thành công");

            $this->dispatch('message', [
                'text' => "Đặt hàng thành công!",
                'type' => "success",
                'status' => 200,
            ]);

            return redirect()->to("thank-you");
        }else{
            $this->dispatch('message', [
                'text' => "Có lỗi xảy ra",
                'type' => "error",
                'status' => 500,
            ]);
        }
    }

    public function vnpayOnlineOrder(){


        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "5M0AZ5Z6"; //Mã website tại VNPAY 
        $vnp_HashSecret = "AJPPCHCSHCRNVWFVQNOREUJGDLCIUNGH"; //Chuỗi bí mật

        $vnp_TxnRef = "10000000000"; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "Book Shopping";
        $vnp_Amount = "21321312";
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }

        return redirect($vnp_Url);
    }


    public function validationForAll(){
        $this->validate();
    }

    public function rules()
    {
        return [
            "fullname" => 'required|string|max:121',
            "email" => 'required|email|max:121',
            "phone" => 'required|string|min:10|max:11',
            "pincode" => 'required|string|min:6|max:6',
            "address" => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            "fullname.required" => 'Họ và tên không được bỏ trống',
            "fullname.max" => 'Họ và tên tối đa 121 ký tự',

            "email.required" => 'Email không được bỏ trống',
            "email.email" => 'Email phải đúng định dạng',
            "email.max" => 'Email tối đa 121 ký tự',

            "phone.required" => 'Số điện thoại không được bỏ trống',
            "phone.integer" => 'Số điện thoại không được nhập chữ',
            "phone.min" => 'Số điện thoại tối thiểu 10 ký tự',
            "phone.max" => 'Số điện thoại tối đa 11 ký tự',

            "pincode.required" => 'Pin code không được bỏ trống',
            "pincode.integer" => 'Pin code không được nhập chữ',
            "pincode.min" => 'Pin code tối thiểu 6 ký tự',
            "pincode.max" => 'Pin code tối đa 6 ký tự',

            "address.required" => 'Địa chỉ không được bỏ trống',
            "address.max" => 'Địa chỉ tối đa 500 ký tự',
        ];
    }

    //Trả tiền khi giao hàng

    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => "book-shopping-" . Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => "Đang tiến hành",
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);


        foreach ($this->carts as $cartItem) {

            $orderItems = Orderitem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price,
            ]);

            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }

        return $order;
    }

    public function codOrder()
    {
        $this->payment_mode = "Thanh toán khi nhận hàng";
        $codOrder = $this->placeOrder();

        if($codOrder){
            Cart::where("user_id",auth()->user()->id)->delete();

            session()->flash("message","Đặt hàng thành công");

            $this->dispatch('message', [
                'text' => "Đặt hàng thành công!",
                'type' => "success",
                'status' => 200,
            ]);

            return redirect()->to("thank-you");
        }else{
            $this->dispatch('message', [
                'text' => "Có lỗi xảy ra",
                'type' => "error",
                'status' => 500,
            ]);
        }
    }

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where("user_id", auth()->user()->id)->get();

        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }

    public function redirectToPaymentPage()
    {
        $this->dispatch('redirectToPaymentPage');
    }


    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            "totalProductAmount" => $this->totalProductAmount,
        ]);
    }
}
