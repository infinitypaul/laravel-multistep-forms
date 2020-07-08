# Laravel Multi-step Form
[![Latest Version on Packagist](https://img.shields.io/packagist/v/infinitypaul/laravel-multistep-forms.svg?style=flat-square)](https://packagist.org/packages/infinitypaul/laravel-multistep-forms)
[![Build Status](https://img.shields.io/travis/infinitypaul/laravel-multistep-forms/master.svg?style=flat-square)](https://travis-ci.org/infinitypaul/laravel-multistep-forms)
[![Quality Score](https://img.shields.io/scrutinizer/g/infinitypaul/laravel-multistep-forms.svg?style=flat-square)](https://scrutinizer-ci.com/g/infinitypaul/laravel-multistep-forms)
[![Total Downloads](https://img.shields.io/packagist/dt/infinitypaul/laravel-multistep-forms.svg?style=flat-square)](https://packagist.org/packages/infinitypaul/laravel-multistep-forms)

Hi Fellas! So you know how you would like to create a dynamic registration form but then you can't because you feel this is impossible with PHP.

Well, I have good news for ya, this is so POSSIBLE with this package. Yeah that's right, I mean it. Let's get down on the "how":

So we will be working with a 3 step form:

## Installation

You can install the package via composer:

```bash
composer require infinitypaul/laravel-multistep-forms
```

## Usage
After installing the package, I will be creating 3 blades for the different steps of the form:

#### Step 1: Create the blades for the form.
1.blade.php
``` php
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    @extends('layouts.app')

    @section('content')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Register') }} </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('auth.register.1.store') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?: $step->name }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="form-group row">
                                    <label for="middle" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>
                                    <div class="col-md-6">
                                        <input id="text" type="text" class="form-control @error('middle') is-invalid @enderror" name="middle" value="{{ old('middle') ?: $step->middle }}" required autocomplete="email" autofocus>

                                        @error('middle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Next') }}
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

```


2.blade.php
``` php
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('auth.register.2.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?: $step->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Next') }}
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

```

3.blade.php
``` php
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('auth.register.3.store') }}">
                            @csrf


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Finish') }}
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

```
#### Step 2: Create the controller for the each form.

After creating the blade views for each of the forms, p.s: I created them in a folder "register". We'll be heading to the controller, so in app\Http\Controllers\Auth, we would be creating a folder "Register" i.e our path will be "app\Http\Controllers\Auth\Register". In the Register folder, we would be creating 3 controllers for the three steps:

RegisterControllerStep1.php
``` php
<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Infinitypaul\MultiStep\MultiStep;


class RegisterControllerStep1 extends Controller
{
    public function index(){

        $step  =MultiStep::step('auth.register', 1);
        return view('auth.register.1', compact('step'));
    }

    public function store(Request $request){
        MultiStep::step('auth.register', 1)->store(['name' => $request->name, 'middle' => $request->middle])->complete();
        return redirect()->route('auth.register.2.index');
    }
}

```

RegisterControllerStep2.php
``` php
<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infinitypaul\MultiStep\MultiStep;

class RegisterControllerStep2 extends Controller
{
    public function index(){
        $step  =MultiStep::step('auth.register', 2);
        return view('auth.register.2', compact('step'));
    }


    public function store(Request $request){
        MultiStep::step('auth.register', 2)->store($request->only('email'))->complete();

        return redirect()->route('auth.register.3.index');
    }
}

```
RegisterControllerStep3.php

``` php
<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infinitypaul\MultiStep\MultiStep;


class RegisterControllerStep3 extends Controller
{
    public function index(){
        $step = MultiStep::step('auth.register', 3);
        if($step->notCompleted(1)){
            return redirect()->route('auth.register.1.index');
        }
        return view('auth.register.3');
    }

    public function store(MultiStep $multiStep, Request $request){
        MultiStep::step('auth.register', 3)->store($request->only('password'))->complete();

        MultiStep::clearAll();
    }
}

```
#### Step 3: Routing!

Let's move on to the route, in our web.php, we will include this:
``` php
Route::multistep('auth/register', 'Auth\Register\RegisterController')
    ->steps('3')
    ->name('auth.register')
    ->only(['index', 'store']);
```

We're done guys!!!

So if I head to {URL}/auth/register/1, I would see this:
![Form 1](https://github.com/Vheekey/testing-readme/blob/master/Screenshot_2020-07-08%20Laravel.png)

When I click on next, it takes me to {URL}/auth/register/2 and this will display:
![Form 2](https://github.com/Vheekey/testing-readme/blob/master/Screenshot_2020-07-08%20Laravel(1).png)

On clicking on next, we get {URL}/auth/register/3:
![Form 3](https://github.com/Vheekey/testing-readme/blob/master/Screenshot_2020-07-08%20Laravel(2).png)

Its a wrap! Well done guys!!!

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Bugs & Fixtures
If you have spotted any bugs, or would like to request additional features from the library, please file an issue via the Issue Tracker on the project's Github page: https://github.com/infinitypaul/laravel-multistep-forms/issues.


### Security

If you discover any security related issues, please email infinitypaul@live.com instead of using the issue tracker.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

