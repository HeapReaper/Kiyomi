<button type="submit" class="table-link text-info image-hover-resize-10"
        onclick="return confirm('{{ $attributes->get('tooltip')  }}');"
        style="border: none; background: none; padding: 0; cursor: pointer;">
  <x-heroicon-o-trash stroke="white" style="width: 27px;" />
</button>
