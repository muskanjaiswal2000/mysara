@extends('panel::layouts.app')

@section('title', __('panel/menu.state'))

@section('content')
<div class="card h-min-600">
  <div class="card-header">
    <h5 class="card-title mb-0">{{ __('panel/menu.state') }}</h5>
  </div>
  <div class="card-body">
    <form class="needs-validation mt-3" novalidate action="{{ $state->id ? panel_route('states.update', [$state->id]) : panel_route('states.store') }}" method="POST">
      @csrf
      @method($state->id ? 'PUT' : 'POST')

      <x-common-form-input title="Name" name="name" :value="old('name', $state->name ?? '')" required placeholder="Name" />
      <x-common-form-input title="Code" name="code" :value="old('code', $state->code ?? '')" required placeholder="Code" />
      <x-common-form-image title="Logo" name="image" :value="old('image', $state->image ?? '')" placeholder="image" />
      <x-common-form-input title="Position" name="position" :value="old('position', $state->slug ?? '')" required placeholder="Position" />
      <x-common-form-input title="Enabled" name="active" :value="old('active', $state->active ?? '')" placeholder="Enabled" />

      <div class="form-row mt-5 d-flex">
        <div class="wp-200 pe-2"></div>
        <button class="btn btn-primary" type="submit">Submit form</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('footer')
  <script>
  </script>
@endpush