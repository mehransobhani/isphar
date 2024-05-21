
@extends('admin.layout.auth')

@section('title','ورود مدیران ')
@section('content')
    <section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">

                @if ($errors && $errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                @if(session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                        </button>
                        {{ session('error') }}
                    </div>
                @endif



                <form class="form-horizontal form-material" id="loginform" action="{{route("login")}}" method="post" >
                    @csrf
                    <h3 class="box-title m-b-20">ورود</h3>
                    <div class="form-group ">
                        <div class="col-12">
                            <input class="form-control" type="text" required="" name="email" placeholder="ایمیل">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <input class="form-control" type="password" required="" name="password" placeholder="رمز عبور">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-right p-t-0">
                                <input id="checkbox-signup" type="checkbox" name="remember" value="1">
                                <label for="checkbox-signup"> به خاطر سپاری </label>
                            </div>
                     </div>
                     </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">ورود</button>
                        </div>
                    </div>


                </form>
             </div>
        </div>
    </section>
@endsection

