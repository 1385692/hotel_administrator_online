@extends('admin.layout.app')

@section('heading', 'Edit FAQs')

@section('right_top_button')
    <a href="{{ route('admin_faq_view') }}" class="btn btn-primary"><i class="fa fa-eye"></i> View All</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_faq_update', $faq_data->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <label class="form-label">Question *</label>
                                    <input type="text" class="form-control" name="heading" value="{{ $faq_data->heading }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Answer *</label>
                                    <textarea name="text" class="form control snote" id="" cols="30" rows="10">{!! $faq_data->text !!}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection