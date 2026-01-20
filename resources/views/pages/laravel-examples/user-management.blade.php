<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">

                        <!-- Users Table -->
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PHOTO</th>
                                            <th>NAME</th>
                                            <th class="text-center">EMAIL</th>
                                            <th class="text-center">ROLE</th>
                                            <th class="text-center">AREA OF ASSIGNMENT</th>
                                            <th class="text-center">CREATION DATE</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
@foreach ($users as $index => $user)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>
        <img src="{{ asset('assets/img/team-2.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="{{ $user->name }}">
    </td>
    <td>{{ $user->name }}</td>
    <td class="text-center">{{ $user->email }}</td>
    <td class="text-center">{{ $user->role ?? 'Member' }}</td>
    <td class="text-center">{{ $user->city ? $user->city->name : 'Not Assigned' }}</td>
    <td class="text-center">{{ $user->created_at->format('d/m/y') }}</td>
    <td class="align-middle">
        <!-- Edit Button -->
        <a href="javascript:;"
           class="btn btn-success btn-link"
           data-bs-toggle="modal"
           data-bs-target="#editModal"
           data-id="{{ $user->id }}"
           data-name="{{ $user->name }}"
           data-email="{{ $user->email }}"
           data-role="{{ $user->role }}"
           data-area="{{ $user->area_assigned_id }}"
           onclick="openEditModal(this)">
            <i class="material-icons">edit</i>
        </a>

        <!-- Delete Form -->
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-link" onclick="return confirm('Are you sure?')">
                <i class="material-icons">close</i>
            </button>
        </form>
    </td>
</tr>
@endforeach
</tbody>

                                </table>
                            </div>
                        </div>

                        <!-- Edit User Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editUserForm" method="POST" action="{{ route('users.update') }}">
                                            @csrf
                                            <input type="hidden" id="editUserId" name="id">

                                            <!-- Name -->
                                            <div class="mb-3">
                                                <label for="editUserName" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="editUserName" name="name">
                                            </div>

                                            <!-- Email -->
                                            <div class="mb-3">
                                                <label for="editUserEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="editUserEmail" name="email">
                                            </div>

                                            <!-- Role -->
                                            <div class="mb-3">
                                                <label for="editUserRole" class="form-label">Role</label>
                                                <select class="form-select" id="editUserRole" name="role">
                                                    <option value="CL/ML">CL/ML</option>
                                                    <option value="RPMO">RPMO</option>
                                                    <option value="RPC">RPC</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="SWO III">SWO III</option>
                                                    <option value="RD">RD</option>
                                                </select>
                                            </div>

                                            <!-- Area Assigned -->
                                            <div class="mb-3">
                                                <label for="editAreaAssigned" class="form-label">Area Assigned</label>
                                                <select class="form-select" id="editAreaAssigned" name="area_assigned_id">
                                                    <option value="">Select Area</option>
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city->id }}">
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Save Button -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Script to populate edit modal -->
                        <script>
                            function openEditModal(button) {
                                document.getElementById('editUserId').value = button.dataset.id;
                                document.getElementById('editUserName').value = button.dataset.name;
                                document.getElementById('editUserEmail').value = button.dataset.email;
                                document.getElementById('editUserRole').value = button.dataset.role;
                                document.getElementById('editAreaAssigned').value = button.dataset.area;
                            }
                        </script>

                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
