<link rel="stylesheet" href="{{ asset('assets/front_end/css/bootstrap.min.css') }}" />
<style type="text/css">
.firstLetterCapital{
  text-transform: capitalize;
}
.error{
    color:red;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {{ Form::open(array("url" => "registration-submit", "method" => "post", "enctype" => "multipart/form-data")) }}
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ Form::label('name') }}</label>

                            <div class="col-md-6">
                                {{ Form::text('name',null, ['class' => 'form-control']) }}
                                @error('name')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ Form::label('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                {{ Form::email('email',null, ['class' => 'form-control']) }}
                                @error('email')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ Form::label('Password') }}</label>

                            <div class="col-md-6">
                                {{ Form::password('password',['class' => 'form-control']) }}

                                @error('password')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ Form::label('Confirm Password') }}</label>

                            <div class="col-md-6">
                                {{ Form::password('confirm_password',['class' => 'form-control']) }}

                                @error('confirm_password')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ Form::label('Gender') }}</label>

                            <div class="col-md-6 firstLetterCapital">
                                {{ Form::radio('gender', 'male', true) }}male
                                {{ Form::radio('gender', 'female') }}female

                                @error('gender')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row firstLetterCapital">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ Form::label('Designation') }}</label>


                            <div class="col-md-6">
                                <?php 
                                    $i=0;
                                    foreach ($designations as $designations) {

                                        $checked = false;
                                        if($i==0) { // default first checkbox is checked (Practice purpose)
                                            $checked = true;
                                        }

                                        echo Form::checkbox('designation[]', $designations->id, $checked);
                                        echo trim($designations->designation_name);
                                        $i++;
                                    }
                                ?>
                                @error('designation')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ Form::label('Select Country') }}</label>

                            <div class="col-md-6">
                                {{ Form::select('country', array('' => 'Select Country', 'india' => 'India', 'usa' => 'USA'),null,['class' => 'form-control']) }}

                                @error('country')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ Form::label('Profile Image') }}</label>

                            <div class="col-md-6">
                                {{ Form::file('profileImage',['class' => 'form-control']) }}

                                @error('profileImage')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-4">
                                {{Form::submit('Register',['class' => 'btn btn-primary btn-block btn-flat']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="{{ asset('assets/front_end/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/front_end/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/front_end/js/bootstrap.min.js') }}"></script>