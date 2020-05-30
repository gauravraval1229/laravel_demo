<link rel="stylesheet" href="{{ asset('assets/front_end/css/bootstrap.min.css') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
.firstLetterCapital{
  text-transform: capitalize;
}
.error{
    color:red;
}
</style>
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {{ Form::open(array("url" => "registration-submit", "method" => "post", "enctype" => "multipart/form-data")) }}
                        @csrf

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
                                {{ Form::radio('gender', 'male', true) }} male
                                {{ Form::radio('gender', 'female') }} female

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
                                        echo " ".ucfirst(trim($designations->designation_name))." ";
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
                                {{ Form::select('country', array('' => 'Select Country', 'india' => 'India', 'usa' => 'USA'),null,['class' => 'form-control','id'=>'country']) }}

                                @error('country')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ Form::label('Select State') }}</label>

                            <div class="col-md-6">
                                {{ Form::select('country', array('' => 'Select State'),null,['class' => 'form-control','id'=>'state']) }}

                                @error('state')
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

<!-- practice purpose -->
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#country").on('change',function(){
    var country = $("#country").val();

    // Remove previous selected data
    $('#state').empty().append('<option value="">Select State</option>');

    $.ajax({
        type: "post",
        url: "/get-state",
        data: {"country":country},
        success:function(data){
            var dataArr = data.split(',');

            if(dataArr[0] == "success") {
                for (i = 1; i < dataArr.length; i++) {
                    var stateName = dataArr[i].charAt(0).toUpperCase() + dataArr[i].substring(1);
                    $("#state").append("<option value='"+dataArr[i]+"'>"+stateName+"</option>");
                }
            }
        }
    });
});
</script>
<!-- practice purpose -->

<script type="text/javascript" src="{{ asset('assets/front_end/js/bootstrap.min.js') }}"></script>