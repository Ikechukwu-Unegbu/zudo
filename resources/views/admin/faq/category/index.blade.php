@extends('layouts.admin')

@section('head')

@section('content')
    <h3 class="text-center"> FAQ Category</h3>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                <div></div>
                <div>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#new-faq-category"><i class="fa fa-plus"></i> Add New Category</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td width="50%">{{ $category->name }}</td>
                                <td>
                                    <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#edit-faq-category-{{ $category->slug }}"><i class="fa fa-edit"></i> Edit</button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-faq-category-{{ $category->slug }}"><i class="fa fa-trash"></i> Delete</button>
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

    @include('admin.faq.category.include._faq_category_modal')
    <x-toastr />
@endsection
