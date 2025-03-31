
    @extends('components.app')

    @section('title', 'Register')

    @section('content')

                <div class="form-group">
                    <form action="{{route('register-store')}}" method="POST">
                        @csrf   
                        <h4 class="text-center mb-4">Registeration</h1>
                      
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="name" name="username" class="form-control" id="exampleInputName1" aria-describedby="nameHelp">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                
                                <input type="password" name="password" class="form-control" id="exampleInputPassword" aria-describedby="passwordHelp">
                            </div>
                            <div class="mb-3">
                                <label for="password-confirmation">Confirm Password</label>
                                <input type="password-confirmation" name="password-confirmation"class="form-control"  aria-describedby="passwordConfirmationHelp">
                            </div>
                            <button class="btn btn-success" type="submit">Submit</button>

                    </form>
                </div>
    </div>
@endsection
