@extends('layouts.admin')

@section('head')

@section('content')
    <style>
        .table-borderless tbody+tbody,.table-borderless td,.table-borderless th,.table-borderless thead th{border:0}
    </style>
    <h3 class="text-center text-capitalize"> frequently asked question (FAQ) </h3>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                <div></div>
                <div>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#new-faq"><i class="fa fa-plus"></i> Add New FAQ</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Questions</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($faqs as $faq)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td width="50%">{{ $faq->question }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#view-faq-{{ $faq->slug }}"><i class="fa fa-list"></i> View</button>
                                    <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#edit-faq-{{ $faq->slug }}"><i class="fa fa-edit"></i> Edit</button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-faq-{{ $faq->slug }}"><i class="fa fa-trash"></i> Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No Records Found!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.faq.include._faq_modal')
    <x-toastr />
@endsection
