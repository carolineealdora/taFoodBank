@extends('layouts.layouts_mainweb.mainweb_master')

@section('mainweb_content')
<div class="section section-header" id="optionPage">
    <div class="parallax filter filter-color-red">
        <div class="image"
            style="background-image: url('{{ asset('assets/mainweb/img/header-1.jpeg') }}')">
        </div>
        <div class="container">
            <div class="content">
                <div class="title-area">
                    <p>Ini adalah Website</p>
                    <h1 class="title-modern">FoodBank Kita</h1>
                    <h3>Penghubung Antara NGO dengan Donatur.</h3>
                    <h4>Sharing is Caring!</h4>
                    <div class="separator line-separator">♦</div>
                    <div class="button-get-started">
                        <a href="#sectionPages" class="btn btn-white btn-fill btn-lg ">
                            Lebih Lanjut
                        </a>
                    </div>
                </div>     
            </div>
        </div>
    </div>
</div>


<div id ="sectionPages" class="scrollspy-example section" data-bs-spy="scroll" data-bs-smooth-scroll="true" data-bs-target="#optionPage" tabindex="0">
    {{-- note : scrolling masih belum smooth --}}
    <div class="container">
        <div class="row">
            <div class="title-area">
                <h2>Choose</h2>
                <div class="separator separator-danger">✻</div>
                <p class="description">Silahkan Pilih Halaman Yang Sesuai</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" id="donatur">
                <div class="info-icon">
                    <div class="icon text-danger">
                        <i class="pe-7s-gift"></i>
                    </div>
                    <h3>Apakah Kamu Donatur?</h3>
                    <p class="description">Ingin tau apa yang dilakukan donatur?</p>
                    <div class="button-get-started mb-10">
                        <a href="#sectiondonatur" class="btn btn-danger btn-fill btn-lg">Penjelasan Soal Donatur</a>
                    </div>
                    <p class="text-muted" style="margin-top: 30px;">Ingin langsung menjadi donatur?</p>
                    <div class="button-get-started">
                        <a href="{{ URL::route('donatur.showLogin') }}" class="btn btn-danger btn-fill btn-md">Log in Donatur</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="penjelasan">
                <div class="info-icon">
                    <div class="icon text-danger">
                        <i class="pe-7s-info"></i>
                    </div>
                    <h3>Ingin Tahu Lebih Lanjut Soal FoodBank Kita?</h3>
                    <p class="description">Untuk mempelajari lebih lanjut mengenai web ini, silahkan klik tombol</p>
                    <div class="button-get-started mb-10">
                        <a href="#sectionpenjelasan" class="btn btn-danger btn-fill btn-lg">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="ngo">
                <div class="info-icon">
                    <div class="icon text-danger">
                        <i class="pe-7s-users"></i>
                    </div>
                    <h3>Apakah Anda Pihak NGO?</h3>
                    <p class="description">Ingin tau apa yang NGO dapat lakukan di web ini?</p>
                    <div class="button-get-started">
                        <a href="#sectionngo" class="btn btn-danger btn-fill btn-lg">Penjelasan Soal NGO</a>
                    </div>
                    <p class="text-muted" style="margin-top: 30px;">Ingin mendaftarkan NGO Anda?</p>
                    <div class="button-get-started">
                        <a href="{{ URL::route('ngo.showLogin') }}" class="btn btn-danger btn-fill btn-md">Log in NGO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="section section-our-team-freebie scrollspy-example" id ="sectionpenjelasan" data-bs-spy="scroll" data-bs-smooth-scroll="true" data-bs-target="#penjelasan" tabindex="0">
    <div class="parallax filter filter-color-black">
        <div class="image" style="background-image: url('{{ asset('assets/mainweb/img/header-2.jpeg') }}')">
        </div>
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="title-area">
                        <h2>Who We Are</h2>
                        <div class="separator separator-danger">✻</div>
                        <p class="description">FoodBank Kita merupakan sistem manajemen berbasis web yang menghubungkan donatur dengan NGO untuk memudahkan proses pendataan dan 
                            pelaporan hasil distribusi surplus makanan sebagai usaha mendukung jalannya program SGDs</p>
                    </div>
                </div>

                <div class="team">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-member" style="height : 20rem">
                                        <div class="content">
                                            {{-- <div class="avatar avatar-danger">
                                                <img alt="..." class="img-circle" src="{{ asset('assets\web\img\faces\face_1.jpg') }}">
                                            </div> --}}
                                            <div class="description">
                                                <h3 class="title">Step 1</h3>
                                                <p class="small-text">Pengumpulan Data</p>
                                                <p class="description">Donatur mengisi form data surplus makanan yang akan diberikan kepada NGO</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-member" style="height : 20rem">
                                        <div class="content">
                                            {{-- <div class="avatar avatar-danger">
                                                <img alt="..." class="img-circle" src="{{ asset('assets\web\img\faces\face_4.jpg') }}">
                                            </div> --}}
                                            <div class="description">
                                                <h3 class="title">Step 2</h3>
                                                <p class="small-text">Penerimaan Data & Pickup Surplus Makanan</p>
                                                <p class="description">NGO mengelola data yang diterima dari donatur untuk kemudian melakukan pickup surplus makanan dari donatur.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-member" style="height : 20rem">
                                        <div class="content">
                                            {{-- <div class="avatar avatar-danger">
                                                <img alt="..." class="img-circle" src="{{ asset('assets\mainweb\img\faces\face_3.jpg') }}">
                                            </div> --}}
                                            <div class="description">
                                                <h3 class="title">Step 3</h3>
                                                <p class="small-text">Pendistribusian Donasi</p>
                                                <p class="description">Donasi yang telah di pickup akan diatur oleh NGO untuk dibagikan kepada masyarakat pra-sejahtera. Donatur dapat menerima bukti hasil pendistribusian dalam web setelah NGO mengupload bukti tersebut.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="section section-our-clients-freebie scrollspy-example" id ="sectiondonatur" data-bs-spy="scroll" data-bs-smooth-scroll="true" data-bs-target="#donatur" tabindex="0">
    <div class="container">
        <div class="title-area">
            <h5 class="subtitle text-gray">halo, donatur!</h5>
            <h2>Donatur</h2>
            <div class="separator separator-danger">∎</div>
        </div>

        <ul class="nav nav-text" role="tablist">
            <li class="active">
                <a href="#testimonial1" role="tab" data-toggle="tab">
                    <div class="image-clients">
                        <img alt="..." class="img-circle" src="{{ asset('assets/mainweb/img/flag.png') }}">
                    </div>
                </a>
            </li>
            <li>
                <a href="#testimonial2" role="tab" data-toggle="tab">
                    <div class="image-clients">
                        <img alt="..." class="img-circle" src="{{ asset('assets/mainweb/img/food.jpg') }}">
                    </div>
                </a>
            </li>
            <li>
                <a href="#testimonial3" role="tab" data-toggle="tab">
                    <div class="image-clients">
                        <img alt="..." class="img-circle" src="{{ asset('assets/mainweb/img/sdgs.jpg') }}">
                    </div>
                </a>
            </li>
        </ul>


        <div class="tab-content">
            <div class="tab-pane active" id="testimonial1">
                <p class="description"> Donatur adalah anda, masyarakat Indonesia, yang berkenan berbagi kepada sesama masyarakat Indonesia terutama kepada golongan pra-sejahtera melalui NGO yang anda percayai.
                </p>
            </div>
            <div class="tab-pane" id="testimonial2">
                <p class="description"> Donasi pangan dan surplus pangan dapat diberikan dalam bentuk makanan jadi, bahan makanan, minuman, dan pangan lainnya^^
                </p>
            </div>
            <div class="tab-pane" id="testimonial3">
                <p class="description"> Sistem ini dibuat untuk Anda yang ingin mengambil peran dalam menjalankan program SDGs khususnya dalam menangani masalah food waste di Indonesia!
                </p>
            </div>
            <div class="button-get-started">
                <a href="{{ URL::route('donatur.showLogin') }}" class="btn btn-danger btn-fill btn-md">Log in Donatur Di sini</a>
            </div>
        </div>

    </div>
</div>


<div class="section section-small section-get-started scrollspy-example" id ="sectionngo" data-bs-spy="scroll" data-bs-smooth-scroll="true" data-bs-target="#ngo" tabindex="0">
    <div class="parallax filter">
        <div class="image"
            style="background-image: url('{{ asset('assets\web\img\office-1.jpeg') }}">
        </div>
        <div class="container">
            <div class="title-area">
                <h2 class="text-white">Ingin jadi mitra NGO FoodBank Kita?</h2>
                <div class="separator line-separator">♦</div>
                <p class="description"> Dengan menjadi mitra FoodBank Kita, pihak NGO dapat memudahkan operasional program food bank serta meningkatkan kepercayaan donatur serta masyarakat. 
                    Melalui sistem web FoodBank Kita, NGO dapat terhubung dengan donatur secara lebih mudah. Pengelolaan data donasi yang diterima serta pelaporan hasil distribusi donasi juga dapat dilakukan melalui sistem FoodBank Kita. </p>
            </div>
            <div class="button-get-started">
                <a href="{{ URL::route('ngo.showLogin') }}" class="btn btn-danger btn-fill btn-md">Log in NGO Di sini</a>
            </div>
        </div>
    </div>
</div>    
@endsection