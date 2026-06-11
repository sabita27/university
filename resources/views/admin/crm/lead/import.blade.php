@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }} {{ __('import') }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> {{ __('btn_back') }}</a>

                        <a href="{{ asset('dashboard/sample/leads.xlsx') }}" class="btn btn-info" download><i class="fas fa-download"></i> {{ __('download_sample') }}</a>

                        <hr/>

                        <form class="needs-validation" novalidate action="{{ route($route.'.import.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="import">{{ __('upload_excel') }} <span>*</span></label>
                                    <input type="file" class="form-control" name="import" id="import" accept=".xlsx, .xls, .csv" required>
                                    <div class="invalid-feedback">
                                      {{ __('field_required') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-success" style="margin-top: 30px;"><i class="fas fa-upload"></i> {{ __('btn_upload') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection
