@extends('layouts.app')

@push('custom-style')
    <style>
        .inputfile-1 + label {
            color: #fff3f4;
            background-color: #1e88e5;
        }
        .inputfile + label {
            max-width: 80%;
            font-size: 18px;
            font-weight: 500;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
            padding: 0.625rem 1.25rem;
        }
        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{$title}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form method="post" action="{{ $route }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="full_name">Name</label>
                                @error('name')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="text" class="form-control" id="name"
                                       placeholder="Name" name="name" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                @error('type')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <select name="type" id="type" class="form-control">
                                    <option  value="0" {{old('type') == 0 ? 'selected' : "" }}>Academy</option>
                                    <option  value="1" {{old('type') == 1 ? 'selected' : "" }}>Game</option>
                                </select>
                            </div>

                            <div class="form-group">
                                @error('image')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <b class="text-danger"> Recommended size 1920x1280px </b>
                                <br>
                                <input type="file" name="image[]" id="file-1" class="inputfile inputfile-1"
                                       data-multiple-caption="<i class='mdi mdi-cloud-upload fa-fw'></i>  {count} files selected" multiple>
                                <label for="file-1"><span> <i class="mdi mdi-cloud-upload fa-fw"></i> Select Image(s)</span></label>
                            </div>


                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Save Gallery
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('custom-script')
    <script>
        $(document).ready(function () {
            ( function ( document, window, index )
            {
                var inputs = document.querySelectorAll( '.inputfile' );
                Array.prototype.forEach.call( inputs, function( input )
                {
                    var label	 = input.nextElementSibling,
                        labelVal = label.innerHTML;

                    input.addEventListener( 'change', function( e )
                    {
                        var fileName = '';
                        if( this.files && this.files.length > 1 )
                            fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                        else
                            fileName = e.target.value.split( '\\' ).pop();

                        if( fileName )
                            label.querySelector( 'span' ).innerHTML = fileName;
                        else
                            label.innerHTML = labelVal;
                    });

                    // Firefox bug fix
                    input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
                    input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
                });
            }( document, window, 0 ));
        })
    </script>
@endpush
