@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{$title}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form method="post" action="{{ $route."/".$schedule->id }}" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")

                            <div class="form-group">
                                <label for="team">Team</label>
                                @error('team')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <select name="team" id="team" class="form-control">
                                    @foreach($teams as $key)
                                        <option
                                            value="{{$key->id}}" {{$schedule->team_id == $key->id ? 'selected' : "" }}>{{$key->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="price">Price per Month</label>
                                @error('price')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="number" class="form-control" id="price"
                                       placeholder="Price" name="price" value="{{$schedule->price}}">
                            </div>

                            <div class="form-group">
                                <label for="price">Days and Time</label>
                                @error('day')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                @error('time')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                            </div>

                            <div class="col-sm-6 nopadding">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="day" name="day[]" value=""
                                           placeholder="Day">
                                </div>
                            </div>

                            <div class="col-sm-6 nopadding">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="time" name="time[]" value=""
                                               placeholder="Time">
                                        <div class="input-group-btn ml-1">
                                            <button class="btn btn-success" type="button" onclick="education_fields();">
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div id="education_fields"></div>


                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Save Schedule
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Edit Schedule Date</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-hover table-striped nowrap" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($date as $key=>$val)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$val->day}}</td>
                                        <td>{{$val->time}}</td>
                                        <td>
                                            <form
                                                onsubmit="if(confirm('Do You Really Want To Delete The Schedule Date ?') == false) return false;"
                                                style="display: inline-block"
                                                action="{{ $route."/".$schedule->id."/destroy-date/".$val->id }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="javascript:void(0)">
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
        </div>
    </div>
@endsection


@push('custom-script')
    <script !src="">
        var room = 1;

        function education_fields() {

            room++;
            var objTo = document.getElementById('education_fields')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass" + room);
            var rdiv = 'removeclass' + room;
            divtest.innerHTML = `
                                <div class="col-sm-6 nopadding">
                                <input type="text" class="form-control" id="day" name="day[]" value=""
                                           placeholder="Day">
                            </div>

                            <div class="col-sm-6 nopadding">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="time" name="time[]" value=""
                                               placeholder="Time">

                <div class="input-group-btn">
                <button class="btn btn-danger" type="button" onclick="remove_education_fields(${room});">
                 <span class="glyphicon glyphicon-minus" aria-hidden="true">
                </span> </button></div></div></div></div><div class="clear">
                </div>`;

            objTo.appendChild(divtest)
        }

        function remove_education_fields(rid) {
            $('.removeclass' + rid).remove();
        }
    </script>
@endpush
