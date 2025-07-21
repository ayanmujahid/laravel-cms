@extends('layouts.main')
@section('content')
    @include('layouts.sidebar')

    <section class="tab-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Apply For Leave</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#0">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#0">Forms</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Form Elements
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->

            <!-- ========== form-elements-wrapper start ========== -->
            <div class="form-elements-wrapper">
                <div class="row">
                    <form method="POST" action="{{ route('leaves.store') }}">
                        @csrf
                        <div class="col-lg-6">
                            <!-- input style start -->
                            <div class="card-style mb-30">
                                <h6 class="mb-25">Input Fields</h6>
                                <div class="input-style-1">
                                    <label>Date</label>
                                    <input type="date"  name="leave_date" />
                                </div>
                                <div class="input-style-1">
                                    <label>Reason</label>
                                    <textarea placeholder="Reason" name="reason" rows="5"></textarea>
                                </div>
                                <!-- end input -->

                                <!-- end input -->
                                   <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                        Submit
                                    </button>
                                </div>
                            </div>
                            </div>

                         
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('css')
    <style type="text/css">
        /*in page css here*/
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        (() => {
            /*in page js here*/
        })()
    </script>
@endsection