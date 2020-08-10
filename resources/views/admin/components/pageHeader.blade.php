<div class="mb-3">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-inline">
            <div class="page-title">
                {{ $title }}
            </div>

            <div class="header-elements">
                {{ $right ?? null }}
            </div>
        </div>

        {{ $slot }}
    </div>
</div>
