<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-4 ">
                        <a class="btn btn-outline-success btn-sm mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#addBeneficiaryModal">
                            <i class="material-icons text-sm">person_add</i>&nbsp;&nbsp;Add New Beneficiary
                        </a>
                    </div>
                    <div class="col-4 text-end">
                        <a class="btn btn-outline-info btn-sm mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Run Prediction & Classification
                        </a>
                    </div>
                    <div class="col-4 text-end">
                        <!-- ✅ Include jQuery in your Blade file -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                        <!-- ✅ Sync Button -->
                        <button id="syncButton" class="btn btn-success">
                            <i class="material-icons">sync</i> Sync to Android App
                        </button>

                        <!-- ✅ JavaScript to handle button click -->
                        <script>
                            $('#syncButton').click(function(e) {
                                e.preventDefault();

                                $.ajax({
                                    url: '/sync-data', // ← no "api/" prefix
                                    method: 'GET',
                                    success: function(response) {
                                        alert(JSON.stringify(response, null, 2));
                                    },
                                    error: function(xhr, status, error) {
                                        alert('Error: ' + xhr.responseText);
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
            <!-- Add Beneficiary Modal -->
            <div class="modal fade" id="addBeneficiaryModal" tabindex="-1" aria-labelledby="addBeneficiaryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('beneficiaries.store') }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addBeneficiaryModalLabel">Add New Beneficiary</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row g-3">
                                <div class="col-md-6">
                                    <label for="hhid" class="form-label">Pantawid ID</label>
                                    <input type="number" name="hhid" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" name="firstName" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="middleName" class="form-label">Middle Name</label>
                                    <input type="text" name="middleName" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" name="lastName" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="extName" class="form-label">Extension Name</label>
                                    <input type="text" name="extName" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" name="age" class="form-control" required>
                                </div>
                                <div class="col-md-9">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save Beneficiary</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel">Please wait...</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Enter username">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger btn-sm mb-0" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-outline-info btn-sm mb-0">Continue</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Beneficiaries table</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">

                                    {{-- Search Bar --}}
                                    <div class="row mb-3 px-3">
                                        <div class="col-md-12">
                                            <form method="GET" action="{{ route('beneficiaries.index') }}">
                                                <div class="input-group">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="material-icons" style="font-size: 18px;">search</i>&nbsp;Search
                                                    </button>
                                                    <input type="text" name="search" class="form-control" placeholder="Search by name or Pantawid ID..." value="{{ request('search') }}">

                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- No Results --}}
                                    @if($beneficiaries->isEmpty())
                                    <p class="text-danger text-center py-4">No beneficiaries found.</p>
                                    @else

                                    {{-- Table --}}
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fullname</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pantawid ID/HHID</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Well-being Status</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date of Birth</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remarks</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($beneficiaries as $beneficiary)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('assets/img/team-2.jpg') }}"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="{{ $beneficiary->firstName }}"
                                                                loading="lazy">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $beneficiary->firstName }} {{ $beneficiary->middleName }} {{ $beneficiary->lastName }} {{ $beneficiary->extName }}
                                                            </h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $beneficiary->email ?? 'No email' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $beneficiary->hhid }}</p>
                                                </td>
                                                @php
                                                $lowbLevel = trim($beneficiary->lowb_y ?? 'N/A');
                                                $badgeClass = match ($lowbLevel) {
                                                'LEVEL 1' => 'bg-gradient-danger',
                                                'LEVEL 2' => 'bg-gradient-warning',
                                                'LEVEL 3' => 'bg-gradient-success',
                                                default => 'bg-gradient-secondary',
                                                };
                                                @endphp

                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm {{ $badgeClass }}">
                                                        {{ $lowbLevel }}
                                                    </span>
                                                </td>


                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ $beneficiary->date_of_birth ?? 'N/A' }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">Done</span> {{-- Replace with dynamic remarks if needed --}}
                                                </td>
                                                <!-- Trigger (example inside a table row) -->
                                                <td class="align-middle">
                                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs view-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal"
                                                        data-id="{{ $beneficiary->hhid }}"
                                                        data-grantee="{{ $beneficiary->lastName }}, {{ $beneficiary->firstName }} {{ $beneficiary->middleName }} {{ $beneficiary->extName }}"
                                                        data-respondent="{{ $beneficiary->lastName }}, {{ $beneficiary->firstName }} {{ $beneficiary->middleName }} {{ $beneficiary->extName }}"
                                                        data-religion="{{ $beneficiary->religion ?? '' }}"
                                                        data-ip="{{ $beneficiary->ip_membership ?? '' }}"
                                                        data-address="{{ $beneficiary->region }}, {{ $beneficiary->province }}, {{ $beneficiary->city_muni }}, {{ $beneficiary->barangay }}, {{ $beneficiary->street }}">
                                                        <i class="material-icons text-sm">visibility</i>&nbsp;&nbsp;View
                                                    </a>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                    {{-- Pagination --}}
                                    <div class="mt-3 px-3">
                                        {{ $beneficiaries->withQueryString()->links('pagination::bootstrap-5') }}
                                    </div>

                                    @endif

                                </div>
                            </div>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">SWDI Family Information</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <!-- PAGE 1 -->
                                            <div id="swdi-form-page1">
                                                <h6 class="fw-bold text-primary">Part I. Family Identification</h6>
                                                <div class="row g-2 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Pantawid ID No.</label>
                                                        <input type="text" class="form-control" id="id_no" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Name of Grantee</label>
                                                        <input type="text" class="form-control" id="grantee_name" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Name of Respondent</label>
                                                        <input type="text" class="form-control" id="respondent_name" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Religion</label>
                                                        <input type="text" class="form-control" id="religion" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">IP Membership</label>
                                                        <input type="text" class="form-control" id="ip_membership" readonly>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="form-label">Present Address</label>
                                                        <textarea class="form-control" id="present_address" rows="2" readonly></textarea>
                                                    </div>
                                                </div>

                                                <h6 class="fw-bold text-primary">Part II. Family Composition</h6>
                                                <div class="table-responsive mb-3">
                                                    <table class="table table-bordered table-sm">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Line #</th>
                                                                <th>Name</th>
                                                                <th>Relationship</th>
                                                                <th>Sex</th>
                                                                <th>Age</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="family-member-tbody">
                                                            <tr>
                                                                <td colspan="5" class="text-center text-muted">Loading...</td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- PAGE 2 limit 1000 -->
                                            <div id="swdi-form-page2" class="d-none">
                                                <h6 class="fw-bold text-primary">Part III. Economic Sufficiency</h6>

                                                <!-- A. Employable Skills -->
                                                <label class="fw-bold">A. Employable Skills</label>
                                                <p class="text-muted small">Occupational skills of family members aged 18 years or over</p>
                                                <table class="table table-bordered table-sm" id="employable-skills-table">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>Indicator</th>
                                                            <th>Level</th>
                                                            <th>Code</th>
                                                        </tr>
                                                    </thead>

                                                    <!-- Employable skills table -->
                                                    <tbody id="employable-skills-tbody"></tbody>
                                                </table>

                                                <!-- B. Employment -->
                                                <label class="fw-bold mt-3">B. Employment</label>
                                                <p class="text-muted small">Working status of family members aged 18 years or over</p>
                                                <table class="table table-bordered table-sm" id="skillsTable">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>Indicator</th>
                                                            <th>PSOC <br>SMG</th>
                                                            <th>LEVEL</th>
                                                            <th>CODE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="employment-tbody">
                                                        <!-- Dynamic rows will be inserted here via JavaScript -->
                                                    </tbody>
                                                </table>


                                                <!-- C. Income -->
                                                <label class="fw-bold mt-3">C. Income</label>
                                                <p class="text-muted small">Family monthly per capita income in the past six months</p>
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Level</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="income-tbody">
                                                        <!-- Dynamic rows will be inserted here via JavaScript -->
                                                    </tbody>
                                                </table>

                                                <!-- D. Social Security -->
                                                <label class="fw-bold mt-3">D. Social Security</label>
                                                <p class="text-muted small">Membership or access of family to formal financial institutions</p>
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Level</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="socialSec-tbody">
                                                        <!-- Dynamic rows will be inserted here via JavaScript -->
                                                    </tbody>
                                                </table>

                                                <h6 class="fw-bold text-primary mt-4">Part IV. Social Adequacy</h6>

                                                <!-- A. Health -->
                                                <label class="fw-bold">A. Health</label>

                                                <!-- A.1 Health Condition and Availment -->
                                                <p class="text-muted small mb-1">1. Health Condition and Availment of Health Services</p>
                                                <ul class="mb-2">
                                                    <li>a. Availment of family members to accessible health services in the past six months</li>
                                                </ul>
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Level</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="accessibilityHealth-tbody">
                                                    </tbody>
                                                </table>

                                                <li>b. Health condition of family members in the past six months</li>
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Level</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="healthCondition-tbody">
                                                    </tbody>
                                                </table>

                                                <!-- A.2 Nutrition -->
                                                <p class="text-muted small mb-1">2. Nutrition</p>
                                                <ul class="mb-2">
                                                    <li>a. Number of meals the family had in a day</li>
                                                </ul>
                                                <table class="table table-bordered table-sm mb-3">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Level</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="numberMeals-tbody">
                                                    </tbody>
                                                </table>

                                                <p class="text-muted small mb-1">b. Nutritional status of children aged 5 years or below</p>
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Weight</th>
                                                            <th>Age</th>
                                                            <th>Code</th>
                                                            <th>Level</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="nutritionalStatusChildren-tbody">
                                                    </tbody>
                                                </table>
                                            </div>


                                            <!-- PAGE 3 -->
                                            <div id="swdi-form-page3" class="d-none">
                                                <h6 class="fw-bold text-primary">Part IV. Social Adequacy</h6>

                                                <!-- A. Water and Sanitation -->
                                                <label class="fw-bold">A. Water and Sanitation</label>
                                                <table class="table table-bordered table-sm">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Indicator</th>
                                                            <th>Level</th>
                                                            <th>Code</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="envHealth-tbody">
                                                        <tr>
                                                            <td colspan="3">Loading...</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <!-- B. Housing -->
                                                <label class="fw-bold">B. Housing</label>
                                                <table class="table table-bordered table-sm">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Indicator</th>
                                                            <th>Level</th>
                                                            <th>Code</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="housing-tbody">
                                                        <tr>
                                                            <td colspan="3">Loading...</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <!-- C. Education -->
                                                <label class="fw-bold">C. Education</label>
                                                <p class="fw-bold mb-1">1. Functional literacy of family members aged 10 years or over</p>
                                                <table class="table table-bordered table-sm">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Level</th>
                                                            <th>Code</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="functionalLiteracy-tbody">
                                                        <tr>
                                                            <td colspan="3" class="text-center">Loading...</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <p class="fw-bold mb-1">2. School enrolment/attendance of children aged 3–18 years in formal/informal school</p>
                                                <table class="table table-bordered table-sm">
  <thead class="table-light">
    <tr>
      <th>Name</th>
      <th>School</th>
      <th>HHID</th>
      <th>Lowb</th>
      <th>Code</th>
      <th>Level</th>
      <th>SWDI Entry ID</th>
      <th>Age</th>
      <th>Created At</th>
    </tr>
  </thead>
  <tbody id="seaTableBody">
    <!-- Dynamic rows will load here -->
  </tbody>
