@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Question</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('questions.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="question_text">Question Text</label>
                            <input id="question_text" type="text" class="form-control" name="question_text" required autofocus>
                        </div>

                        

                        <button type="submit" class="btn btn-primary">Create Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection