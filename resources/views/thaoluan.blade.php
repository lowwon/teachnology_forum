@extends('layout')
@section('content')

    <div class="container-fluid">
        <h1 class="tieude">Cac bai viet moi</h1>
        <div  class="post hidden sm:flex sm:items-center sm:ml-6 ">
            @if (Route::has('login'))
                @auth
                <a href="{{route('dangbai')}}"><input type="button" class="btn btn-primary" value="Đăng bài" id="db" nam="db"> </a>                 
            @else
                <a href="{{ route('login') }}" ><input type="button" class="btn btn-primary" value="Đăng bài"></a>
                @endauth
            @endif
        </div>
        <div class="contents">          
            <table class="table table-success table-dark">
                <thead>
                    <th class="col-2"><a >Chủ để</a></th>
                    <th class="col-3">Tiêu đề</th>
                    <th class="col-3">Ngày đăng</th>
                    <th class="col-2">Người đăng</th>
                    <th class="col-2">Trả lời</th>
                </thead>
                <tbody>
                    @foreach ($post as $a)
                    <tr>
                        <td class="col-2"><a href="{{route('thaoluan')}}">
                            @foreach ($topic as $t)
                                @if($t->TopicId == $a->TopicId)
                                     {{$t->Name}}
                                @endif
                            @endforeach
                        </a></td>
                        <td class="col-3"><a href="#">
                            <a href="#"><?php
                                if (strlen($a->Name)>40)
                                {
                                    $str = substr($a->Name,0,40);
                                    echo $str;
                                }                                
                                else{
                                    echo $a->Name;
                                }
                            ?></a>
                        </a></td>
                        <td style="" class="col-3">
                            <?php
                                if (strlen($a->Date)>50)
                                {
                                    echo $a->Date;
                                }                                
                                else{
                                    echo $a->Date;
                                }
                            ?>
                        </td>
                        <td class="col-2"> 
                             @foreach ($user as $u)
                                @if($u->id == $a->UserID)
                                    {{$u->name}}
                                @endif
                            @endforeach
                            
                        </td>
                        <td class="col-2">1</td>
                    </tr>
                    @endforeach   
                </tbody>
            </table>
        </div>
    </div
@stop