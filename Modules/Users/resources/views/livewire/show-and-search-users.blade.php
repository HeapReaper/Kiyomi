<div>
  <div class="row">
    <div class="col-lg-12">
      <div class="main-box no-header clearfix bg-dark bg-opacity-25 rounded shadow-lg p-2">
        <h2 class="text-white font-weight-bold">Leden</h2>

        <div class="row">
          <div class="col ml-2">
            <div class="float-start mb-4 ms-0 mt-2">
              <input wire:model.live="search" type="text" id="name_search" placeholder="Naam, email, 06, KNVvL, RDW nummer" class="form-control rounded">
            </div>
          </div>

          <div class="col mr-2 mt-2">
            <div class=" mb-4 me-0 float-end">

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
        <div class="main-box-body clearfix">
          <div class="table-responsive">
            <table class="table table-custom-dark user-list ml-2 mr-2" >
              <thead class="text-white">
                <tr>
                  <th class="text-white"><span>ID</span></th>
                  <th class="text-white"><span>Vol. naam</span></th>
                  <th class="text-white"><span>KNVvL</span></th>
                  <th class="text-center text-white"><span>Rol</span></th>
                  <th class="text-white"><span>RDW</span></th>
                  <th class="text-white"><span>Telefoon</span></th>
                  <th class="text-white"><span>Email</span></th>
                  <th class="text-white">Opties</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td class="text-white">
                        {{ $user->id }}
                      </td>
                      <!-- Name -->
                      <td class="text-white">
                        {{ $user->name ?? 'Leeg' }}
                      </td>
                      <!-- KNVvl number -->
                      <td class="text-white">
                        {{ $user->knvvl ?? 'Leeg' }}
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
                        {{ $user->rdw_number ?? 'Leeg' }}
                      </td>
                      <!-- Phone -->
                      <td class="text-white">
                        <a href="tel:{{ $user->mobile_phone }}" class="text-white">
                          {{ $user->mobile_phone ?? 'Leeg' }}
                        </a>
                      </td>

                      <!-- Email -->
                      <td class="text-white">
                        <a href="mailto:{{ $user->email }}" class="text-white">
                          {{ $user->email ?? 'Leeg' }}
                        </a>
                      </td>
                      <!-- Open, edit, delete -->
                      <td style="width: 20%;" class="text-center">
                        <div style="display: flex;">
                          <form action="{{ route('users.show', $user->id) }}" method="GET" style="margin-right: 10px;">
                            @csrf
                            <button type="submit" class="table-link text-info" style="border: none; background: none; padding: 0; cursor: pointer;">
                              <x-heroicon-o-magnifying-glass-plus stroke="white" style="width: 27px;" />
                            </button>
                          </form>

                          <form action="{{ route('users.edit', $user->id) }}" method="GET" style="margin-right: 10px;">
                            @csrf
                            <button type="submit" class="table-link text-info" style="border: none; background: none; padding: 0; cursor: pointer;">
                              <x-heroicon-o-pencil stroke="white" style="width: 27px;" />
                            </button>
                          </form>

                          <form action="users-remove/{{ $user->id }}" method="GET" id="delete-form-{{ $user->id }}">
                            @csrf
                            <button type="submit" class="table-link text-info"
                                    onclick="return confirm('Weet je zeker dat je gebruiker {{ $user->name }} wilt verwijderen?');"
                                    style="border: none; background: none; padding: 0; cursor: pointer;">
                              <x-heroicon-o-trash stroke="white" style="width: 27px;" />
                            </button>
                          </form>
                        </div>
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
  </style>
</div>

