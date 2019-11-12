@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
        <!-- mycode -->
        <div class="col-md-4">
            <?php 
                 $user = Auth::user()->id; "please, increase number of papper in book details to add more papar";
                 
                   ?>
             <label for="">{{$user}}</label>
        </div>
        <!-- end -->
    </div>
</div>
@endsection
