<div>
  <div class="row">
    <div class="col-lg-12">
      <div class="main-box no-header clearfix bg-dark bg-opacity-25 rounded shadow-lg p-2">
        <div class="row">
          <div class="col ml-2">
            <div class="float-start mb-4 ms-4 mt-2">
              <input wire:model.live="search" type="text" id="name_search" placeholder="Naam, email, 06 " class="form-control rounded">
            </div>
          </div>

          <div class="col mr-2 mt-2">
            <div class=" mb-4 me-4 float-end">

              <select wire:model.live="role" class="form-control form-control-lg selector_custom">
                <option selected value='all'>
                  Alle rollen
                </option>
                <option value="junior_member">
                  Jeugd lid
                </option>
                <option value="aspirant_member">
                  Aspirant lid
                </option>
                <option value="member">
                  Lid
                </option>
                <option value="management">
                  Bestuur
                </option>
                <option value="donor">
                  Donateur
                </option>
                <option value="not_paid">
                  Niet betaald
                </option>
                <option value="super admin">
                  Super Admin
                </option>
              </select>
            </div>
          </div>
        </div>
        <td>

        </td>
        <div class="main-box-body clearfix">
          <div class="table-responsive">
            <table class="table table-stripe user-list rounded" id="MembersTable">
              <thead class="text-white">
                <tr>
                  <th><span>Foto</span></th>
                  <th><span>Vol. naam</span></th>
                  <th><span>KNVvl</span></th>
                  <th class="text-center"><span>Rol</span></th>
                  <th><span>RDW</span></th>
                  <th><span>Telefoon</span></th>
                  <th><span>Email</span></th>
                  <th>Open, bewerk, verwijder</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td>
                        <img src="https://placehold.co/35x35" alt="" style="width: 35px" class="img-fluid ms-2">
                      </td>
                      <!-- Name -->
                      <td class="text-white">
                        {{ $user->name ?? 'Niet ingevuld' }}
                      </td>
                      <!-- KNVvl number -->
                      <td class="text-white">
                        {{ $user->knvvl ?? 'Niet ingevuld' }}
                      </td>
                      <!-- Club status -->
                      <td class="text-center">
                        @switch($user->getRoleNames()[0])
                          @case('junior_member')
                            <span class="badge badge-pill bg-success" style="font-size: 1rem;">Jeugd lid</span>
                            @break
                          @case('aspirant_member')
                            <span class="badge badge-pill bg-info" style="font-size: 1rem;">Aspirant lid</span>
                            @break
                          @case('member')
                            <span class="badge badge-pill bg-primary" style="font-size: 1rem;">Lid</span>
                            @break
                          @case('management')
                            <span class="badge badge-pill bg-warning" style="font-size: 1rem;">Bestuur</span>
                            @break
                          @case('donor')
                            <span class="badge badge-pill bg-secondary" style="font-size: 1rem;">Donateur</span>
                            @break
                          @case('not_paid')
                            <span class="badge badge-pill bg-danger" style="font-size: 1rem;">Nog niet betaald</span>
                            @break
                          @case('super admin')
                            <span class="badge badge-pill" style="font-size: 1rem; background-color: #9F0707;">Super Admin</span>
                            @break
                        @endswitch
                      </td>
                      <!-- RDW -->
                      <td class="text-white">
                        {{ $user->rdw_number ?? 'Niet ingevuld' }}
                      </td>
                      <!-- Phone -->
                      <td class="text-white">
                        {{ $user->mobile_phone ?? 'Niet ingevuld' }}
                      </td>

                      <!-- Email -->
                      <td class="text-white">
                        {{ $user->email ?? 'Niet ingevuld' }}
                      </td>
                      <!-- Open, edit, delete -->
                      <td style="width: 20%;" class="text-center">
                        <a href="{{ route('users.show', $user->id) }}" class="table-link text-warning">
                          <span class="fa-stack" style="font-size: 1rem;">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-search-plus fa-stack-1x fa-inverse" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%); border-radius: 4px;"></i>
                          </span>
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="table-link text-info">
                          <span class="fa-stack" style="font-size: 1rem;">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-pencil fa-stack-1x fa-inverse" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%); border-radius: 4px;"></i>
                          </span>
                        </a>
                        <a href="users-remove/{{ $user->id }}" class="table-link text-info"
                          onclick="return confirm('Weet je zeker dat je gebruiker {{ $user->name }} wilt verwijderen?');"
                          >
                          <span class="fa-stack" style="font-size: 1rem;">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-trash fa-stack-1x fa-inverse" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%); border-radius: 4px;"></i>
                          </span>
                        </a>
                      </td>
                    </tr>
                  @endforeach
              </tbody>
            </table
            {!! $users->links('pagination::bootstrap-5') !!}
          </div>
        </div>
      </div>
    </div>
  </div>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
      .table-link.danger {
      color: inherit;
      text-decoration: none;
    }

    .table-link.danger:hover {
      color: inherit;
    }

    .fa-trash-o {
      background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      border-radius: 4px;
    }


    .pagination .page-link {
      background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%);
      color: white;
      border: none;
      margin: 4px;
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.1) !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      border-radius: 5px !important;
      padding: 10px !important;
      color: white !important;
      font-size: 14px !important;
      -webkit-appearance: listbox !important;
    }

    .form-control::placeholder {
      color: white !important;
    }

    .form-control:focus {
        color: white !important;
    }

    .form-control option {
        color: #000000;
        padding: 8px 16px;
        border: 1px solid transparent;
        border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
        cursor: pointer;
    }

    .form-control option:hover {
        background-color: #d53131 !important;
        color: white !important;
    }

    .form-control:after {
      position: absolute !important;
      content: "" !important;
      top: 14px !important;
      right: 10px !important;
      width: 0 !important;
      height: 0 !important;
      border: 6px solid !important;
      border-color: #fff !important;
    }

    .form-control:focus::placeholder {
        color: transparent !important;
    }

    .form-check-input:checked {
        background-color: green;
        border-color: #2b5c93;
    }
  </style>
</div>

