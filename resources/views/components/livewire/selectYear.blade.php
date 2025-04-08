<select wire:model="selectYear" wire:change="updateSelectYear"  class="form-control form-control-lg selector_custom">
  @foreach(range(2023, date('Y') + 7) as $year)
    <option value="{{ $year }}" @if ( (string) $year == date('Y')) selected @endif>
      {{ $year }}
    </option>
  @endforeach
</select>
