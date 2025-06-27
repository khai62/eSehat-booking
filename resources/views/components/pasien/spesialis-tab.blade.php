<div class="overflow-x-auto w-full py-0.5 bg-gradient-to-r">
  <div class="flex space-x-3 px-6 w-max">

    @foreach($spesialisList as $spesialis)
      <a href="{{ route('pasien.cari', ['spesialis' => $spesialis]) }}"
         class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-medium border border-teal-300 text-teal-700 bg-white hover:bg-teal-500 hover:text-white transition-all shadow-sm">
        {{ $spesialis }}
      </a>
    @endforeach

  </div>
</div>
