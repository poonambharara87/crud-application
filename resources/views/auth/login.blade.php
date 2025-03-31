
    @extends('components.app')

    @section('title', 'login')

    @section('content')

               

             
                <div class="form-group">
                    <form action="{{route('login-store')}}" method="POST">
                        @csrf   
                        <h4 class="text-center mb-4">Login</h1>

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email"  value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                             
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="exampleInputPassword" aria-describedby="passwordHelp">
                                
                            </div>
                            
                            <button class="btn btn-success" type="submit">Submit</button>

                    </form>
                </div>
    </div>
@endsection