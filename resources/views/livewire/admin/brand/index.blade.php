<div>

    @include("livewire.admin.brand.modal-form")

    <div class="row">
        <div class="col-md-12">
            @if(session("message"))
                <div class="alert alert-success">{{ session("message") }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách NXB
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addbrandModal" class="btn btn-primary text-white btn-sm float-end">Thêm nhà xuất bản</a>
                    </h3>
                </div>
    
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên NXB</th>
                                <th>Tên danh mục</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    @if ($brand->category)
                                        {{ $brand->category->name }}
                                    @else
                                        Không có danh mục
                                    @endif
                                </td>
                                <td>{{ $brand->status == "1" ? "Hiện" : "Ẩn" }}</td>
                                <td>
                                    <a href="#" wire:click="editBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="btn btn-sm btn-success text-white">Sửa</a>
                                    <a href="#"  wire:click="deleteBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal" class="btn btn-sm btn-danger text-white">Xóa</a>
                                </td>
                            </tr> 
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Không có sản phẩm</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event =>{
            $("#addbrandModal").modal('hide');
            $("#updateBrandModal").modal('hide');
            $("#deleteBrandModal").modal('hide');
        });
    </script>
@endpush