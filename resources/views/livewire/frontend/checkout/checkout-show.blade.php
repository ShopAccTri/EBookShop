<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Thanh toán</h4>
            <hr>

            @if ($this->totalProductAmount != '0')
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Tổng tiền sản phẩm :
                                <span
                                    class="float-end">{{ number_format($totalProductAmount, 0, ',', '.') . ' vn₫' }}</span>
                            </h4>
                            <hr>
                            <small>* Sản phẩm sẽ được giao đến từ 3 đến 5 ngày.</small>
                            <br />
                            <small>* Đã bao gồm thuế và những chi phí khác.</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Thông tin cơ bản
                            </h4>
                            <hr>

                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Họ và tên</label>
                                        <input type="text" wire:model.defer="fullname" id="fullname"
                                            class="form-control" placeholder="Enter Full Name" />
                                        @error('fullname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Số điện thoại</label>
                                        <input type="number" wire:model.defer="phone" id="phone"
                                            class="form-control" placeholder="Enter Phone Number" />
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Địa chỉ email</label>
                                        <input type="email" wire:model.defer="email" id="email"
                                            class="form-control" placeholder="Enter Email Address" />
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Pin-code (Zip-code)</label>
                                        <input type="number" wire:model.defer="pincode" id="pincode"
                                            class="form-control" placeholder="Enter Pin-code" />
                                        @error('pincode')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Địa chỉ nhà</label>
                                        <textarea wire:model.defer="address" id="address" class="form-control" rows="2"></textarea>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Lựa chọn phương thức thanh toán: </label>
                                        <div class="d-md-flex align-items-start">
                                            <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab"
                                                role="tablist" aria-orientation="vertical">
                                                <button wire:loading.attr="disabled" class="nav-link active fw-bold"
                                                    id="cashOnDeliveryTab-tab" data-bs-toggle="pill"
                                                    data-bs-target="#cashOnDeliveryTab" type="button" role="tab"
                                                    aria-controls="cashOnDeliveryTab" aria-selected="true">Thanh toán
                                                    khi nhận hàng</button>
                                                <button wire:loading.attr="disabled" class="nav-link fw-bold"
                                                    id="onlinePayment-tab" data-bs-toggle="pill"
                                                    data-bs-target="#onlinePayment" type="button" role="tab"
                                                    aria-controls="onlinePayment" aria-selected="false">Thanh toán
                                                    online</button>
                                            </div>
                                            <div class="tab-content col-md-9" id="v-pills-tabContent">
                                                <div class="tab-pane active show fade" id="cashOnDeliveryTab"
                                                    role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab"
                                                    tabindex="0">
                                                    <h6>Phương thức thanh toán khi nhận hàng</h6>
                                                    <hr />
                                                    <button type="button" wire:loading.attr="disabled"
                                                        wire:click="codOrder" class="btn btn-primary">
                                                        <span wire:loading.remove wire:target="codOrder">
                                                            Đặt hàng (Thanh toán khi nhận hàng)
                                                        </span>
                                                        <span wire:loading wire:target="codOrder">
                                                            Đang đặt hàng...
                                                        </span>
                                                    </button>

                                                </div>
                                                <div class="tab-pane fade" id="onlinePayment" role="tabpanel"
                                                    aria-labelledby="onlinePayment-tab" tabindex="0">
                                                    <h6>Phương thức thanh toán</h6>
                                                    <hr />
                                                    <button type="button" wire:click="makePayment"
                                                        class="btn btn-warning">Mua ngay (VnPay)</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            @else
                <div class="card card-body shadow text-center p-md-5">
                    <h4>Không có sản phẩm nào cần thanh toán</h4>
                    <a href="{{ url('collections') }}" class="btn btn-warning text-white">Mua ngay</a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    {{-- <script --}}
    {{-- src="https://www.paypal.com/sdk/js?client-id=AQ2vCBzQ3_J9TNHhczChXDTvVxrbTcosjUz8ToytxA_EzBM6vgrlwV0D7qP_FdRMys_CXspd5P3zKiSx&currency=USD">
    </script>

    <script>
        // paypal.Buttons({
        //     // onClick: function() {
        //     //     if(!document.queryElementById("fullname").value
        //     //         || !document.queryElementById("phone").value
        //     //         || !document.queryElementById("email").value
        //     //         || !document.queryElementById("pincode").value
        //     //         || !document.queryElementById("address").value
        //     //     )
        //     //     {
        //     //         Livewire.dispatch("validationForAll");
        //     //         return false;
        //     //     }else{
        //     //         @this.set("fullname",document.queryElementById("fullname").value);
        //     //         @this.set("email",document.queryElementById("email").value);
        //     //         @this.set("phone",document.queryElementById("phone").value);
        //     //         @this.set("pincode",document.queryElementById("pincode").value);
        //     //         @this.set("address",document.queryElementById("address").value);
        //     //     }
        //     // },

        //     onClick: function() {
        //         var fullname = document.getElementById("fullname").value;
        //         var phone = document.getElementById("phone").value;
        //         var email = document.getElementById("email").value;
        //         var pincode = document.getElementById("pincode").value;
        //         var address = document.getElementById("address").value;

        //         if (!fullname || !phone || !email || !pincode || !address) {
        //             Livewire.dispatch("validationForAll");
        //             // Hủy bỏ sự kiện mặc định để ngăn form được gửi khi không hợp lệ
        //             return false;
        //         } else {
        //             @this.set("fullname", fullname);
        //             @this.set("email", email);
        //             @this.set("phone", phone);
        //             @this.set("pincode", pincode);
        //             @this.set("address", address);
        //         }
        //     },


        //     createOrder: (data, actions) => {

        //         return actions.order.create({
        //             purchase_units: [{
        //                 amount: {
        //                     value: "0.1" //"{{ $this->totalProductAmount }}" 
        //                 }
        //             }]
        //         });
        //     },

        //     onApprove: (data, actions) => {
        //         return actions.order.capture().then(function(orderData) {
        //             console.log("Capture result", orderData, JSON.stringify(orderData, null, 2));
        //             const transaction = orderData.purchase_units[0].payments.captures[0];

        //             if (transaction.status == "COMPLETED") {
        //                 Livewire.dispatch("transactionEmit", transaction.id);
        //             }

        //             // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`)
        //         });
        //     }

        // }).render("#paypal-button-container"); --}}
    {{-- </script> --}}
@endpush
