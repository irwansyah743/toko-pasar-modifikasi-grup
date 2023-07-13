@extends('front.master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">

                @include('front.common.user_sidebar')

                <div class="col-md-2">

                </div> <!-- // end col md 2 -->


                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span
                                class="text-danger">Hi....</span><strong>{{ Auth::user()->name }}</strong> Selamat datang di 
                            Toko Modifikasi Grup</h3>

                    </div>



                </div> <!-- // end col md 6 -->

            </div> <!-- // end row -->

        </div>

    </div>

    {{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}
@endsection
