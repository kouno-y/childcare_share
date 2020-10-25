@extends('layouts.app')

@section('title')
{{ __('プロフィール登録｜育シェア') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('プロフィール登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/profile/create') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right" dusk="tel">{{ __('電話番号') }}</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel" autofocus>

                                @error('tel')
                                    <span class="invalid-feedback" role="alert" dusk="tel_error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right" dusk="age">{{ __('年齢') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age">

                                @error('age')
                                    <span class="invalid-feedback" role="alert" dusk="age_error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right" dusk="sex">{{ __('性別') }}</label>

                            <div class="col-md-6">
                                <select name="sex" class="form-control @error('sex') is-invalid @enderror">
                                    <option value="1" @if (old('sex') == 1) selected @endif >女</option>
                                    <option value="2" @if (old('sex') == 2) selected @endif >男</option>
                                </select>
                                @error('sex')
                                    <span class="invalid-feedback" role="alert" dusk="sex_error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="introduction" class="col-md-4 col-form-label text-md-right" dusk="introduction">{{ __('自己紹介') }}</label>

                            <div class="col-md-6">
                                <textarea name="introduction" rows="4" class="form-control @error('introduction') is-invalid @enderror" >{{ old('introduction') }}</textarea>
                                @error('introduction')
                                    <span class="invalid-feedback" role="alert" dusk="introduction_error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" dusk="register">
                                    {{ __('プロフィール登録') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
