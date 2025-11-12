<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div class="d-flex align-items-center gap-2">
          <div class="dropdown">
              <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">7</button>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">10</a></li>
                  <li><a class="dropdown-item" href="#">25</a></li>
              </ul>
          </div>
          <input type="text" placeholder="Search User" class="form-control form-control-sm" style="width:220px">
      </div>
      <div class="d-flex align-items-center gap-2">
          <div class="dropdown">
              <button class="btn btn-outline-secondary btn-sm dropdown-toggle">Export</button>
          </div>
          <button class="btn btn-primary btn-sm">
              <i class="ti ti-plus me-1"></i> Add New User
          </button>
      </div>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Email</th>
          <th>Verified</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user['id'] }}</td>
          <td class="d-flex align-items-center gap-2">
            <div class="tw-w-9 tw-h-9 tw-rounded-full tw-bg-indigo-100 tw-flex tw-items-center tw-justify-center tw-font-bold tw-text-indigo-600">
              {{ strtoupper(substr($user['name'],0,2)) }}
            </div>
            <div>
              <div class="tw-font-medium">{{ $user['name'] }}</div>
              <small class="tw-text-gray-400">{{ $user['email'] }}</small>
            </div>
          </td>
          <td>{{ $user['email'] }}</td>
          <td>
            @if($user['verified'])
              <span class="badge bg-success"><i class="ti ti-check"></i></span>
            @else
              <span class="badge bg-secondary"><i class="ti ti-x"></i></span>
            @endif
          </td>
          <td class="text-center">
            <div class="d-inline-flex align-items-center gap-2">
              <button class="btn btn-sm btn-text-secondary"><i class="ti ti-edit"></i></button>
              <button class="btn btn-sm btn-text-danger"><i class="ti ti-trash"></i></button>
              <div class="dropdown d-inline-block">
                <button class="btn btn-sm btn-text-primary dropdown-toggle" data-bs-toggle="dropdown">
                  <i class="ti ti-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="#">Detail</a></li>
                  <li><a class="dropdown-item" href="#">Reset Password</a></li>
                </ul>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>