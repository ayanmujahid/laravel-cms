@extends('layouts.main')
@section('content')
    @include('layouts.sidebar')

    <section class="table-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Leaves</h2>
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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Tables
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

            <!-- ========== tables-wrapper start ========== -->
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            {{-- <h6 class="mb-10">Data Table</h6>
                            <p class="text-sm mb-20">
                                For basic styling—light padding and only horizontal
                                dividers—use the class table.
                            </p> --}}
                            <div class="col-2 mb-20">

                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <a href="{{ route('leaves.create') }}"
                                        class="main-btn primary-btn btn-hover w-100 text-center">
                                        Apply For Leave
                                    </a>
                                </div>
                            </div>
                            <h5 class="text-primary mb-3">
                                Current Month Leave Balance:
                                @if ($leaveBalance >= 0)
                                    <span class="text-success">{{ $leaveBalance }} leave(s) remaining</span>
                                @else
                                    <span class="text-danger">{{ $leaveBalance }} leave(s) over limit</span>
                                @endif
                            </h5>
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="lead-info">
                                                <h6>Name</h6>
                                            </th>
                                            <th class="lead-email">
                                                <h6>Email</h6>
                                            </th>

                                            <th class="lead-company">
                                                <h6>Reason</h6>
                                            </th>
                                            <th>
                                                <h6>Leave Date</h6>
                                            </th>
                                            <th>
                                                <h6>Apply For Leave</h6>
                                            </th>
                                        </tr>
                                        <!-- end table row-->
                                    </thead>
                                    <tbody>
                                        @forelse ($currentLeaves as $index => $leave)
                                            <tr>
                                                <td class="min-width">
                                                    <div class="lead">
                                                        <div class="lead-image">
                                                            <img src="assets/images/lead/lead-1.png" alt="User" />
                                                        </div>
                                                        <div class="lead-text">
                                                            <p>{{ $leave->user->name ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="mailto:{{ $leave->user->email }}">{{ $leave->user->email }}</a>
                                                    </p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $leave->reason }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ \Carbon\Carbon::parse($leave->leave_date)->format('d M Y') }}</p>
                                                </td>
                                                <td>
                                                    @if ($index === 0)
                                                        <span class="badge bg-success">Paid</span>
                                                    @else
                                                        <span class="badge bg-danger">Unpaid</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No leaves applied this month.</td>
                                            </tr>
                                        @endforelse
                                        <!-- end table row -->
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
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