@extends('layouts.app')

@section('content')
<section class="vh-100 bg-dark overflow-auto">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card rounded-3">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Create a new Group</h2>

                        <form method="POST" action="{{ route('group.create') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-floating mb-2">
                                <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="* Name" required>
                                <label for="name">* Name</label>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-floating mb-2">
                                <textarea class="form-control" type="text" id="description" name="description" placeholder="* Description" autofocus required rows="10"></textarea>
                                <label for="description">* Description</label>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-check d-flex justify-content-center mb-5">
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-outline-secondary btn-lg bg-dark text-white">Create Group</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection