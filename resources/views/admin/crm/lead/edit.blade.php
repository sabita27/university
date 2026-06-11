<!-- Edit modal -->
<div class="modal fade" id="editModal-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $row->id }}" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#8b5cf6,#6366f1);color:#fff;border:none;">
                <h5 class="modal-title" id="editModalLabel-{{ $row->id }}">
                    <i class="far fa-edit me-2"></i>{{ __('modal_edit') }} {{ $title }} &nbsp;&mdash;&nbsp; <span style="font-weight:400;font-size:.9em;">{{ $row->name }}</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0" style="min-height:400px;">

                    {{-- LEFT: Edit Form --}}
                    <div class="col-md-7 p-4" style="border-right:1px solid #f1f5f9;">
                        <form class="needs-validation" novalidate action="{{ route($route.'.update', $row->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-2">
                                <div class="col-12">
                                    <label class="form-label fw-bold">{{ __('field_first_name') }} {{ __('field_last_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ $row->name }}" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">{{ __('field_father_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="father_name" value="{{ $row->father_name }}" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">{{ __('field_phone') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone" value="{{ $row->phone }}" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">{{ __('field_email') }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ $row->email }}" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">{{ __('field_educational_qualification') }} <span class="text-danger">*</span></label>
                                    <select name="educational_qualification" class="form-control" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach($qualifications as $qualification)
                                        <option value="{{ $qualification->title }}" @if($row->educational_qualification == $qualification->title) selected @endif>{{ $qualification->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Board / School <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="board" value="{{ $row->board }}" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Total Mark <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_mark" value="{{ $row->total_mark }}" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Total Percentage (%) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" name="total_percentage" value="{{ $row->total_percentage }}" required>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">{{ __('field_program') }} <span class="text-danger">*</span></label>
                                    <select class="form-control" name="program_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach($programs as $program)
                                        <option value="{{ $program->id }}" @if($row->program_id == $program->id) selected @endif>{{ $program->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">{{ __('field_source') }} <span class="text-danger">*</span></label>
                                    <select class="form-control" name="lead_source_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach($sources as $source)
                                        <option value="{{ $source->id }}" @if($row->lead_source_id == $source->id) selected @endif>{{ $source->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">{{ __('field_status') }} <span class="text-danger">*</span></label>
                                    <select class="form-control edit-status-select-{{ $row->id }}" name="lead_status_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" @if($row->lead_status_id == $status->id) selected @endif>{{ $status->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Counselor</label>
                                    <select class="form-control" name="counsellor_id">
                                        <option value="">{{ __('select') }}</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($row->counsellor_id == $user->id) selected @endif>{{ $user->first_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Next Follow-up Date</label>
                                    <input type="date" class="form-control" name="follow_up_date" value="{{ $row->followUps->first()?->follow_up_date ?? '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">{{ __('field_description') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" rows="2" required>{{ $row->description }}</textarea>
                                    <div class="invalid-feedback">Required</div>
                                </div>
                            </div>

                            {{-- Follow-up Fields (shown only when status = Follow-up Required) --}}
                            <div class="follow-up-fields-{{ $row->id }} mt-3" style="{{ $row->lead_status_id == 2 ? '' : 'display:none;' }}">
                                <div class="p-3 rounded-3" style="background:#f5f3ff;border:1px solid #e0d9ff;">
                                    <h6 class="fw-bold mb-2" style="color:#7c3aed;"><i class="fas fa-calendar-check me-1"></i> Add Follow-up Entry</h6>
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <label class="form-label fw-bold small">Today's Note <span class="text-muted fw-normal">(saved to history)</span></label>
                                            <textarea class="form-control" name="follow_up_note" rows="2" placeholder="Write what happened today..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>{{ __('btn_close') }}</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check me-1"></i>{{ __('btn_update') }}</button>
                            </div>
                        </form>
                    </div>

                    {{-- RIGHT: Follow-up History Timeline --}}
                    <div class="col-md-5 p-4" style="background:#fafafa;">
                        <h6 class="fw-bold mb-3" style="color:#374151;"><i class="fas fa-history me-2 text-purple" style="color:#8b5cf6;"></i>Follow-up History</h6>

                        @if($row->followUps->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-clipboard-list" style="font-size:2rem;color:#d1d5db;"></i>
                                <p class="text-muted small mt-2">No follow-ups recorded yet.<br>Change status to "Follow-up Required" and save a note.</p>
                            </div>
                        @else
                            <div class="follow-up-timeline" style="max-height:480px;overflow-y:auto;padding-right:4px;">
                                @foreach($row->followUps as $fu)
                                <div class="timeline-item d-flex gap-3 mb-3">
                                    <div class="timeline-dot-wrap d-flex flex-column align-items-center" style="min-width:18px;">
                                        <div style="width:12px;height:12px;border-radius:50%;background:#8b5cf6;margin-top:4px;flex-shrink:0;"></div>
                                        @if(!$loop->last)
                                        <div style="width:2px;flex:1;background:#e9d5ff;margin-top:4px;"></div>
                                        @endif
                                    </div>
                                    <div class="timeline-content p-2 rounded-3 w-100" style="background:#fff;border:1px solid #ede9fe;">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <span class="small fw-bold" style="color:#7c3aed;">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                {{ $fu->follow_up_date ? \Carbon\Carbon::parse($fu->follow_up_date)->format('M d, Y') : '—' }}
                                            </span>
                                            <span class="text-muted" style="font-size:.7rem;">{{ $fu->created_at->diffForHumans() }}</span>
                                        </div>
                                        @if($fu->follow_up_note)
                                        <p class="mb-1 mt-1 small text-dark">{{ $fu->follow_up_note }}</p>
                                        @endif
                                        @if($fu->creator)
                                        <span class="small text-muted"><i class="fas fa-user me-1"></i>{{ $fu->creator->first_name }} {{ $fu->creator->last_name }}</span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('.edit-status-select-{{ $row->id }}').addEventListener('change', function() {
        const fields = document.querySelector('.follow-up-fields-{{ $row->id }}');
        fields.style.display = this.value == '2' ? 'block' : 'none';
    });
</script>
