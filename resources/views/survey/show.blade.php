@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1> {{ $questionnaire->title }} </h1>
            <form action="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}" method="post">
                @csrf

                @foreach($questionnaire->questions as $key=>$question)
                <div class="card mt-4">
                    <div class="card-header"><strong>{{ $key + 1 }} : </strong>{{ $question->question }}</div>
                        <div class="card-body">

                            @error('responses.' . $key. '.answer_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror


                            <ul class="list-group">
                                @foreach($question->answers as $answer)
                                
                                <li class="list-group-item">
                                    <input type="radio" name="responses[{{ $key }}][answer_id] " id="answer{{ $answer->id }}"
                                        {{ (old('responses.' . $key. '.answer_id') == $answer->id) ? 'checked': '' }}
                                    class="mr-2" value="{{ $answer->id }}">
                                        <label for="answer{{ $answer->id }}">
                                        {{ $answer->answer }}
                                        </label>
                                        <input type="hidden" name="responses[{{ $key }}][question_id] " id="question{{ $question->id}}" 
                                        value="{{ $question->id }}""> 
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                       
                @endforeach
                <button class="btn btn-dark" type="submit">Complete Survey</button>
            </form>

            <div class="card">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input name="name" type="text" class="form-control" id="name" aria-describedby="name" placeholder="Enter Name">
                    <small id="nameHelp" class="form-text text-muted">Hello! What's your name?</small>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="email" placeholder="Enter Email">
                    <small id="emailHelp" class="form-text text-muted">Your Email Please!</small>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