</table>

                                                <!-- D. Role Performance of Family -->
                                                <label class="fw-bold">D. Role Performance of Family</label>
                                                <table class="table table-bordered table-sm align-middle">
                                                    <thead class="table-light text-center">
                                                        <tr>
                                                        <th>Indicator</th>
                                                        <th>Level</th>
                                                        <th>Code</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="familyFunctioningTableBody">
                                                        <tr><td colspan="3" class="text-center text-muted">Loading...</td></tr>
                                                    </tbody>
                                                    </table>


                                                <!-- E. Family Awareness of Relevant Social Issues -->
                                                <label class="fw-bold">E. Family Awareness of Relevant Social Issues</label>
                                                <table class="table table-bordered table-sm">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Indicator</th>
                                                            <th>Level</th>
                                                            <th>Code</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="Family-Awareness-tbody">
                                                    </tbody>
                                                </table>
                                            </div>


                                            <!-- PAGE 4 -->
                                            <div id="swdi-form-page4" class="d-none">
                                                <h6 class="fw-bold text-primary">Part V. Income</h6>

                                                <!-- C1. Salaries and Wages from Employment -->
                                                <label class="fw-bold">C1. Salaries and Wages from Employment (in the past six months)</label>
                                                <table class="table table-sm table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th width="15%" rowspan="2" class="align-middle">Family Member</th>
            <th width="15%" rowspan="2" class="align-middle">Pop’n. <br>group<br><small>(Code:0-<br>Aged less<br> than 18 yrs.<br>old not in<br>school, 1-in<br>school,2-<br>Senior citizine,<br>3-PWDS,4-<br>Others)</small></th>
            <th width="70%" colspan="5" class="text-center bg-light">Salaries and Wages from Employment (Php)</th>
          </tr>
          <tr>
            <th>Basic <br> Compensation <br>( in cash)</th>
            <th>Cash <br>Commission,<br>Tips, Bonus</th>
            <th>Cash Allowance<br>(Food, Health, Hous-<br>ing & Clothing)</th>
            <th>Basic <br>Compensation<br>(In Kind)</th>
            <th>Sub-Total<br><small>(Col3+Col4<br>+Col5+Col6<br>for Col2+0)</small></th>
          </tr>
        </thead>
        <tbody id="swfe-tbody">
          <tr>
            <td colspan="7" class="text-muted text-center">Loading...</td>
          </tr>
        </tbody>
        <tfoot class="table-light">
          <tr>
            <th colspan="6" class="text-end">Total</th>
            <th><input type="number" id="swfe-total" class="form-control form-control-sm text-end" readonly></th>
          </tr>
        </tfoot>
      </table>


                                                <!-- C2. Income from Entrepreneurial/Sustenance Activities -->
                                                <label class="fw-bold">C2. Income from Entrepreneurial/Sustenance Activities (in the past six months)</label>
                                                <table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Type of Entrepreneurial/Sustenance Activity</th>
            <th>Code</th>
            <th>Gross Value/Sales (Php)</th>
            <th>Deductible Expenses (Php)</th>
            <th>Net Income (Php)</th>
        </tr>
    </thead>
    <tbody id="ifesa-tbody">
        <tr><td colspan="5" class="text-center text-muted">No data</td></tr>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" class="text-end">Sub-Total</th>
            <td><input type="number" id="ifesa-total" class="form-control" readonly></td>
        </tr>
    </tfoot>
