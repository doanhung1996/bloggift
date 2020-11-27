@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="sh-content-head sh-content-head__flex-off">
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="sh-section">
                        <div class="sh-section__head">
                            <div>
                                <a href="#" class="sh-section__name">{{ $page->title }}</a>
                            </div>
                            <a href="#" class="sh-section__link sh-btn-icon"><i class="icon-Link"></i></a>
                        </div>
                        <div class="sh-section__content">
                            <div style="padding-top: 15px">
                                {!! $page->body !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
