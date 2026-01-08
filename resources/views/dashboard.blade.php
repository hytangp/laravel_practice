@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class='container'>
        <div class="my-3 text-center">
            <h1>Dashboard</h1>
            
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($categories as $category)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $loop->index }}" aria-expanded="false" aria-controls="flush-collapse{{ $loop->index }}">
                            {{ $category['name'] }}
                        </button>
                        </h2>
                        <div id="flush-collapse{{ $loop->index }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                @if(count($category['products']) > 0)
                                    <ol class="list-group list-group-numbered">
                                        @foreach ($category['products'] as $product)
                                            <li class="list-group-item">{{ $product['name'] }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    <p>No products available in this category.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOther" aria-expanded="false" aria-controls="flush-collapseOther">
                        Others
                    </button>
                    </h2>
                    <div id="flush-collapseOther" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            @if(count($other_products) > 0)
                                <ol class="list-group list-group-numbered">
                                    @foreach ($other_products as $other)
                                        <li class="list-group-item">{{ $other }}</li>
                                    @endforeach
                                </ol>
                            @else
                                <p>No products available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection