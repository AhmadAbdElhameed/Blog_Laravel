@extends('layouts/admin')

@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">

        <div class="">
            <span class="m-0 font-weight-bold text-primary">Contact Us</span>
        </div>

    </div>
    {{-- Filter Filds --}}

    @include('backend.contact_us.filter.filter')

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th class="text-center" style="">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($messages as $message)
                    <tr>
                        <td><a href="{{ route('admin.contact_us.show', $message->id) }}">{{ $message->name }}</a></td>
                        <td>{{ $message->title }}</td>
                        <td>{{ $message->status() }}</td>
                        <td>{{ $message->created_at->format('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.contact_us.show', $message->id) }}"
                                    class="btn btn-outline-dark btn-sm">Show</a>

                                <a href="javascript:void(0);" class="btn btn-outline-danger btn-sm ml-2"
                                    onclick="if(confirm('Are you sure to delete this message')){document.getElementById('delete-message-{{ $message->id }}').submit(); }else {return false}">
                                    Delete</a>
                            </div>
                        </td>
                    </tr>
                    <form action="{{ route('admin.contact_us.destroy', $message->id) }}" method="POST"
                        id="delete-message-{{ $message->id }}" style="display: hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No Massegs Found</td>
                    </tr>

                    @endforelse

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">
                            <div class="float-right">{{ $messages->appends(request()->input())->links() }}</div>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection