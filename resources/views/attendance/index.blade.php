@extends('layouts.main')
@section('content')
    @include('layouts.sidebar')
    <section class="table-components">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="title">
                    <h2>Attendance</h2>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('attendance.mark') }}">
                @csrf
                <input type="hidden" name="date" value="{{ now()->toDateString() }}">
                <input type="hidden" name="time" value="{{ now()->toTimeString() }}">

                <div class="button-group d-flex justify-content-start mb-3">
                    <button type="submit" class="main-btn primary-btn btn-hover">
                        Mark Attendance ({{ now()->format('d M Y - h:i A') }})
                    </button>
                </div>
            </form>

            <div class="card-style mb-30">
                <h5 class="text-primary mb-3">Your Attendance Records</h5>
                <div class="table-wrapper table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendances as $attendance)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($attendance->time)->format('h:i A') }}</td>
                                    <td>
                                        @if ($attendance->status === 'Late')
                                            <span class="badge bg-danger">Late</span>
                                        @else
                                            <span class="badge bg-success">On Time</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No attendance marked yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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