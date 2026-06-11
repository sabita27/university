(function(){
    const URL_TPL="{{route('admin.crm.lead.update-status',':id')}}";
    const CSRF="{{csrf_token()}}";
    let dragId=null,dragEl=null,origCol=null;

    window.setCreateStatus = function(statusId) {
        let select = document.querySelector('#createLeadModal select[name="lead_status_id"]');
        if(select) {
            select.value = statusId;
        }
    };

    window.kbDragStart=(e,id)=>{
        dragId=id;
        dragEl=e.currentTarget;
        origCol=dragEl.closest('.kb-col-body');
        e.dataTransfer.effectAllowed='move';
        setTimeout(()=>dragEl.classList.add('dragging'),0);
    };
    window.kbDragEnd=(e)=>{
        e.currentTarget.classList.remove('dragging');
        document.querySelectorAll('.kb-col').forEach(c=>c.classList.remove('drag-over'));
    };
    window.kbAllowDrop=(e)=>{
        e.preventDefault();
        e.currentTarget.closest('.kb-col').classList.add('drag-over');
    };
    window.kbDragLeave=(e)=>{
        let col = e.currentTarget.closest('.kb-col');
        if(col) col.classList.remove('drag-over');
    };
    window.kbDrop=(e,sid)=>{
        e.preventDefault();
        let col = e.currentTarget.closest('.kb-col');
        if(col) col.classList.remove('drag-over');
        if(!dragEl) return;
        const body = col.querySelector('.kb-col-body');
        body.appendChild(dragEl);
        
        fetch(URL_TPL.replace(':id',dragId),{
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
            body:JSON.stringify({status_id:sid===0?null:sid})
        }).then(r=>r.json()).then(d=>{
            if(d.success&&typeof toastr!=='undefined') toastr.success('Status updated!');
            applyFilters(); 
        });
        dragId = dragEl = origCol = null;
    };
