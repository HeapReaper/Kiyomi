<div>
	<div class="container mt-4">
		<h1 class="text-white font-weight-bold">
			Leden statistieken
		</h1>
	  <div class="row">
			<h1 class="text-white font-weight-bold">
				Aantal
			</h1>
			<!-- Junior members -->
			<div class="col bg-dark bg-opacity-25 m-2 rounded text-center">
			  <h2 class="text-white font-weight-bold">
					Junior:
				</h2>
				<h2 class="text-white font-weight-bold">
				  {{ $roleCounts['junior_member'] ?? 0 }}
				</h2>
			</div>
			<!-- Aspirant members -->
			<div class="col bg-dark bg-opacity-25 m-2 rounded text-center">
			  <h2 class="text-white font-weight-bold">
					Aspirant:
				</h2>
				<h2 class="text-white font-weight-bold">
					{{ $roleCounts['aspirant_member'] ?? 0 }}
				</h2>
			</div>
			<!-- Members -->
			<div class="col bg-dark bg-opacity-25 m-2 rounded text-center">
        <h2 class="text-white font-weight-bold">
					Leden:
				</h2>
				<h2 class="text-white font-weight-bold">
					{{ $roleCounts['member'] ?? 0 }}
				</h2>
			</div>
			<!-- Management -->
			<div class="col bg-dark bg-opacity-25 m-2 rounded text-center">
			  <h2 class="text-white font-weight-bold">
					Bestuur:
				</h2>
				<h2 class="text-white font-weight-bold">
					{{ $roleCounts['management'] ?? 0 }}
				</h2>
			</div>
			<!-- Donors -->
			<div class="col bg-dark bg-opacity-25 m-2 rounded text-center">
			  <h2 class="text-white font-weight-bold">
					Donateurs:
				</h2>
				<h2 class="text-white font-weight-bold">
					{{ $roleCounts['donor'] ?? 0 }}
				</h2>
			</div>
			<!-- Total -->
			<div class="col bg-dark bg-opacity-25 m-2 rounded text-center">
			  <h2 class="text-white font-weight-bold">
					Totaal:
				</h2>
				<h2 class="text-white font-weight-bold">
				  {{ $roleCounts['total'] ?? 0 }}
				</h2>
			</div>
		</div>
	</div>
</div>