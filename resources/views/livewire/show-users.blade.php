<div>
<div class="row">
        <div class="col-lg-12">
          <div class="main-box no-header clearfix bg-dark bg-opacity-50">
            <div class="row">
              <div class="col ml-2">
                <div class="w-25 float-start mb-4 ms-4">
                  <input wire:model.live="search" type="text" id="name_search" placeholder="Naam, email, 06 " class="form-control rounded">
                </div>
              </div>

              <div class="col mr-2">
                <div class="w-25 mb-4 me-4 float-end">
                  <select class="form-control form-control-lg">
                    <option value="All" selected>Alle club statussen</option>
                    <option value="Jeugdlid">Jeugd lid</option>
                    <option value="Aspirantlid">Aspirant lid</option>
                    <option value="Lid">Lid</option>
                    <option value="Bestuur">Bestuur</option>
                    <option value="Donateur">Donateur</option>
                    <option value="Noggeenlid">Nog geen lid</option>
                    <option value="Nieuweaanmelding">Nieuwe aanmeldingen</option>
                  </select>
                </div>
              </div>
            </div>
            <td>

            </td>
            <div class="main-box-body clearfix">
              <div class="table-responsive">
                <table class="table user-list" id="MembersTable">
                  <thead class="text-white">
                    <tr>
                      <th><span>Icoon</span></th>
                      <th><span>Vol. naam</span></th>
                      <th><span>KNVvl</span></th>
                      <th class="text-center"><span>Club status</span></th>
                      <th><span>RDW</span></th>
                      <th><span>Telefoon</span></th>
                      <th><span>Email</span></th>
                      <th>Open, bewerk, verwijder</th>
                    </tr>
                  </thead>
                  <tbody class="text-white">
                    <tr>
                      @foreach ($users as $user)
                        <td>
                          <img src="https://placehold.co/35x35" alt="" style="width: 35px" class="img-fluid ms-2">
                        </td>
                        <!-- Name -->
                        <td>
                          {{ $user->name ?? 'Niet ingevuld' }}
                        </td>
                        <!-- KNVvl number -->
                        <td>
                          {{ $user->knvvl ?? 'Niet ingevuld' }}
                        </td>
                        <!-- Club status -->
                        <td>
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
                            @case('not_paid_member')
                              <span class="badge badge-pill bg-danger" style="font-size: 1rem;">Nog niet betaald</span>
                              @break
                          @endswitch
                        </td>
                        <!-- RDW -->
                        <td>
                          {{ $user->rdw_number ?? 'Niet ingevuld' }}
                        </td>
                        <!-- Phone -->
                        <td>
                          {{ $user->mobile_phone ?? 'Niet ingevuld' }}
                        </td>
                        <!-- Email -->
                        <td>
                          {{ $user->email ?? 'Niet ingevuld' }}
                        </td>
                        <!-- Open, edit, delete -->
                        <td style="width: 20%;">
                          <a href="#" class="table-link text-warning">
                            <span class="fa-stack" style="font-size: 1rem;">
                              <i class="fa fa-square fa-stack-2x"></i>
                              <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                            </span>
                          </a>
                          <a href="{{ route('users.edit', $user->id) }}" class="table-link text-info">
                            <span class="fa-stack" style="font-size: 1rem;">	
                              <i class="fa fa-square fa-stack-2x"></i>
                              <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                            </span>
                          </a>
                          <a href="leden/verwijder/{{ $user->id }}" class="table-link danger" onclick="return confirm('Weet je zeker dat je gebruiker {{ $user->name }} wilt verwijderen?');">
                            <span class="fa-stack" style="font-size: 1rem;">
                              <i class="fa fa-square fa-stack-2x"></i>
                              <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                            </span>
                          </a>
                        </td>
                      @endforeach
                    </tr>
                  </tbody>
                </table
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
