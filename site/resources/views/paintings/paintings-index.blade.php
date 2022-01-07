<section class="paintings-content">
    <div class="container">
        <div class="row">
            @foreach($paintings_data as $art)
                <div class="col-24 col-md-6">
                    <a href="{{ route('painting.index',['id' => $art->id]); }}" class="paintings-content__image-link">
                        <div class="paintings-content__image-box">
                            <img src="{{ asset('/dist/img/temp/' . $art->id . '.jpg') }}" alt="" class="img paintings-content__image">
                            <div class="paintings-content__image-box-info">
                                <p class="paintings-content__image-box-info-title">{{ $art->name }}</p>
                                <p class="paintings-content__image-box-info-author">{{ $art->first_name }} {{ $art->last_name}}</p>
                                <p class="paintings-content__image-box-info-technique">{{ $art->painting_technique }} </p>
                                <p class="paintings-content__image-box-info-size">{{ $art->height }}x{{ $art->width }} cm</p>
                                {{-- {{ $art->id }} {{ $art->category }} --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    </section>