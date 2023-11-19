<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    function convertStatus($statusWithDiacritics)
    {
        $mappingTable = [
            'dang-tien-hanh' => 'Đang tiến hành',
            'da-hoan-thanh' => 'Đã hoàn thành',
            'cho-xy-ly' => 'Chờ xử lý',
            'da-huy' => 'Đã hủy',
            'dang-van-chuyen' => 'Đang vận chuyển',
        ];

        return $mappingTable[$statusWithDiacritics] ?? null;
    }

    public function index(Request $request)
    {

        // $todayDate = Carbon::now();
        // $orders = Order::whereDate("created_at",$todayDate)->paginate(10);

        $statusFromURL = $request->get("status");

        $statusInDB = $this->convertStatus($statusFromURL);

        $todayDate = Carbon::now()->format("Y-m-d");
        $orders = Order::when($request->date != null, function ($q) use ($request) {

            return $q->whereDate("created_at", $request->date);
        }, function ($q) use ($todayDate) {

            return $q->whereDate("created_at", $todayDate);
        })
            ->when($request->status != null, function ($q) use ($statusInDB) {

                return $q->whereDate("status_message", $statusInDB);
            })
            ->paginate(10);

        return view("admin.orders.index", compact("orders"));
    }

    public function show(int $orderId)
    {
        $todayDate = Carbon::now();

        $order = Order::where("id", $orderId)->first();

        if ($order) {
            return view("admin.orders.view", compact("order"));
        } else {
            return redirect()->back()->with("message", "Không tìm thấy hóa đơn này");
        }
    }

    public function updateOrderStatus(Request $request, int $orderId)
    {
        $todayDate = Carbon::now();

        $order = Order::where("id", $orderId)->first();

        if ($order) {
            $order->update([
                "status_message" => $request->order_status,
            ]);
            return redirect("admin/orders/" . $orderId)->with("message", "Cập nhập trạng thái đơn hàng thành công");
        } else {
            return redirect("admin/orders/" . $orderId)->with("message", "Không tìm thấy hóa đơn này");
        }
    }

    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view("admin.invoice.generate-invoice", compact("order"));
    }

    public function generateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ["order" => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        $todayDate = Carbon::now()->format("d-m-Y");
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }

    public function mailInvoice(int $orderId)
    {
        try {
            $order = Order::findOrFail($orderId);

            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));
            return redirect("admin/orders/".$orderId)->with("message","Đã gửi hóa đơn đến email ".$order->email);
        } catch (\Throwable $th) {

            return redirect("admin/orders/".$orderId)->with("message","Có lỗi xảy ra!");
        }
    }
}
