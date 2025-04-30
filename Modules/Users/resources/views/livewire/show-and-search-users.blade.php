<div>
  <div class="row">
    <div class="col-lg-12">
      <div class="main-box no-header clearfix bg-dark bg-opacity-25 rounded shadow-lg p-2">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h2 class="text-white">Leden</h2>

          <a href="{{ route('users.create') }}" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">
            Nieuw lid
          </a>
        </div>
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
                <option value="webmaster">
                  Webmaster
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
                  <th class="text-white"><span>Foto</span></th>
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
                      <td>
                        @if ($user->profile_picture)
                          <img src="{{ Storage::url('uploads/' . $user->profile_picture) }}" class="img-fluid rounded-circle" style="max-width: 40px; object-fit: cover;">
                        @else
                          <img src="https://placehold.co/40x40" class="rounded-circle">
                        @endif
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
                        @foreach($user->getRoleNames() as $role)
                          @switch($role)
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
                            @case('webmaster')
                              <span class="badge badge-pill" style="font-size: 1rem; background-color: #9F0707;"><small>Webmaster</small></span>
                              @break
                          @endswitch
                        @endforeach
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
                            <x-buttons.show />
                          </form>

                          <form action="{{ route('users.edit', $user->id) }}" method="GET" style="margin-right: 10px;">
                            @csrf
                            <x-buttons.edit />
                          </form>

                          <form action="users-remove/{{ $user->id }}" method="GET" id="delete-form-{{ $user->id }}">
                            @csrf
                            <x-buttons.delete tooltip="Weet je zeker dat je {{ $user->name }} wilt verwijderen?" />
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

