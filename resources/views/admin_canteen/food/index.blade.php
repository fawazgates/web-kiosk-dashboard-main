@extends('layouts.template')
@section('content')

<div class="container-fluid">
    @foreach($foods as $food)
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ Storage::disk('local')->url('data/'. $food->image) }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary btn-sm">Detail</a>
                <a href="#" class="btn btn-warning btn-sm">Edit</a>
            </div>
        </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script>
</script>
@endpush