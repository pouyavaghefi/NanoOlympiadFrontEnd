@php
$membersArray = $members->all();
$locale = 'en';
$membersWithNames = [];

foreach ($membersArray as $member) {
$code = strtoupper(pathinfo($member->flag, PATHINFO_FILENAME));
$countryName = \Locale::getDisplayRegion("-{$code}", $locale);
$membersWithNames[] = ['countryName' => $countryName, 'member' => $member];
}

usort($membersWithNames, function ($a, $b) {
return strcmp($a['countryName'], $b['countryName']);
});
@endphp

<div class="container">
    <h2 class="text-center mb-4 heading">
        <span class="globe-icon">🌍</span> Members
    </h2>

    <div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="" alt="Flag" class="img-fluid mb-3" id="modalFlag">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($membersWithNames as $item)
        @php
        $member = $item['member'];
        $adminBase = rtrim(env('URL_ADMIN'), '/');
        $flagFilename = pathinfo($member->flag, PATHINFO_BASENAME);
        $flagNameOnly = pathinfo($member->flag, PATHINFO_FILENAME);
        $flagExt = pathinfo($member->flag, PATHINFO_EXTENSION);
        $smallFlagUrl = "{$adminBase}/members-country/{$flagFilename}";
        $largeFlagUrl = "{$adminBase}/members-country/{$flagNameOnly}2.{$flagExt}";
        @endphp

        <div class="col-md-4 mb-4">
            <div class="card text-center shadow-sm animate-card member-card" data-bs-toggle="modal" data-bs-target="#memberModal"
                 data-name="{{ $member->name }}"
                 data-flag="{{ $smallFlagUrl }}"
                 data-flag2="{{ $largeFlagUrl }}"
                 data-rep-name="{{ $member->rep_name ?? 'Unknown' }}"
                 data-rep-photo="{{ $adminBase . '/members-rep/' . ($member->rep_photo ?? 'default.jpg') }}"
                 data-rep-link="{{ $member->rep_link ?? '#' }}">
                <div class="card-body">
                    <img src="{{ $smallFlagUrl }}" alt="{{ $member->name }}" class="img-fluid mb-2 flag-img">
                    <h5 class="card-title">{{ $member->name }}</h5>


                </div>
            </div>
        </div>
        @endforeach

        @include('layouts.includes.forms.new_representative')
    </div>
</div>

<script>
    $('#memberModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var name = button.data('name');
        var flagSmall = button.data('flag');
        var flagLarge = button.data('flag2');
        if (!flagLarge && flagSmall) {
            flagLarge = String(flagSmall).replace(/(\.[^/.]+)$/, '2$1');
        }
        var repLink = button.data('rep-link') || '#';
        var modal = $(this);
        modal.find('#memberModalLabel').text(name);
        modal.find('#modalFlag')
            .off('error')
            .attr('src', flagLarge || flagSmall)
            .on('error', function() {
                if (flagSmall && $(this).attr('src') !== flagSmall) {
                    $(this).off('error').attr('src', flagSmall);
                }
            });
        modal.find('#modalRepLink').attr('href', repLink);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

