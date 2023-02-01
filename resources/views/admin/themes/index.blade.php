@extends('admin.master')
@section('content')
    <div class="card m-2 p-2" style="box-shadow: 0px 0px 5px 5px rgba(194,215,236,0.63)">
        <div class="card-header d-flex justify-content-between">
            <h1 class="text text-center text-dark">Mavzular ro'yhati</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bx bx-plus"></i> Qo'shish
            </button>
        </div>
        <div class="card-body">
            <table class="table overflow-auto">
                <tr>
                    <th>Amallar</th>
                    <th>Mavzu</th>
                </tr>
                @foreach($themes as $theme)
                    <tr>
                        <td class="d-flex">
                            <button data-bs-toggle="modal" data-bs-target="#batafsilModal{{$theme->id}}" type="button" class="btn btn-success" >Batafsil</button>
                        </td>
                        <td>{{$theme->name}}</td>
                    </tr>
                    <!-- Modal batafsil create -->
                    <div class="modal fade" id="batafsilModal{{$theme->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tanlangan mavzuni o'zgartira olmaysiz, shu mavzuni tanlaysizmi ?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('get-theme',$theme->id)}}" method="get">

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Mavzu nomi</label>
                                            <p>{{$theme->name}}</p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Izoh</label>
                                            <p>{{$theme->description}}</p>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
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
    <!-- Button trigger modal -->


    <!-- Modal create -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mavzu yaratish</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('store-theme')}}" method="post">@csrf
                <div class="modal-body">

                        <div class="mb-3">
                            <label for="name" class="form-label">Mavzu nomi</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Mavzu nomini kiriting">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Izoh</label>
                            <textarea class="form-control" name="description" id="description" rows="4" placeholder="Ushbu mavzuda talaba..."></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                    <button type="submit" class="btn btn-primary">O'zgarishlarni saqlash</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection