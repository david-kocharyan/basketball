@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">{{$title}}</h3>
                @if(count($home_gallery) < 6)
                    <a href="{{$route."/create"}}" class="btn btn-success m-b-30"><i class="fas fa-plus"></i> Add Home Screen Album</a>
                @endif
                {{--table--}}

                <div class="table-responsive">
                    <table id="datatable" class="display table table-hover table-striped" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Album</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($home_gallery as $key=>$val)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td><img src='{{asset("uploads/home_gallery")."/".$val->image}}' style="width: 120px;" class="img-responsive"></td>
                                <td class="text_{{ $val->id }}">{{$val->album->name}}</td>
                                <td>
                                    <a href="{{$route."/".$val->id."/edit"}}" data-toggle="tooltip"
                                       data-placement="top" title="Edit" class="btn btn-info btn-circle tooltip-info">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form style="display: inline-block" action="{{ $route."/".$val->id }}"
                                          method="post" id="work-for-form">
                                        @csrf
                                        @method("DELETE")
                                        <a href="javascript:;" class="delForm" data-id ="{{$val->id}}">
                                            <button data-toggle="tooltip"
                                                    data-placement="top" title="Delete"
                                                    class="btn btn-danger btn-circle tooltip-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('custom-style')
        <style>
            .swal-modal {
                width: 660px !important;
            }
        </style>
    @endpush

    @push('custom-datatable')
        <script>
            $('#datatable').DataTable();
        </script>
    @endpush

    @push('custom-script')
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            $('.delForm').on('click', function (event) {
                event.preventDefault();
                var id = $(this).data('id');
                var text = $('.text_'+id).html();

                swal({
                    title: "Are you sure you want to delete the image?",
                    text: text,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $("#work-for-form").submit();
                    } else {
                        swal.close();
                    }
                });
            })
        </script>
    @endpush

@endsection





