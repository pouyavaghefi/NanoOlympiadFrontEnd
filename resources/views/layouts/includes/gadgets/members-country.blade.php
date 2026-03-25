<div class="team-area py-120">
    @php
        $withoutExtension = pathinfo($member_country->flag, PATHINFO_FILENAME);
        $withoutExtension = strtoupper($withoutExtension);
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <img src="{{ env('URL_ADMIN') . '/members-country/' . $member_country->flag }}"
                         alt="{{ $member_country->name }}" class="img-fluid mb-2 flag-img" width="50" height="50">
                    <h2 class="site-title"><span>{{ $member_country->showNationalityByCode($withoutExtension) }}</span> Members</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($members as $index => $member)
                @php
                    $flagFilename = pathinfo($member_country->flag, PATHINFO_BASENAME);   // e.g. ir.png
                    $flagNameOnly = pathinfo($member_country->flag, PATHINFO_FILENAME);  // e.g. ir
                    $flagExt = pathinfo($member_country->flag, PATHINFO_EXTENSION);      // e.g. png

                    $smallFlagUrl = env('URL_ADMIN') . '/members-country/' . $flagFilename;
                    $largeFlagUrl = env('URL_ADMIN') . '/members-country/' . $flagNameOnly . '2.' . $flagExt;
                @endphp

                <div class="col-md-6 col-lg-3">
                    <div class="team-item wow fadeInUp member-card"
                         data-bs-toggle="modal"
                         data-bs-target="#memberModal"
                         data-name="{{ $member->surname }}"
                         data-flag="{{ $smallFlagUrl }}"
                         data-flag2="{{ $largeFlagUrl }}"
                         data-url="{{ url()->current() }}#member-{{ $member->id }}">
                        <div class="team-content">
                            <div class="team-bio">
                                <h5><a href="#">{{ $member->surname ?? '' }}</a></h5>
                                <p class="text-muted">{{ $member->father_name ?? "Father's name not available" }}</p>
                                <p class="text-muted"><strong>Birthday:</strong> {{ \Carbon\Carbon::parse($member->birthday)->format('M d, Y') ?? 'Not provided' }}</p>
                                <p class="text-muted"><strong>City:</strong> {{ $member->city ?? 'Not specified' }}</p>
                                <p class="text-muted"><strong>Gender:</strong> {{ ucfirst($member->gender ?? 'Not specified') }}</p>
                            </div>
                        </div>
                        <span class="team-social-btn">
                <i class="far fa-share-nodes"></i>
            </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- team-area end -->