<div>

    <div wire:ignore.self class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Xóa danh mục</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyCategory">
                <div class="modal-body">
                    <h6>Bạn có chắc muốn xóa cái này không?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary text-white">Xóa</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
    
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Danh mục
                        <a href="{{ url('admin/categories/create') }}"
                            class="btn btn-primary text-white btn-sm float-end">Thêm danh mục</a>
                        </h4>
                </div>
    
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </thead>
    
                        <tbody>
                            @forelse ($categories as $cate)
                            <tr>
                                <td>{{ $cate->id }}</td>
                                <td>{{ $cate->name }}</td>
                                <td>{{ $cate->status == "1" ? "Hiện" : "Ẩn" }}</td>
                                <td>
                                    <a href="{{ url("admin/categories/".$cate->id."/edit") }}" class="btn btn-success text-white">Sửa</a>
                                    <a href="" wire:click="deleteCategory({{$cate->id}})" data-bs-toggle="modal" data-bs-target="#DeleteModal" class="btn btn-danger text-white">Xóa</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Không có danh mục</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
    
                    <div>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event =>{
            $("#DeleteModal").modal('hide');
        });
    </script>
@endpush