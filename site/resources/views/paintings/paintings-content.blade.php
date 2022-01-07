<section class="paintings-content">
    <div class="container">
        <div class="row">
            @foreach($paintings_data as $art)
                <div class="col-24 col-md-6">
                    <a href="{{ route('painting.index',['id' => $art->id]); }}" class="paintings-content__image-link">
                        <div class="paintings-content__image-box">
                            {{ $art->id }} {{ $art->name }} {{ $art->painting_technique }} {{ $art->height }}{{ $art->width }}{{ $art->category }}{{ $art->first_name }}{{ $art->last_name}}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    </section>