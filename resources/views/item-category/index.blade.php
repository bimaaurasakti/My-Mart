@extends('layout')

@section('title', 'My Mart | Item Categories')

@section('content')
    <section class="item-list py-3">
        <div class="d-flex justify-content-end">
            <a href="{{ route('item-categories.create') }}" type="button" class="btn btn-outline-success" type="button" role="button">Create Category</a>
        </div>
        <div class="table-responsive mt-2">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Parent Category</th>
                        <th scope="col">Name</th>
                        <th scope="col">Create At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $category->parent->name ?? '-' }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ Carbon\Carbon::parse($category->created_at)->toDayDateTimeString() }}</td>
                            <td>
                                <div class="d-flex">
                                    <div>
                                        <a
                                            type="button"
                                            class="btn btn-warning btn-sm me-2"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                            role="button"
                                            href="{{ route('item-categories.show', $category) }}"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                    <form method="POST" action="{{ route('item-categories.destroy', $category) }}">
                                        @csrf
                                        @method('DELETE')

                                        @if ($category->isUsed)
                                            <button
                                                type="submit"
                                                class="btn btn-secondary btn-sm"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="Category in use"
                                            >
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        @else
                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                            >
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        @endif

                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
