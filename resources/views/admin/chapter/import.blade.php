@extends('admin.layouts.master')
<style>
    .materialInfoContainer {
        background: #454545;
        border-radius: 10px;
        padding: 10px;
    }

    .upload-container {
        width: 100%;
        /* max-width: 800px; */
        margin: 0px auto;
        border: 2px dashed #aaa;
        padding: 20px;
        text-align: center;
        position: relative;
    }

    .upload-container img {
        max-width: 100%;
        max-height: 300px;
        display: none;
        margin-top: 10px;
    }

    .upload-icon {
        font-size: 50px;
        color: orange;
    }

    .upload-text {
        margin-top: 10px;
    }

    .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        top: 0;
        left: 0;
    }

    .map {
        position: relative;
    }
</style>
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Chapters</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">Bulk Chapters</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Bulk Chapters</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('DataSample', 'chapters') }}" type="button" class="btn btn-primary">Sample</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase white">Add Bulk Chapters</h6>
                        <hr />
                        <div class="p-4 border rounded">
                            <form class="row g-3 needs-validation" action="{{ route('chapterImport') }}" method="POST"
                                enctype="multipart/form-data" id="customerForm">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-2">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success mt-2">
                                        <p>{{session('success')}}</p>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label white">Excel File*</label>
                                    <input type="file" class="form-control" name="file" required>
                                </div>

                                <div class="col-xl-12 mx-auto mb-4">
                                    <div class="d-flex align-items-center justify-content-end mt-2">
                                        <a href="{{ route('chapter.index') }}">
                                            <div class="CreateJobCancelBtn">Cancel</div>
                                        </a>
                                        <button type="submit" class="btn CreateJobFinishBtn ms-2">
                                            Import
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection