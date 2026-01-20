<x-layout bodyClass="g-sidenav-show  bg-gray-200">

<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="reports" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Reports" />

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-6 d-flex align-items-center">
                                    <h6 class="mb-0">Reports</h6>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="{{ route('reports') }}" class="btn btn-outline-primary btn-sm mb-0">View All</a>
                                </div>
                            </div>


                        </div>

                        {{-- Location Hierarchy --}}
                        <div class="card-body p-3 pb-0">
                            <ul class="list-group">
                                @forelse ($locations as $province => $cities)
                                    <li class="list-group-item border-0 ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex flex-column province-toggle" style="cursor: pointer;">
                                            <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ $province }}</h6>
                                            <span class="text-xs">Click to view cities/municipalities</span>
                                        </div>
                                        <ul class="list-group ms-4 mt-2 d-none">
                                            @foreach ($cities as $city => $barangays)
                                                <li class="list-group-item border-0 ps-0 mb-2 border-radius-lg">
                                                    <div class="d-flex flex-column city-toggle" style="cursor: pointer;">
                                                        <h6 class="mb-1 text-dark text-sm">{{ $city }}</h6>
                                                        <span class="text-xs">Click to view barangays</span>
                                                    </div>
                                                    <ul class="list-group ms-4 mt-2 d-none">
                                                        @foreach ($barangays as $brgy)
                                                            <li class="list-group-item text-sm">
                                                                {{ $brgy }}
                                                                @if ($loop->first)
                                                                    <a class="btn btn-link text-success text-gradient px-3 mb-0" href="{{ route('export.beneficiary.list', ['province' => $province, 'city' => $city, 'barangay' => $brgy]) }}">
                                                                        <i class="material-icons text-sm me-2">list</i>Generate List
                                                                    </a>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @empty
                                    <li class="list-group-item">No data available.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Well-being Section --}}
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Level of Well-Being</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                @foreach ($levelCounts as $level => $count)
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-3 text-sm">{{ $level }} Level</h6>
                                            <span class="mb-2 text-xs">
                                                Total No. of Beneficiaries
                                                <span class="text-dark font-weight-bold ms-sm-2">{{ $count }}</span>
                                            </span>
                                        </div>
                                        <div class="ms-auto text-end">
                                            <a class="btn btn-link text-info text-gradient px-3 mb-0" href="#">
                                                <i class="material-icons text-sm me-2">print</i>Generate Report
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <x-footers.auth />
        </div>
    </main>
    <x-plugins />
</x-layout>

{{-- JavaScript for toggle --}}
<script>
    document.querySelectorAll('.province-toggle').forEach(province => {
        province.addEventListener('click', function () {
            document.querySelectorAll('.province-toggle + ul').forEach(ul => ul.classList.add('d-none'));
            document.querySelectorAll('.city-toggle + ul').forEach(ul => ul.classList.add('d-none'));
            const cityList = this.nextElementSibling;
            if (cityList && cityList.tagName === 'UL') cityList.classList.remove('d-none');
        });
    });

    document.querySelectorAll('.city-toggle').forEach(city => {
        city.addEventListener('click', function (e) {
            e.stopPropagation();
            document.querySelectorAll('.city-toggle + ul').forEach(ul => ul.classList.add('d-none'));
            const brgyList = this.nextElementSibling;
            if (brgyList && brgyList.tagName === 'UL') brgyList.classList.remove('d-none');
        });
    });
</script>


</x-layout>
