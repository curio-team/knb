@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="columns">
            <div class="column is-three-quarters">
                <div class="box">
                    <h4 class="title is-4 center-content">The Sorting Printer</h4>
                    <img src="{{ asset('img/houses/printer_bottom.png') }}" id="printerBottomImage" class="canvas-image" alt="">
                    <img src="{{ asset('img/houses/printer_top.png') }}" id="printerTopImage" class="canvas-image" alt="">
                    <img src="{{ asset('img/houses/printer_paper.png') }}" id="printerPaperImage" class="canvas-image" alt="">
                    <img src="{{ asset('img/houses/emblems/house1.png') }}" id="emblemImage" class="canvas-image" alt="">

                    <div class="center-content">
                        <canvas id="printerCanvas" class="center" width="375px" height="550px">Sorry, your browser does not support HTML5 canvas</canvas>
                    </div>
                </div>
            </div>

            @include('partials._sidebar')
        </div>
    </div>

    <script src="{{ asset('js/house-selection.js') }}"></script>
@endsection
