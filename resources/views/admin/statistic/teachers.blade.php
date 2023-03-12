@extends('admin.master')
@section('content')
    <div class="card">
        <div class="">
            <form action="{{route('statistics-teacher')}}" method="get"
                  class="form-group d-flex justify-content-between align-items-center m-3">
                <h1 class="text text-center">O'qituvchilar ro'yhati</h1>

                <table class="text-center m-2">
                    <tr>
                        <th>
                            <label for="select1">Yil</label>
                        </th>
                        <th>
                            <label for="select0">Semestr</label>
                        </th>

                        <th>
                            <label for="select2">Tartib</label>
                        </th>
                        <th>
                            <label for="select4">Amal</label>
                        </th>
                    </tr>
                    <tr>
                        <th>

                            <select name="year" class="form-select" id="select0">
                                <option selected value="0">Barchasi</option>
                                <option @if($options->year=='2022-2023') selected @endif value="2022-2023">
                                    2022-2023
                                </option>
                            </select>
                        </th>
                        <th>

                            <select name="semester" class="form-select" id="select0">
                                <option selected value="0">Barchasi</option>
                                <option @if($options->semester=="5-semestr") selected @endif value="5-semestr">
                                    5-semestr
                                </option>
                                <option @if($options->semester=="6-semestr") selected @endif value="6-semestr">
                                    6-semestr
                                </option>
                                <option @if($options->semester=="7-semestr") selected @endif value="7-semestr">
                                    7-semestr
                                </option>
                                <option @if($options->semester=="8-semestr") selected @endif value="8-semestr">
                                    8-semestr
                                </option>
                            </select>
                        </th>
                        <th>

                            <select name="sort" class="form-select" id="select0">
                                <option @if($options->sort=='DESC') selected @endif value="DESC">
                                    Kamayish
                                </option>
                                <option @if($options->sort=='ASC') selected @endif value="ASC">
                                    O'sish
                                </option>
                            </select>
                        </th>

                        <th>
                            <button type="submit" class="btn btn-primary "><i class="bx bx-filter-alt"></i>Filtr
                            </button>
                        </th>
                    </tr>
                </table>
            </form>
        </div>

        <div class="card-body border-top border-2 border-primary overflow-auto">

            <table class="table ">
                <tr>
                    <th>#</th>
                    <th>O'qituvchi</th>
                    <th>Mavzular soni</th>
                    <th>Bajarilgan</th>
                    <th>Yangi</th>
                    <th>Jarayonda</th>
                    <th>Tugallangan</th>
                </tr>
@foreach($teachers as $teacher)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$teacher['teacher']['name']}}</td>
                    <td>{{$teacher['count']}} ta</td>
                    <td>@if($teacher['count']>0) {{round($teacher['percentage']/$teacher['count'])}} @else 0 @endif %</td>
                    <td>{{$teacher['new']}} ta</td>
                    <td>{{$teacher['progress']}} ta</td>
                    <td>{{$teacher['end']}} ta</td>
                </tr>
@endforeach
            </table>

{{--            <div class="mt-3">--}}
{{--                {{ $teachers->appends([--}}
{{--                    'semester' => $options->semester,--}}
{{--                    'year' => $options->year,--}}
{{--                    'sort'=> $options->sort,--}}
{{--                    ])->links() }}--}}

{{--            </div>--}}
        </div>
    </div>
@endsection

