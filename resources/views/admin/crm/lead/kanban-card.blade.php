<div class="kanban-card"
     id="kanban-card-{{ $row->id }}"
     draggable="true"
     style="border-left-color:{{ $color }};"
     ondragstart="kanbanDragStart(event, {{ $row->id }})"
     ondragend="kanbanDragEnd(event)">

    {{-- Avatar + Name --}}
    <div class="card-lead-top">
        <div class="lead-avatar" style="background:{{ $color }}22;color:{{ $color }};">
            {{ strtoupper(substr($row->name, 0, 1)) }}
        </div>
        <div class="overflow-hidden">
            <div class="lead-name text-truncate">{{ $row->name }}</div>
            @if($row->email)
            <div class="lead-email text-truncate">{{ $row->email }}</div>
            @endif
        </div>
    </div>

    {{-- Phone --}}
    @if($row->phone)
    <div class="card-detail-row">
        <i class="fas fa-phone-alt"></i>
        <span>{{ $row->phone }}</span>
    </div>
    @endif

    {{-- Badges --}}
    <div>
        @if($row->program)
        <span class="card-badge badge-program">
            <i class="fas fa-graduation-cap" style="font-size:.62rem;"></i>
            {{ Str::limit($row->program->title, 22) }}
        </span>
        @endif
        @if($row->educational_qualification)
        <span class="card-badge badge-qual">{{ $row->educational_qualification }}</span>
        @endif
        @if($row->source)
        <span class="card-badge badge-source">{{ $row->source->title }}</span>
        @endif
    </div>

    {{-- Footer Actions --}}
    <div class="card-footer-row">
        @can($access.'-edit')
        <button type="button" class="btn-card-action btn-card-edit"
                data-bs-toggle="modal"
                data-bs-target="#editModal-{{ $row->id }}"
                title="{{ __('btn_edit') }}">
            <i class="far fa-edit"></i>
        </button>
        @include($view.'.edit')
        @endcan

        @can($access.'-delete')
        <button type="button" class="btn-card-action btn-card-del"
                data-bs-toggle="modal"
                data-bs-target="#deleteModal-{{ $row->id }}"
                title="{{ __('btn_delete') }}">
            <i class="fas fa-trash-alt"></i>
        </button>
        @include('admin.layouts.inc.delete')
        @endcan
    </div>
</div>
