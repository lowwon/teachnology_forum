@extends('layout')
@section('content')
    <div style="margin-top : -54px;margin-right:400px;float : right; width: 200px;height: 10px;">
        <input type="text" style="display: inline-block;border-radius: 8px 8px 8px 8px" class="form-control" placeholder="Tìm kiếm">
    </div>
    @if(Auth::check())
        <div style="margin-top : -48px;margin-right:330px;float : right; width: 40px;height: 20px;">
            @if(count($noti) == 0)
                <img id="show" style="float: right;display: inline-block;width: 30px;height:30px;" src="images/tb.jpg">
            @else
                <img id="show" style="float: right;display: inline-block;width: 30px;height:30px;" src="images/tb1.jpg">
            @endif
            <div id="content" style="float: right; font-size: 17px; border-radius:15px 15px 15px 15px; position: relative;display: none; width: 300px; max-height: 360px; margin-top: 20px;background: #c2d0f0">
                @if(count($noti) == 0)
                    <div style="position: static; margin-bottom:10px; margin-top:10px; text-align: center"> 
                        <p>Thông báo trống</p>
                        <hr style="margin-top: 10px;margin-bottom:10px">
                    </div>
                    <script>
                        document.getElementById("show").onclick = function () {
                            if( document.getElementById("content").style.display == 'none')
                            {
                                document.getElementById("content").style.display = 'block';
                                document.getElementById("show").src = 'images/tb2.jpg';
                            }
                            else 
                            {
                                document.getElementById("content").style.display = 'none';
                                document.getElementById("show").src = 'images/tb.jpg';
                            }
            
                                return false;
                        };
                    </script>
                @else 
                    @foreach ($noti as $n)
                        <div style="position: static;margin-left: 30px;margin-right: 10px;margin-top: 20px"> 
                            <a href="{{route('changeNoti',['id'=>$n->id])}}">{{$n->content}}</a>
                            <p style="float: right;font-size: 10px;margin-top: 10px">{{$n->date}}</p>
                        </div>
                        <hr style="margin : 10px">
                    @endforeach
                    <script>
                        document.getElementById("show").onclick = function () {
                            if( document.getElementById("content").style.display == 'none')
                            {
                                document.getElementById("content").style.display = 'block';
                                document.getElementById("show").src = 'images/tb2.jpg';
                            }
                            else 
                            {
                                document.getElementById("content").style.display = 'none';
                                document.getElementById("show").src = 'images/tb1.jpg';
                            }
            
                                return false;
                        };
                    </script>
                @endif
                <div style="position: static ;bottom: 0px; margin-bottom:10px; text-align: center">
                    <a style="opacity: 1.0" href="#">View All</a>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid" style="min-height:700px">
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
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th class="col-2"><a >Chủ để</a></th>
                    <th class="col-3">Tiêu đề</th>
                    <th class="col-3">Ngày đăng</th>
                    <th class="col-2">Người đăng</th>
                    <th class="col-2">Trả lời</th>
                    <tr>
                </thead>
                <tbody>
                    @foreach ($post as $a)
                    <tr>
                        <td class="col-2"><a href="{{route('thaoluan')}}">
                            @foreach ($topic as $t)
                            @if($t->id == $a->topic_id)

                                     {{$t->Name}}
                                @endif
                            @endforeach
                        </a></td>
                        <td class="col-3"><a href="#">
                            <a href="{{route('viewPost',['id'=>$a->id])}}">
                            <?php
                                if (strlen($a->Name)>40)
                                {
                                    $str = substr($a->Name,0,40);
                                    echo $str;
                                }                                
                                else{
                                    echo $a->Name;
                                }
                            ?>
                            </a>
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
                                @if($u->id == $a->user_id)
                                <a  href="{{route('info',['id'=>$u->id])}}">{{$u->name}}</a>
                                @endif
                            @endforeach
                            
                        </td>
                        <td class="col-1">
                            <?php
                                $i = 0;
                                foreach ($comment as $c){
                                    if($c->post_id == $a->id)
                                    {
                                    $i = $i + 1;
                                    }
                                } 
                                echo $i;
                            ?>       
                        </td>
                    </tr>
                    @endforeach   
                </tbody>
            </table>
            {{ $post->links(); }}
        </div>
    </div>
@stop