@extends('adminlte::page')

@section('title', 'Gallery Add')

@section('content_header')
    <h1>Gallery Add</h1>
@stop

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                    
                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="selectImage">
                        
                            <!-- error message untuk title -->
                            @error('image')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group rounded mx-auto d-block img-fluid" >
                            <img id="preview" src="#" alt="your image" class="rounded" style="width: 150px"/>
                        </div>

                        
                        
                        <div class="form-group">
                            <label for="exampleSelectRounded0"> Product ID  </label>
                            <select class="custom-select rounded-0" id="project_id" name="project_id" >
                              <option hidden>Select Project</option>
                              @foreach ($products as $p)
                              <option  value="{{ $p->id }}">{{ $p->name }}-{{ $p->color }}</option>
                              @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label class="font-weight-bold">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Insert title">
                        
                            <!-- error message untuk title -->
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Insert description">{{ old('description') }}</textarea>
                        
                            <!-- error message untuk content -->
                            @error('description')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>

                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#project').on('change', function() {
            var selectedValue = $(this).val();
            $('.result_project').text(selectedValue).val(selectedValue);
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
</script>
<script>
    selectImage.onchange = evt => {
        preview = document.getElementById('preview');
        preview.style.display = 'block';
        const [file] = selectImage.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }
    }
</script>
@stop