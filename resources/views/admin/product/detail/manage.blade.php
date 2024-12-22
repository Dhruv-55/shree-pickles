@extends('admin.template.layout')
@section('title', 'Product Detail Management')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Product /</span> Detail Management
        </h4>

        <div class="row">
            <div class="col-md-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $product->name }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="detail">Detail</label>
                                        <textarea 
                                            name="detail" 
                                            class="form-control" 
                                            id="detail"
                                            rows="4"
                                        >{{ $productDetail ? $productDetail->detail : old('detail') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="information">Information</label>
                                        <textarea 
                                            name="information" 
                                            class="form-control" 
                                            id="information"
                                            rows="4"
                                        >{{ $productDetail ? $productDetail->information : old('information') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                {{ $productDetail ? 'Update' : 'Create' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ck-editor__editable {
        min-height: 400px !important;
        max-height: 800px !important;
    }
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    const editorConfig = {
        height: '500px',
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo']
    };

    ClassicEditor
        .create(document.querySelector('#detail'), editorConfig)
        .catch(error => {
            console.error(error);
        });
    
    ClassicEditor
        .create(document.querySelector('#information'), editorConfig)
        .catch(error => {
            console.error(error);
        });
</script>

@stop