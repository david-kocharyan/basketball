@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{$title}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form method="post" action="{{ "/admin/game-finish/".$game->id }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method("PUT")

                            <div class="form-group">
                                <label for="score_1">Club 1 Score ( {{$game->club[0]->name}} )</label>
                                @error('score_1')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="number" name="score_1" value="{{$game->game_club[0]->score}}" class="form-control" id="score_1">
                            </div>

                            <div class="form-group">
                                <label for="score_2">Club 2 Score ( {{$game->club[1]->name}} )</label>
                                @error('score_2')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="number" name="score_2" value="{{$game->game_club[1]->score}}" class="form-control" id="score_2">
                            </div>

                            <div class="form-group">
                                <label for="player">Best Player</label>
                                @error('player')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="text" name="player" value="{{$game->best_player}}" class="form-control" id="player">
                            </div>

                            <div class="form-group">
                                <label for="stats">Stats</label>
                                <div id="stats" class="form-group" style="display: flex; justify-content: space-evenly;">
                                    <input type="text" name="pts" value="{{$game->pts}}" class="form-control" style="width: 15%; display: inline-block;" placeholder="PTS">
                                    <input type="text" name="rb" value="{{$game->rb}}" class="form-control" style="width: 15%; display: inline-block;" placeholder="RB">
                                    <input type="text" name="ast" value="{{$game->ast}}" class="form-control" style="width: 15%; display: inline-block;" placeholder="AST">
                                    <input type="text" name="stl" value="{{$game->stl}}" class="form-control" style="width: 15%; display: inline-block;" placeholder="STL">
                                    <input type="text" name="blk" value="{{$game->blk}}" class="form-control" style="width: 15%; display: inline-block;" placeholder="BLK">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Finish Game
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('custom-style')
    <!--This is a Select 2 style -->
    <link href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Date picker plugins css  Date Picker Plugin JavaScript-->
    <link href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- Time picker plugins css  Time Picker Plugin JavaScript -->
    <link href="{{asset('assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <script src="{{asset('assets/plugins/clockpicker/dist/bootstrap-clockpicker.min.js')}}"></script>
@endpush

@push('custom-script')
    <!--Select2 js-->
    <script src="{{asset('assets/plugins/select2/dist/js/select2.min.js')}}"></script>

    <script !src="">
        $('#club_1').select2();
        $('#club_2').select2();
        $('#type').select2();
        $('#competition').select2();
        $('#venue').select2();

        $('#type').on('change', function () {
            if (this.value == "Friendly") {
                $('#competition').prop('disabled', true);
                $('#competition').val(0).change();
            } else {
                $('#competition').prop('disabled', false);
            }
        });

        $('#date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
        });

        $('#time').clockpicker({
            autoclose: true,
            placement: 'top',
            align: 'left',
            default: 'now'
        });

    </script>
@endpush

