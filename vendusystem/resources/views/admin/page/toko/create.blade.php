@extends('admin.layouts.frame')
@section('title', 'Create Toko')
@section('description', 'Please make sure to check all input')
@section('button')
    <a href="{{ url('/admin/toko') }}" class="btn btn-info btn-xs no-border">Back</a>
@endsection

@section('content')
    <div class="container-fluid container-fixed-lg">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-danger {{ (count($errors)) ? '' : 'hidden' }}">
                    <div class="panel-body panel-bordered ">
                        <div class="row">
                            <div class="col-xs-12">
                                {!! $errors->first('nama', '<label class="lb-di error">:message</label>') !!}
                                {!! $errors->first('status', '<label class="lb-di error">:message</label>') !!}
                                {!! $errors->first('alamat', '<label class="lb-di error">:message</label>') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body sm-p-t-15">
                        {!! Form::open(['url' => 'admin/toko', 'id' => 'formValidate', 'files' => true]) !!}

                        <div class="row">
                            <div class="col-xs-6">
                                <div aria-required="true" class="form-group form-group-default required {{ $errors->has('nama') ? 'has-error' : ''}}">
                                    {!! Form::label('nama', "nama") !!}
                                    {!! Form::text('nama', null, ['class' => 'form-control input-md', 'required' => 'required']) !!}
                                </div>

                                <div aria-required="true" class="form-group form-group-default form-group-default-select2  required {{ $errors->has('status') ? 'has-error' : ''}}">
                                    {!! Form::label('status', "status") !!}
                                    {!! Form::select('status', ["Tidak Aktif", "Aktif"], 1, ['class' => 'full-width', 'data-init-plugin' => 'select2']) !!}
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div aria-required="true" class="form-group form-group-default required {{ $errors->has('alamat') ? 'has-error' : ''}}">
                                    {!! Form::label('alamat', "alamat") !!}
                                    {!! Form::textarea('alamat', null, ['class' => 'form-control input-md',  'style' => 'min-height: 90px;max-height: 90px;']) !!}
                                </div>
                            </div>
                        </div>
                        <br/>

                        <div class="pull-left m-b-20">
                            <div class="checkbox check-success">
                                <input id="checkbox-agree" type="checkbox" required> <label for="checkbox-agree"><small>Saya sudah mengecek data sebelum menyimpan</small></label>
                            </div>
                        </div>

                        <br/>

                        <button class="btn btn-default btn-rounded btn-sm p-l-30 p-r-30 m-r-10" type="reset">CLEAR</button>
                        {!! Form::submit('SAVE', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-sm p-l-30 p-r-30']) !!}


                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function() {


    });
</script>
@endpush