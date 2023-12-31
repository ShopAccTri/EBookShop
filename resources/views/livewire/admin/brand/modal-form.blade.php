<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addbrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm nhà xuất bản</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeBrand()">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Chọn danh mục</label>
                        <select wire:model.defer="category_id" required id="" class="form-control">
                            <option value="">--Chọn danh mục --</option>
                            @foreach ($categories as $cateItem)
                                <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                            @endforeach
                        </select>
                        @error("category_id")
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Tên nhà xuất bản</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error("name")
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Trạng thái</label> <br>
                        <input type="checkbox" wire:model.defer="status" style="width: 70px; height: 70px;">
                        @error("status")
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary text-white">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Update Brand Modal -->
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật nhà xuất bản</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div> Loading...
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateBrand">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Chọn nhà xuất bản</label>
                            <select wire:model.defer="category_id" required id="" class="form-control">
                                <option value="">--Chọn nhà xuất bản--</option>
                                @foreach ($categories as $cateItem)
                                    <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                                @endforeach
                            </select>
                            @error("category_id")
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Tên nhà xuất bản</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error("name")
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Trạng thái</label> <br>
                            <input type="checkbox" wire:model.defer="status" style="width: 70px; height: 70px;">
                            @error("status")
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" wire:click='closeModal' class="btn btn-danger text-white" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary text-white">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Brand Modal -->
<div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa nhà xuất bản</h1>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div> Loading...
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="destroyBrand">
                    <div class="modal-body">
                        <h4>Bạn có chắc muốn xóa cái này không ?</h4>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" wire:click='closeModal' class="btn btn-danger text-white" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary text-white">Xóa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>