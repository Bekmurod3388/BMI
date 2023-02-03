@extends('admin.master')
@section('content')
    <div class="card m-2 p-2" style="box-shadow: 0px 0px 5px 5px rgba(194,215,236,0.63)">
        <div class="card-header d-flex justify-content-between">

        </div>
        <div class="card-body">
            @if($process)
                <h1 class="text text-center text-dark">Jarayon</h1>
                <hr>
                <h3 class="text text-dark"><span class="fw-bolder">Mavzu: </span> {{$process->theme->name}}</h3>
                <hr>
                <h4 class="text text-dark"><span class="fw-bolder">Izoh: </span> {{$process->theme->description}}</h4>
                <hr>
                <h4 class="text text-dark"><span class="fw-bolder">O'qituvchi: </span> {{$process->theme->teacher_id}}</h4>
                <hr>
                <form action="">
                    <label for="student_textarea" class="form-label">Mundarija:</label>
                    <textarea name="process" id="student_textarea" cols="30" rows="10"  class="form-control"></textarea>

                </form>
            @else
                <h1 class="text text-center text-dark "> <span> Sizda mavzu tanlanmagan</span></h1>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-primary d-flex align-items-center" href="{{route('themes')}}">Mavzu tanlash  <i class="m-1 bx bx-link-external"></i></a>
                </div>
            @endif

        </div>
    </div>
    <!-- Button trigger modal -->




@endsection

