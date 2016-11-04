@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    
    [v-cloak] {
        display: none;
    }
</style>
<!-- // v-cloak slaga tozi klass s zel izbqgvane na pokazvane na {} predi da e zaredilo vuejs -->
<div id="test" v-cloak>
    <h1> @{{name}} </h1>
    <example v-bind:parrant_msg="parrant_msg">

    </example>
    
   
    <example v-bind:parrant_msg="parrant_msg"></example>
    
</div>
@endsection