</table>



                                                <!-- C3. Transfers -->
                                                <label class="fw-bold">C3. Transfers (in the past six months)</label>
                                                <table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Sources of Income</th>
            <th>In Cash</th>
            <th>In Kind</th>
            <th>Sub-Total</th>
        </tr>
    </thead>
    <tbody id="soi-tbody">
        <tr>
            <td colspan="4" class="text-center text-muted">Loading...</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="text-end">Sub-Total</th>
            <td><input type="number" id="soi-total" class="form-control text-end" readonly></td>
        </tr>
    </tfoot>
</table>


                                                <!-- C4. Other Sources -->
                                                <label class="fw-bold">C4. Other Sources (in the past six months)</label>
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Sources of Income</th>
                                                            <th>In Cash (₱)</th>
                                                            <th>In Kind (₱)</th>
                                                            <th>Sub-Total (₱)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="osin-tbody">
                                                        <tr><td colspan="4" class="text-center text-muted">Loading...</td></tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="3" class="text-end">Total Income (₱)</th>
                                                            <td><input type="number" id="osin-total" class="form-control text-end" readonly></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <table class="table table-bordered table-sm text-center align-middle">
    <thead class="table-light">
        <tr>
            <th colspan="4">Sub-Total of Income (Php) from</th>
            <th rowspan="2">Total Income (Php)<br><small>(Col.19)+(Col.20)<br>+(Col.21)+(Col.22)</small></th>
            <th rowspan="2">Family Size<br><small>(Col.24)</small></th>
            <th rowspan="2">Per Capita<br> Income (Php)<br><small>(Col.23)/(Col.24)</small></th>
            <th rowspan="2">Monthly Per <br>Capita Income (Php)<br><small>(Col.25/6)</small></th>
        </tr>
        <tr>
            <th>C1<br><small>(Col.7)</small></th>
            <th>C2<br><small>(Col.12)</small></th>
            <th>C3<br><small>(Col.15)</small></th>
            <th>C4<br><small>(Col.18)</small></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="number" class="form-control text-end" id="col19" name="col19"></td>
            <td><input type="number" class="form-control text-end" id="col20" name="col20"></td>
            <td><input type="number" class="form-control text-end" id="col21" name="col21"></td>
            <td><input type="number" class="form-control text-end" id="col22" name="col22"></td>
            <td><input type="number" class="form-control text-end" id="col23" name="col23" readonly></td>
            <td><input type="number" class="form-control text-end" id="col24" name="col24"></td>
            <td><input type="number" class="form-control text-end" id="col25" name="col25" readonly></td>
            <td><input type="number" class="form-control text-end" id="col26" name="col26" readonly></td>
        </tr>
    </tbody>
