@extends('layout')

@section('title', "My Mart | " . ucfirst($action) . " Item")

@section('content')
    <section class="item-edit py-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $action == 'update' ? route('items.update', $item) : route('items.store') }}" method="POST">
                        @csrf

                        @if ($action == 'update')
                            @method('PATCH')
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                placeholder="Enter product name"
                                value="{{ $item->name ?? old('name') }}"
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select
                                class="form-select @error('category') is-invalid @enderror"
                                aria-label="Default select example"
                                id="category"
                                name="category"
                            >
                                @if ($action == 'create' || !old('category'))
                                    <option value="" selected disabled>Select an option...</option>
                                @endif
                                @foreach ($categories as $category)
                                    @if ($action == 'update')
                                        <option value="{{ $category->id }}" @if($category->id == $item->category->id) selected @endif>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}" @if($category->id == old('category')) selected @endif>{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input
                                type="number"
                                class="form-control @error('price') is-invalid @enderror"
                                id="price"
                                name="price"
                                placeholder="Enter product price"
                                value="{{ $item->price ?? old('price') }}"
                            >
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-2">
                                @if ($action == 'update')
                                    Update
                                @else
                                    Submit
                                @endif
                            </button>
                            <a
                                type="button"
                                class="btn btn-secondary"
                                role="button"
                                href="{{ route('items.index', $item) }}"
                            >
                                Cancel
                            </a>
                            @if ($action == 'update')
                                <button
                                    id="button_form_delete"
                                    class="btn btn-outline-danger ms-2"
                                >
                                    Delete
                                </button>
                            @endif
                        </div>
                    </form>
                    @if ($action == 'update')
                        <form id="form_delete" method="POST" action="{{ route('items.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom-js')
    <script src="{{ asset('js/item/form.js') }}"></script>
@endsection
