<div class="overflow-x-auto w-full">
  <div class="flex space-x-4 px-4 py-2 w-max">
    @foreach($spesialisList as $spesialis)
      <a href="{{ route('pasien.cari', ['spesialis' => $spesialis]) }}"
         class="flex-shrink-0 px-6 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-medium hover:bg-green-500 hover:text-white transition whitespace-nowrap">
        {{ $spesialis }}
      </a>
    @endforeach
  </div>
</div>
