@extends('layouts.app') {{-- Or your layout file --}}

@section('content')
<div class="container mt-4">
    <h2>Edit GIS: {{ $beneficiary->firstName }} {{ $beneficiary->lastName }}</h2>

    <div class="card mb-4">
        <div class="card-header">Beneficiary Information</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $beneficiary->firstName }} {{ $beneficiary->middleName }} {{ $beneficiary->lastName }} {{ $beneficiary->extName }}</p>
            <p><strong>Pantawid ID:</strong> {{ $beneficiary->pantawidID }}</p>
            <p><strong>Date of Birth:</strong> {{ $beneficiary->date_of_birth }}</p>
            <p><strong>Address:</strong> {{ $beneficiary->address }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Family Composition (HHID: {{ $beneficiary->hhid }})</div>
        <div class="card-body">
            @if($familyMembers->isEmpty())
                <p class="text-danger">No family members found.</p>
            @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Line #</th>
                            <th>Full Name</th>
                            <th>Relationship</th>
                            <th>Sex</th>
                            <th>Age</th>
                            <th>DOB</th>
                            <th>Marital Status</th>
                            <th>Education</th>
                            <th>In School?</th>
                            <th>Occupation</th>
                            <th>Worker Class</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($familyMembers as $member)
                        <tr>
                            <td>{{ $member->line_number }}</td>
                            <td>{{ $member->grantee_fname }} {{ $member->grantee_mname }} {{ $member->grantee_lname }} {{ $member->grantee_ename }}</td>
                            <td>{{ $member->relationship_to_the_grantee }}</td>
                            <td>{{ $member->sex }}</td>
                            <td>{{ $member->age }}</td>
                            <td>{{ $member->date_of_birth }}</td>
                            <td>{{ $member->marital_status }}</td>
                            <td>{{ $member->hea }}</td>
                            <td>{{ $member->currently_attending_school }}</td>
                            <td>{{ $member->primary_occupation }}</td>
                            <td>{{ $member->class_of_worker }}</td>
                            <td>{{ $member->remarks }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
