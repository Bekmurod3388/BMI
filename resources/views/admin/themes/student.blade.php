@extends('admin.master')
@section('content')
    <div class="card m-2 p-2" style="box-shadow: 0px 0px 5px 5px rgba(194,215,236,0.63)">

        <div class="card-header  ">
            <h1 class="text float-start">Mavzular ro'yhati</h1>

            <form action="{{route('filtered-student-themes')}}" method="get"
                  class="form-group  d-flex float-end justify-content-between align-items-center ">


                <table class="text-center my-2">

                    <tr>
                        <th>
                            <label for="select0">Semestr</label>
                        </th>

                        <th>
                            <label for="select4">Amal</label>
                        </th>
                    </tr>
                    <tr>
                        <th>

                            <select name="semester" class="form-select" id="select0">
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


                        <th class="btn-group">
                            <button type="submit" class="btn btn-primary "><i class="bx bx-filter-alt"></i>Filtr
                            </button>

                        </th>
                    </tr>
                </table>
            </form>


        </div>
        <div class="card-body">
            <table class="table overflow-auto">
                <tr>
                    <th>Mavzu</th>
                    <th>Amallar</th>
                </tr>
                @foreach($themes as $theme)
                    <tr class="align-items-center">
                        <td class="">
                            <button data-bs-toggle="modal" data-bs-target="#batafsilModal{{$theme->id}}" type="button"
                                    class="btn btn-outline-dark">Batafsil
                            </button>

                        </td>
                        <td>{{$theme->name}}</td>
                    </tr>
                    <!-- Modal batafsil  -->
                    <div  class="modal fade" id="batafsilModal{{$theme->id}}" tabindex="-1"
                          aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div style="" class="modal-content">
                                <div class="modal-header border-top border-2" style="border-color: darkblue" >

                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tanlangan mavzuni o'zgartira
                                            olmaysiz, shu mavzuni tanlaysizmi ?</h1>



                                    <button type="button" class="btn-close "  data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{route('get-theme',$theme->id)}}" method="get">

                                    <div class="modal-body">

                                        <div class="card mb-3  border-primary border-top border p-2 border-2 " >
                                            <label for="name" class="form-label">Mavzu nomi</label>
                                            <p>{{$theme->name}}</p>
                                        </div>
                                        <div class="card mb-3  border-primary border-top border p-2 border-2 " >
                                            <label for="description" class="form-label">Izoh</label>
                                            <p>{!! $theme->description!!}</p>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish
                                        </button>

                                            <button type="submit" class="btn btn-primary">Mavzuni tanlash</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                @endforeach
            </table>
        </div>
    </div>




@endsection