@extends('frontend.layouts.master')

@section('title')
    Home
@endsection

@section('content')
    <!--=============================
            BANNER START
        ==============================-->
    @include('frontend.components.slider')
    <!--=============================
            BANNER END
        ==============================-->


    <!--=============================
            WHY CHOOSE START
        ==============================-->
    @include('frontend.components.why-choose-us')
    <!--=============================
            WHY CHOOSE END
        ==============================-->


    <!--=============================
            OFFER ITEM START
        ==============================-->
    @include('frontend.components.offer-item')
    <!--=============================
            OFFER ITEM END
        ==============================-->


    <!--=============================
            MENU ITEM START
        ==============================-->
    @include('frontend.components.menu-item')
    <!--=============================
            MENU ITEM END
        ==============================-->


    <!--=============================
            ADD SLIDER START
        ==============================-->
    @include('frontend.components.add-slider')
    <!--=============================
            ADD SLIDER END
        ==============================-->


    <!--=============================
            TEAM START
        ==============================-->
    @include('frontend.components.team')
    <!--=============================
            TEAM END
        ==============================-->


    <!--=============================
            DOWNLOAD APP START
        ==============================-->
    @include('frontend.components.download-app')
    <!--=============================
            DOWNLOAD APP END
        ==============================-->


    <!--=============================
           TESTIMONIAL  START
        ==============================-->
    @include('frontend.components.testimonial')
    <!--=============================
            TESTIMONIAL END
        ==============================-->


    <!--=============================
            COUNTER START
        ==============================-->
    @include('frontend.components.counter')
    <!--=============================
            COUNTER END
        ==============================-->


    <!--=============================
            BLOG 2 START
        ==============================-->
    @include('frontend.components.blog')
    <!--=============================
            BLOG 2 END
        ==============================-->
@endsection