</table>

                                        </div>

                                        <!-- MODAL FOOTER -->
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a href="#" id="proceedSwdiBtn" class="btn btn-success d-none">Proceed to SWDI Form</a>
                                            <button id="backBtn" class="btn btn-outline-secondary d-none">Back</button>
                                            <button id="nextBtn" class="btn btn-primary">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
document.addEventListener('DOMContentLoaded', function () {

    /* -----------------------------
       PAGE NAVIGATION
    ----------------------------- */
    const pages = [
        document.getElementById('swdi-form-page1'),
        document.getElementById('swdi-form-page2'),
        document.getElementById('swdi-form-page3'),
        document.getElementById('swdi-form-page4')
    ];

    let currentPage = 0;
    const nextBtn = document.getElementById('nextBtn');
    const backBtn = document.getElementById('backBtn');
    const proceedBtn = document.getElementById('proceedSwdiBtn');

    function showPage(index) {
        pages.forEach((page, i) => page.classList.toggle('d-none', i !== index));
        backBtn.classList.toggle('d-none', index === 0);
        nextBtn.classList.toggle('d-none', index === pages.length - 1);
        proceedBtn.classList.toggle('d-none', index !== pages.length - 1);
    }

    nextBtn.addEventListener('click', () => {
        if (currentPage < pages.length - 1) {
            currentPage++;
            showPage(currentPage);
        }
    });

    backBtn.addEventListener('click', () => {
        if (currentPage > 0) {
            currentPage--;
            showPage(currentPage);
        }
    });

    showPage(currentPage);


    /* -----------------------------
       MODAL DATA LOADING
    ----------------------------- */
    const viewButtons = document.querySelectorAll('.view-btn');

    viewButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const hhid = this.dataset.id || '';

            // --- PART I: Household Info ---
            document.getElementById('id_no').value = hhid;
            document.getElementById('grantee_name').value = this.dataset.grantee || '';
            document.getElementById('respondent_name').value = this.dataset.respondent || '';
            document.getElementById('religion').value = this.dataset.religion || '';
            document.getElementById('ip_membership').value = this.dataset.ip || '';
            document.getElementById('present_address').value = this.dataset.address || '';

            // Proceed Button
            proceedBtn.href = `/swdi/form/${hhid}`;


            /* -----------------------------
               FAMILY MEMBERS
            ----------------------------- */
            const familyTbody = document.getElementById('family-member-tbody');
            familyTbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">Loading...</td></tr>`;

            fetch(`/beneficiaries/${hhid}/family-members`)
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        familyTbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">No family members found.</td></tr>`;
                        return;
                    }

                    familyTbody.innerHTML = data.map(member => {
                        const fullName = [
                            member.sfc_grantee_fname,
                            member.sfc_grantee_mname,
                            member.sfc_grantee_lname,
                            member.sfc_grantee_ename
                        ].filter(Boolean).join(' ');
                        return `
                            <tr>
                                <td>${member.sfc_line_number ?? ''}</td>
                                <td>${fullName}</td>
                                <td>${member.sfc_relationship_to_the_grantee ?? ''}</td>
                                <td>${member.sfc_sex ?? ''}</td>
                                <td>${member.sfc_age ?? ''}</td>
                            </tr>`;
                    }).join('');
                })
                .catch(() => {
                    familyTbody.innerHTML = `<tr><td colspan="5" class="text-center text-danger">Error loading data.</td></tr>`;
                });


            /* -----------------------------
               EMPLOYABLE SKILLS
            ----------------------------- */
            const skillsTbody = document.getElementById('employable-skills-tbody');
            skillsTbody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Loading...</td></tr>`;

            fetch(`/beneficiaries/${hhid}/employable-skills`)
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        skillsTbody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">No employable skills found.</td></tr>`;
                        return;
                    }

                    skillsTbody.innerHTML = data.map(skill => `
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" value="${skill.swdi_entry_id || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${skill.level || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${skill.code || ''}" readonly></td>
                        </tr>`).join('');
                })
                .catch(() => {
                    skillsTbody.innerHTML = `<tr><td colspan="3" class="text-center text-danger">Error loading data.</td></tr>`;
                });


            /* -----------------------------
               EMPLOYMENT
            ----------------------------- */
            const employmentTbody = document.getElementById('employment-tbody');
            employmentTbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted">Loading...</td></tr>`;

            fetch(`/beneficiaries/${hhid}/employment`)
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        employmentTbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted">No employment records found.</td></tr>`;
                        return;
                    }

                    employmentTbody.innerHTML = data.map(emp => `
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" value="${emp.swdi_entry_id || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${emp.occupation || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${emp.level || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${emp.code || ''}" readonly></td>
                        </tr>`).join('');
                })
                .catch(() => {
                    employmentTbody.innerHTML = `<tr><td colspan="4" class="text-center text-danger">Error loading data.</td></tr>`;
                });


            /* -----------------------------
               INCOME
            ----------------------------- */
            const incomeTbody = document.getElementById('income-tbody');
            incomeTbody.innerHTML = `<tr><td colspan="2" class="text-center text-muted">Loading...</td></tr>`;

            fetch(`/beneficiaries/${hhid}/income`)
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        incomeTbody.innerHTML = `<tr><td colspan="2" class="text-center text-muted">No income records found.</td></tr>`;
                        return;
                    }

                    incomeTbody.innerHTML = data.map(income => `
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" value="${income.level || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${income.code || ''}" readonly></td>
                        </tr>`).join('');
                })
                .catch(() => {
                    incomeTbody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Error loading data.</td></tr>`;
                });


            /* -----------------------------
               SOCIAL SECURITY
            ----------------------------- */
            const socialSecBody = document.getElementById('socialSec-tbody');
            socialSecBody.innerHTML = `<tr><td colspan="2">Loading...</td></tr>`;

            fetch(`/beneficiaries/${hhid}/social_security`)
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        socialSecBody.innerHTML = `<tr><td colspan="2">No Social Security records found.</td></tr>`;
                        return;
                    }

                    socialSecBody.innerHTML = data.map(item => `
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" value="${item.level || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${item.code || ''}" readonly></td>
                        </tr>`).join('');
                })
                .catch(() => {
                    socialSecBody.innerHTML = `<tr><td colspan="2">Error loading data.</td></tr>`;
                });


            /* -----------------------------
               ACCESSIBLE HEALTH CENTER
            ----------------------------- */
            const accessibilityHealthBody = document.getElementById('accessibilityHealth-tbody');
            accessibilityHealthBody.innerHTML = `<tr><td colspan="2">Loading...</td></tr>`;

            fetch(`/beneficiaries/${hhid}/availment_of_family_members_of_accessible_health_centers`)
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        accessibilityHealthBody.innerHTML = `<tr><td colspan="2">No records found.</td></tr>`;
                        return;
                    }

                    accessibilityHealthBody.innerHTML = data.map(item => `
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" value="${item.level || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${item.code || ''}" readonly></td>
                        </tr>`).join('');
                })
                .catch(() => {
                    accessibilityHealthBody.innerHTML = `<tr><td colspan="2">Error loading data.</td></tr>`;
                });


            /* -----------------------------
               HEALTH CONDITION
            ----------------------------- */
            const healthConditionBody = document.getElementById('healthCondition-tbody');
            healthConditionBody.innerHTML = `<tr><td colspan="2">Loading...</td></tr>`;

            fetch(`/beneficiaries/${hhid}/health_condition_of_family_members`)
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        healthConditionBody.innerHTML = `<tr><td colspan="2">No records found.</td></tr>`;
                        return;
                    }

                    healthConditionBody.innerHTML = data.map(item => `
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" value="${item.level || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${item.code || ''}" readonly></td>
                        </tr>`).join('');
                })
                .catch(() => {
                    healthConditionBody.innerHTML = `<tr><td colspan="2">Error loading data.</td></tr>`;
                });


            /* -----------------------------
               NUMBER OF MEALS
            ----------------------------- */
            const numberMeals = document.getElementById('numberMeals-tbody');
            numberMeals.innerHTML = `<tr><td colspan="2">Loading...</td></tr>`;

            fetch(`/beneficiaries/${hhid}/number_of_meals`)
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        numberMeals.innerHTML = `<tr><td colspan="2">No records found.</td></tr>`;
                        return;
                    }

                    numberMeals.innerHTML = data.map(item => `
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" value="${item.level || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${item.code || ''}" readonly></td>
                        </tr>`).join('');
                })
                .catch(() => {
                    numberMeals.innerHTML = `<tr><td colspan="2">Error loading data.</td></tr>`;
                });


            /* -----------------------------
               NUTRITIONAL STATUS (Children ≤ 5)
            ----------------------------- */
            const nutritionalStatusChildren = document.getElementById('nutritionalStatusChildren-tbody');
            nutritionalStatusChildren.innerHTML = `<tr><td colspan="5">Loading...</td></tr>`;

            fetch(`/beneficiaries/${hhid}/nutritional_status_of_children_five_year_and_below`)
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        nutritionalStatusChildren.innerHTML = `<tr><td colspan="5">No records found.</td></tr>`;
                        return;
                    }

                    nutritionalStatusChildren.innerHTML = data.map(item => `
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" value="${item.swdi_entry_id || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${item.weight || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${item.age_month || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${item.level || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${item.code || ''}" readonly></td>
                        </tr>`).join('');
                })
                .catch(() => {
                    nutritionalStatusChildren.innerHTML = `<tr><td colspan="5">Error loading data.</td></tr>`;
                });


            /* -----------------------------
               ENVIRONMENTAL HEALTH
            ----------------------------- */
            const envHealthBody = document.getElementById('envHealth-tbody');
            envHealthBody.innerHTML = `<tr><td colspan="3">Loading...</td></tr>`;

            Promise.all([
                fetch(`/beneficiaries/${hhid}/family_access_to_safe_drinking_water`).then(res => res.json()),
                fetch(`/beneficiaries/${hhid}/family_access_to_sanitary_toilet`).then(res => res.json()),
                fetch(`/beneficiaries/${hhid}/family_garbage_disposal_practice`).then(res => res.json())
            ])
            .then(([safeWater, sanitaryToilet, garbageDisposal]) => {
                envHealthBody.innerHTML = '';

                const rows = [
                    { indicator: "3.a. Family’s access to safe drinking water", data: safeWater[0] || {} },
                    { indicator: "3.b. Family’s access to sanitary toilet facilities", data: sanitaryToilet[0] || {} },
                    { indicator: "3.c. Most common family practice of garbage disposal", data: garbageDisposal[0] || {} }
                ];

                if (rows.every(r => Object.keys(r.data).length === 0)) {
                    envHealthBody.innerHTML = `<tr><td colspan="3">No records found.</td></tr>`;
                    return;
                }

                rows.forEach(row => {
                    envHealthBody.innerHTML += `
                        <tr>
                            <td>${row.indicator}</td>
                            <td><input type="text" class="form-control form-control-sm" value="${row.data.level || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${row.data.code || ''}" readonly></td>
                        </tr>`;
                });
            })
            .catch(() => {
                envHealthBody.innerHTML = `<tr><td colspan="3" class="text-danger">Error loading data.</td></tr>`;
            });


            /* -----------------------------
               HOUSING
            ----------------------------- */
            const housingBody = document.getElementById('housing-tbody');
            housingBody.innerHTML = '';

            function appendRow(indicator, level = '', code = '') {
                housingBody.innerHTML += `
                    <tr>
                        <td>${indicator}</td>
                        <td><input type="text" class="form-control form-control-sm" value="${level}" readonly></td>
                        <td><input type="text" class="form-control form-control-sm" value="${code}" readonly></td>
                    </tr>`;
            }

            fetch(`/beneficiaries/${hhid}/construction_materials_of_the_roof`)
                .then(res => res.json())
                .then(data => appendRow("1.a. Construction materials of the roof", data[0]?.level || '', data[0]?.code || ''))
                .catch(() => appendRow("1.a. Construction materials of the roof", "Error loading", ""));

            fetch(`/beneficiaries/${hhid}/construction_materials_of_the_outer_walls`)
                .then(res => res.json())
                .then(data => appendRow("1.b. Construction materials of the outer walls", data[0]?.level || '', data[0]?.code || ''))
                .catch(() => appendRow("1.b. Construction materials of the outer walls", "Error loading", ""));

            fetch(`/beneficiaries/${hhid}/tenure_status_of_housing_unit`)
                .then(res => res.json())
                .then(data => appendRow("2. Tenure status of housing unit", data[0]?.level || '', data[0]?.code || ''))
                .catch(() => appendRow("2. Tenure status of housing unit", "Error loading", ""));

            fetch(`/beneficiaries/${hhid}/lighting_facility_of_the_house`)
                .then(res => res.json())
                .then(data => appendRow("3. Lighting facility of the house", data[0]?.level || '', data[0]?.code || ''))
                .catch(() => appendRow("3. Lighting facility of the house", "Error loading", ""));


            /* -----------------------------
               FUNCTIONAL LITERACY
            ----------------------------- */
            const funcLitBody = document.getElementById('functionalLiteracy-tbody');
            funcLitBody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">Loading...</td></tr>`;

            fetch(`/beneficiaries/${hhid}/functional_literacy`)
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok');
                    return res.json();
                })
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        funcLitBody.innerHTML = `<tr><td colspan="3" class="text-center text-muted">No records found.</td></tr>`;
                        return;
                    }

                    funcLitBody.innerHTML = data.map(member => `
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" value="${member.full_name || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${member.level || ''}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm" value="${member.code || ''}" readonly></td>
                        </tr>`).join('');
                })
                .catch(err => {
                    console.error('Error fetching functional literacy data:', err);
                    funcLitBody.innerHTML = `<tr><td colspan="3" class="text-center text-danger">Error loading data.</td></tr>`;
                });
                // --- PART XII: SEA DATA ---
const seaTableBody = document.getElementById("seaTableBody");
seaTableBody.innerHTML = `<tr><td colspan="9" class="text-center text-muted">Loading...</td></tr>`;

fetch(`/beneficiaries/${hhid}/sea`)
  .then(res => res.json())
  .then(data => {
    if (!Array.isArray(data) || data.length === 0) {
      seaTableBody.innerHTML = `<tr><td colspan="9" class="text-center text-muted">No records found.</td></tr>`;
      return;
    }

    seaTableBody.innerHTML = data.map(row => `
      <tr>
        <td><input type="text" class="form-control form-control-sm" value="${row.full_name || ''}" readonly></td>
        <td><input type="text" class="form-control form-control-sm" value="${row.school || ''}" readonly></td>
        <td><input type="text" class="form-control form-control-sm" value="${row.sea_hhid || ''}" readonly></td>
        <td><input type="text" class="form-control form-control-sm" value="${row.sea_lowb || ''}" readonly></td>
        <td><input type="text" class="form-control form-control-sm" value="${row.sea_code || ''}" readonly></td>
        <td><input type="text" class="form-control form-control-sm" value="${row.sea_level || ''}" readonly></td>
        <td><input type="text" class="form-control form-control-sm" value="${row.sea_swdi_entry_id || ''}" readonly></td>
        <td><input type="text" class="form-control form-control-sm" value="${row.sea_age || ''}" readonly></td>
        <td><input type="text" class="form-control form-control-sm" value="${row.created_at || ''}" readonly></td>
      </tr>`).join('');
  })
  .catch(error => {
    console.error('Error loading SEA data:', error);
    seaTableBody.innerHTML = `<tr><td colspan="9" class="text-center text-danger">Error loading data.</td></tr>`;
  });


/* -----------------------------
   FAMILY FUNCTIONING  Family-Awareness-tbody
----------------------------- */
const familyFunctioningTableBody = document.getElementById('familyFunctioningTableBody');

if (familyFunctioningTableBody) {
  // Show loading message
  familyFunctioningTableBody.innerHTML = `
    <tr>
      <td colspan="3" class="text-center text-muted">Loading...</td>
    </tr>
  `;

  // Fetch family functioning data
  fetch(`/beneficiaries/${hhid}/family_functioning`)
    .then(res => res.ok ? res.json() : Promise.reject(res))
    .then(data => {
      if (!Array.isArray(data) || data.length === 0) {
        familyFunctioningTableBody.innerHTML = `
          <tr>
            <td colspan="3" class="text-center text-muted">No records found.</td>
          </tr>
        `;
        return;
      }

      familyFunctioningTableBody.innerHTML = data.map(row => `
        <tr>
          <td>${row.indicator}</td>
          <td><input type="text" class="form-control form-control-sm" value="${row.level || ''}" readonly></td>
          <td><input type="text" class="form-control form-control-sm" value="${row.code || ''}" readonly></td>
        </tr>
      `).join('');
    })
    .catch(() => {
      familyFunctioningTableBody.innerHTML = `
        <tr>
          <td colspan="3" class="text-center text-danger">Error loading data.</td>
        </tr>
      `;
    });
}


/* -----------------------------
   FAMILY AWARENESS
----------------------------- */
const familyAwarenessTableBody = document.getElementById('Family-Awareness-tbody');

if (familyAwarenessTableBody) {
        // Show loading message
        familyAwarenessTableBody.innerHTML = `
            <tr>
                <td colspan="3" class="text-center text-muted">Loading...</td>
            </tr>
        `;

        // Fetch family awareness data
        fetch(`/beneficiaries/${hhid}/family_awareness`)
            .then(res => res.ok ? res.json() : Promise.reject(res))
            .then(data => {
                if (!Array.isArray(data) || data.length === 0) {
                    familyAwarenessTableBody.innerHTML = `
                        <tr>
                            <td colspan="3" class="text-center text-muted">No records found.</td>
                        </tr>
                    `;
                    return;
                }

                familyAwarenessTableBody.innerHTML = data.map(row => `
                    <tr>
                        <td>${row.indicator}</td>
                        <td><input type="text" class="form-control form-control-sm" value="${row.level || ''}" readonly></td>
                        <td><input type="text" class="form-control form-control-sm" value="${row.code || ''}" readonly></td>
                    </tr>
                `).join('');
            })
            .catch(err => {
                console.error('Error loading Family Awareness data:', err);
                familyAwarenessTableBody.innerHTML = `
                    <tr>
                        <td colspan="3" class="text-center text-danger">Error loading data.</td>
                    </tr>
                `;
            });
    }
    const swfeBody = document.getElementById('swfe-tbody');
const swfeTotal = document.getElementById('swfe-total');
const col19 = document.getElementById('col19');

if (!hhid) return console.error('HHID not defined');

swfeBody.innerHTML = `<tr><td colspan="7" class="text-center text-muted">Loading...</td></tr>`;

fetch(`/beneficiaries/${hhid}/swfe`)
    .then(res => res.ok ? res.json() : Promise.reject(res))
    .then(data => {
        // If no data or empty
        if (!Array.isArray(data) || data.length === 0) {
            swfeBody.innerHTML = `<tr><td colspan="7" class="text-center text-muted">No records found.</td></tr>`;
            swfeTotal.value = '';
            return;
        }

        let total = 0;

        swfeBody.innerHTML = data.map(row => {
            total += Number(row.subtotal) || 0;

            return `
                <tr>
                    <td><input type="text" class="form-control" value="${row.name}" readonly></td>
                    <td><input type="number" class="form-control" value="${row.basic_cash}" readonly></td>
                    <td><input type="number" class="form-control" value="${row.commission}" readonly></td>
                    <td><input type="number" class="form-control" value="${row.allowance_cash}" readonly></td>
                    <td><input type="number" class="form-control" value="${row.basic_kind}" readonly></td>
                    <td><input type="number" class="form-control" value="${row.allowance_kind}" readonly></td>
                    <td><input type="number" class="form-control" value="${row.subtotal}" readonly></td>
                </tr>
            `;
        }).join('');

        col19.value=total.toFixed(2);
        swfeTotal.value = total.toFixed(2);
    })
    .catch(err => {
        console.error(err);
        swfeBody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Error loading data.</td></tr>`;
        swfeTotal.value = '';
        col19.value = '';
    });


    const ifesaBody = document.getElementById('ifesa-tbody');
    const ifesaTotal = document.getElementById('ifesa-total');
    const col20 = document.getElementById('col20');

    if (!hhid) return console.error('HHID not defined');

    ifesaBody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">Loading...</td></tr>`;

    fetch(`/beneficiaries/${hhid}/ifesa`)
        .then(res => res.ok ? res.json() : Promise.reject(res))
        .then(data => {
            if (!data || !data.activities || data.activities.length === 0) {
                ifesaBody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">No records found.</td></tr>`;
                ifesaTotal.value = 0;
                col20.value = 0;
                return;
            }

            let total = 0;

            ifesaBody.innerHTML = data.activities.map(row => {
                const net = Number(row.net) || 0;
                total += net;

                return `
                    <tr>
                        <td><input type="text" class="form-control" value="${row.activity || ''}" readonly></td>
                        <td><input type="text" class="form-control" value="${row.type || ''}" readonly></td>
                        <td><input type="number" class="form-control" value="${row.gross || 0}" readonly></td>
                        <td><input type="number" class="form-control" value="${row.deduct || 0}" readonly></td>
                        <td><input type="number" class="form-control" value="${net.toFixed(2)}" readonly></td>
                    </tr>
                `;
            }).join('');

            ifesaTotal.value = total.toFixed(2);
            col20.value = total.toFixed(2);
        })
        .catch(err => {
            console.error(err);
            ifesaBody.innerHTML = `<tr><td colspan="5" class="text-center text-danger">Error loading data.</td></tr>`;
        });

        const osinBody = document.getElementById('osin-tbody');
        const osinTotal = document.getElementById('osin-total');
        const col22 = document.getElementById('col22');

if (!hhid) return console.error('HHID not defined');

osinBody.innerHTML = `<tr><td colspan="4" class="text-center text-muted">Loading...</td></tr>`;

fetch(`/beneficiaries/${hhid}/osin`)
    .then(res => res.ok ? res.json() : Promise.reject(res))
    .then(data => {
        if (!data) {
            osinBody.innerHTML = `<tr><td colspan="4" class="text-center text-muted">No records found.</td></tr>`;
            osinTotal.value = 0;
            col22.value=0;
            return;
        }

        // Data mapping for each income source
        const sources = [
            {
                name: 'Pensions',
                cash: Number(data.osin_pension_cash || 0),
                kind: Number(data.osin_pension_in_kind || 0)
            },
            {
                name: 'Dividends',
                cash: Number(data.osin_dividends_cash || 0),
                kind: Number(data.osin_dividends_in_kind || 0)
            },
            {
                name: 'Imputed rental of owner-occupied dwelling unit',
                cash: Number(data.osin_imputed_rental_cash || 0),
                kind: Number(data.osin_imputed_rental_in_kind || 0)
            },
            {
                name: 'Interest',
                cash: Number(data.osin_interest_cash || 0),
                kind: Number(data.osin_interest_in_kind || 0)
            },
            {
                name: 'Other sources, not elsewhere classified',
                cash: Number(data.osin_other_source_cash || 0),
                kind: Number(data.osin_other_source_in_kind || 0)
            },
        ];

        let total = 0;

        osinBody.innerHTML = sources.map(src => {
            const subtotal = src.cash + src.kind;
            total += subtotal;
            return `
                <tr>
                    <td>${src.name}</td>
                    <td><input type="number" class="form-control text-end" value="${src.cash}" readonly></td>
                    <td><input type="number" class="form-control text-end" value="${src.kind}" readonly></td>
                    <td><input type="number" class="form-control text-end" value="${subtotal.toFixed(2)}" readonly></td>
                </tr>
            `;
        }).join('');

        osinTotal.value = total.toFixed(2);
        col22.value=total.toFixed(2);
    })
    .catch(err => {
        console.error(err);
        osinBody.innerHTML = `<tr><td colspan="4" class="text-center text-danger">Error loading data.</td></tr>`;
    });

    const soiBody = document.getElementById('soi-tbody');
const soiTotal = document.getElementById('soi-total');
const col21 = document.getElementById('col21');

if (!hhid) {
    console.error('HHID not defined');
}

soiBody.innerHTML = `
    <tr>
        <td colspan="4" class="text-center text-muted">Loading...</td>
    </tr>
`;

fetch(`/beneficiaries/${hhid}/soi`)
    .then(res => (res.ok ? res.json() : Promise.reject(res)))
    .then(data => {
        if (!data) {
            soiBody.innerHTML = `
                <tr><td colspan="4" class="text-center text-muted">No records found.</td></tr>
            `;
            soiTotal.value = 0;
            col21.value=0;
            return;
        }

        const sources = [
            {
                name: 'Receipts, support, and other forms of assistance from individuals',
                cash: Number(data.osi_reciept_in_cash || 0),
                kind: Number(data.osi_reciept_in_kind || 0),
                subtotal: Number(data.osi_reciept_subtotal || 0)
            },
            {
                name: 'Aid from NGOs or private institutions',
                cash: Number(data.osi_aid_in_cash || 0),
                kind: Number(data.osi_aid_in_kind || 0),
                subtotal: Number(data.osi_subtotal || 0)
            },
            {
                name: 'Support from Philippine government including 4Ps',
                cash: Number(data.osi_support_in_cash || 0),
                kind: Number(data.osi_support_in_kind || 0),
                subtotal: Number(data.osi_support_subtotal || 0)
            }
        ];

        let total = 0;

        soiBody.innerHTML = sources
            .map(src => {
                total += src.subtotal;
                return `
                    <tr>
                        <td>${src.name}</td>
                        <td><input type="number" class="form-control text-end" value="${src.cash.toFixed(2)}" readonly></td>
                        <td><input type="number" class="form-control text-end" value="${src.kind.toFixed(2)}" readonly></td>
                        <td><input type="number" class="form-control text-end" value="${src.subtotal.toFixed(2)}" readonly></td>
                    </tr>
                `;
            })
            .join('');

        soiTotal.value = total.toFixed(2);
        col21.value=total.toFixed(2);
    })
    .catch(err => {
        console.error(err);
        soiBody.innerHTML = `
            <tr><td colspan="4" class="text-center text-danger">Error loading data.</td></tr>
        `;
    });


        });
    });
});
</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
