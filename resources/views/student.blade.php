@extends('layouts.app')

@section('title', 'Call Page')

@section('content')
<link rel="stylesheet" href="css/form.css"> {{-- Comment: ربط ملف التنسيق الخارجي كما طلبت --}}

{{-- Flash messages (Laravel) --}}
@if(session('success'))
    <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
    </div>
@endif

{{-- Main form --}}
<form action="{{ route('voicecalls.store') }}" method="POST" id="voicecallForm" onsubmit="return checkStudentIdBeforeSubmit()">
    @csrf

    {{-- Decorative assets --}}
    <picture>
        <source srcset="assets/logowithname.svg" type="image/svg+xml">
        <img src="assets/logowithname.svg" class="logo" alt="logo" draggable="false">
    </picture>

    <img src="assets/bottomleft.svg" class="bottom-left" alt="bottomleft" draggable="false">
    <img src="assets/topright.svg" class="top-right" alt="topright" draggable="false">

    {{-- Customer type tabs (radio icons) --}}
    <div class="field caller-tabs" 
         style="display: flex; flex-direction: column; align-items: center; text-align: center; gap: 10px; margin-bottom: 60px;">
        <div class="radio-group">
            <div class="slider"></div>

            <input type="radio" name="customer_type" id="caller-student" value="student" hidden {{ old('customer_type', 'student') == 'student' ? 'checked' : '' }}>
            <label for="caller-student">
                <span>Student</span>
                <img src="assets/student.png" alt="student" class="tabicon">
            </label>

            <input type="radio" name="customer_type" id="caller-parent" value="parent" hidden {{ old('customer_type') == 'parent' ? 'checked' : '' }}>
            <label for="caller-parent">
                <span>Parent</span>
                <img src="assets/parent.png" alt="parent" class="tabicon">
            </label>

            <input type="radio" name="customer_type" id="caller-staff" value="staff" hidden {{ old('customer_type') == 'staff' ? 'checked' : '' }}>
            <label for="caller-staff">
                <span>Staff</span>
                <img src="assets/staff.png" alt="staff" class="tabicon">
            </label>

            <input type="radio" name="customer_type" id="caller-general" value="general" hidden {{ old('customer_type') == 'general' ? 'checked' : '' }}>
            <label for="caller-general">
                <span>General</span>
                <img src="assets/general.png" alt="general" class="tabicon">
            </label>
        </div>
    </div>

    {{-- ========== Index & Ticket area ========== --}}
    <div class="field" id="index-field" style="display: flex; flex-direction: row; gap: 20px;">
        <div style="flex: 1 1 15%;">
            <div class="label">Index</div>
            <input type="text" id="indexInput" name="stud_index" value="{{ old('stud_index') }}" class="form-control">
                <button type="button" data-bs-target="#StatusModal" data-bs-toggle="modal" id="btngetstdrecord"
                class="view-btn" style="padding:8px 12px; border:none; background:#EC8305; color:#fff; border-radius:6px; cursor:pointer;">
                View Status
            </button>
            <div style="margin-top:12px;">
                
                <input type="hidden" id="ticketno" class="form-control" value="">
            </div>

            <div style="margin-top:12px;">
                <div class="label">#</div>
                <input type="text" id="stud_id" name="stud_id" value="{{ old('stud_id') }}" class="form-control" readonly>
                {{-- Comment: نجعل هذا الحقل readonly لأنه يُملأ من السيرفر --}}
            </div>
        </div>

        <div style="flex: 1 1 25%; display:flex; align-items:flex-end; gap:10px;">
          

            <button type="button" id="btnGetStaffInfo" class="view-btn" data-bs-target="#StaffModal" data-bs-toggle="modal"
              style="display:none; padding:8px 12px; border:none; background:#EC8305; color:#fff; border-radius:6px; cursor:pointer;">
              Staff Tickets
          </button>

        </div>
    </div>

    {{-- ========== Name / Staff ID / Phone ========== --}}
    <div class="flex" style="margin-top:18px;">
        <div class="field" id="name-field">
            <div class="label">Name</div>
            <input type="text" id="name" name="caller_Name" value="{{ old('caller_Name') }}" class="form-control" readonly>
            {{-- Comment: الاسم يتم جلبه من السيرفر إن وجد، لذا readonly --}}
        </div>

        <div class="field" id="id-field">
            <div class="label">Staff ID</div>
            <input type="text" id="id" name="staff_id" value="{{ old('staff_id') }}" class="form-control">
        </div>

        <div class="field" id="parent-field">
            <div class="label">Phone</div>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control">
        </div>
    </div>

    {{-- ========== Faculty / Batch / Major ========= --}}
    <div class="flex" style="margin-top:12px;">
        <div class="field" id="faculty-field">
            <div class="label">Faculty</div>
            <input type="text" id="facultyInput" name="faculty" value="{{ old('faculty') }}" class="form-control" readonly>
        </div>

        <div class="field" id="batch-field">
            <div class="label">Batch</div>
            <input type="text" id="batchInput" name="batch" value="{{ old('batch') }}" class="form-control" readonly>
        </div>

        <div class="field" id="major-field">
            <div class="label">Major</div>
            <input type="text" id="majorInput" name="major" value="{{ old('major') }}" class="form-control" readonly>
        </div>
    </div>

    {{-- ========== Issue & Category ========= --}}
    <div class="field" style="margin-top:12px;">
        <div class="label">Issue</div>
        <textarea id="issue" name="issue" rows="4" class="form-control">{{ old('issue') }}</textarea>
    </div>

    <div class="field" style="margin-top:12px;">
        <div class="label">Category</div>
        <select id="category" name="category" class="form-select">
            <option value="" selected></option>
            <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>Data Follow and Verification</option>
            <option value="42" {{ old('category') == '42' ? 'selected' : '' }}>General Inquiries</option>
            <option value="3" {{ old('category') == '3' ? 'selected' : '' }}>Finance</option>
            <option value="2" {{ old('category') == '2' ? 'selected' : '' }}>Certificates and Statements</option>
            <option value="14" {{ old('category') == '14' ? 'selected' : '' }}>E-Learning</option>
            <option value="28" {{ old('category') == '28' ? 'selected' : '' }}>Update Ministry Graduates List</option>
            <option value="16" {{ old('category') == '16' ? 'selected' : '' }}>CESD / CTS (Staff only)</option>
            <option value="43" {{ old('category') == '43' ? 'selected' : '' }}>Human Resources</option>
            <option value="24" {{ old('category') == '24' ? 'selected' : '' }}>Reports</option>
            <option value="23" {{ old('category') == '23' ? 'selected' : '' }}>Higher Management</option>
            <option value="30" {{ old('category') == '30' ? 'selected' : '' }}>External Transfer & Elevation</option>
            <option value="31" {{ old('category') == '31' ? 'selected' : '' }}>New Admission</option>
            <option value="32" {{ old('category') == '32' ? 'selected' : '' }}>Faculty of Geoinformatics</option>
            <option value="33" {{ old('category') == '33' ? 'selected' : '' }}>Fine Arts & Interior Design</option>
            <option value="34" {{ old('category') == '34' ? 'selected' : '' }}>Faculty of Architecture</option>
            <option value="35" {{ old('category') == '35' ? 'selected' : '' }}>Telecommunication & Space Tech</option>
            <option value="37" {{ old('category') == '37' ? 'selected' : '' }}>Information Technology</option>
            <option value="38" {{ old('category') == '38' ? 'selected' : '' }}>Engineering</option>
            <option value="39" {{ old('category') == '39' ? 'selected' : '' }}>Computer Sciences</option>
            <option value="40" {{ old('category') == '40' ? 'selected' : '' }}>Business Administration</option>
            <option value="41" {{ old('category') == '41' ? 'selected' : '' }}>Postgraduate Studies</option>
            <option value="44" {{ old('category') == '44' ? 'selected' : '' }}>BetterU Service</option>
            <option value="45" {{ old('category') == '45' ? 'selected' : '' }}>Technology Horizon Journal</option>
        </select>
    </div>

    {{-- ========== Ticket fields (filled from ticket fetch) ========= --}}
    <div id="ticket-fields-group" style="margin-top:12px;">
        <div class="flex">
            <div class="field">
                <div class="label">Ticket Number</div>
                <input type="text" id="ticketNumber" name="ticket_number" value="{{ old('ticket_number') }}" class="form-control" readonly>
            </div>

            <div class="field">
                <div class="label">Ticket URL</div>
                <input type="text" id="ticketURL" name="ticket_url" value="{{ old('ticket_url') }}" class="form-control" readonly>
            </div>

            <div class="field">
                <div class="label">Found Status</div>
                <input type="text" id="foundStatus" name="foundStatus" value="{{ old('foundStatus') }}" class="form-control" readonly>
            </div>
        </div>

        <div class="flex" style="margin-top:8px;">
            <div class="field">
                <div class="label">Priority</div>
                <input type="text" id="priority" name="priority" value="{{ old('priority') }}" class="form-control" readonly>
            </div>

            <div class="field">
                <div class="label">Assigned To</div>
                <input type="text" id="assignedTo" name="assignedTo" value="{{ old('assignedTo') }}" class="form-control" readonly>
            </div>
        </div>
    </div>

    <div class="field" style="margin-top:12px;">
        <div class="label">Final Status</div>
        <select id="finalStatus" name="Final_Status" class="form-select">
            <option value="" selected></option>
            <option value="1" {{ old('Final_Status') == '1' ? 'selected' : '' }}>Resolved</option>
            <option value="2" {{ old('Final_Status') == '2' ? 'selected' : '' }}>Submitted</option>
            <option value="3" {{ old('Final_Status') == '3' ? 'selected' : '' }}>Escalated</option>
        </select>
    </div>

    <div class="field" style="margin-top:12px;">
        <div class="label">Solution Note</div>
        <textarea id="solutionNote" name="Solution_Note" rows="5" class="form-control">{{ old('Solution_Note') }}</textarea>
    </div>

    <div class="btn" style="margin-top:16px; width:100%;">
        <button type="submit" class="submit-btn" style="padding:10px 14px; background:#EC8305; color:#fff; border:none; border-radius:6px;">Submit Ticket</button>
    </div>

</form>

{{-- ======================= Staff Modal ======================= --}}
<div class="modal fade" id="StaffModal" tabindex="-1" aria-labelledby="StaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="StaffModalLabel" style="color: #EC8305;">Staff Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <p><b>Staff Name:</b> <span id="staffName">N/A</span></p>

                <div class="row mb-2">
                    <div class="col-12 mb-2">
                        <p><b>Tickets:</b></p>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="color: #EC8305;">Ticket ID</th>
                                    <th style="color: #EC8305;">Ticket Subject</th>
                                    <th style="color: #EC8305;">URL</th>
                                    <th style="color: #EC8305;">Get</th>
                                    <th style="color: #EC8305;">Remark</th>
                                </tr>
                            </thead>
                            <tbody id="staffTicketsTable">
                                <tr>
                                    <td colspan="5" class="text-center">No data available</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- ======================= Student Status Modal ======================= --}}
<div class="modal fade" id="StatusModal" tabindex="-1" aria-labelledby="StatusModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="StatusModalLabel" style="color: #EC8305;">Student Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" ></button>
      </div>
      <div class="modal-body" style="padding: 20px;">
        <p><b>Univ. #:</b> <span id="stud_id_display">N/A</span></p>
        <p><b>Name:</b> <span id="studentName">N/A</span></p>
        <p><b>Major:</b> <span id="studentMajor">N/A</span></p>
        <p><b>Batch:</b> <span id="studentBatch">N/A</span></p>
        <p><b>Semester:</b> <span id="studentSemester">N/A</span></p>
        <p><b>Status:</b> <span id="studentStatus">N/A</span></p>
        
        <!-- Subjects Table -->
        <div class="row mb-2">
            <div class="col-12 mb-2">
              <p><b>F/Z/I Subjects:</b></p>
            </div>
            <div class="col-12">
              <table class="table table-bordered table-sm align-middle">
                <thead class="table-light">
                  <tr>
                    <th style="color: #EC8305;">Sem</th>
                    <th style="color: #EC8305;">Course</th>
                    <th style="color: #EC8305;">Grade</th>
                    <th style="color: #EC8305;">Remark</th>
                  </tr>
                </thead>
                <tbody id="studentSubjectsTable">
                  <tr>
                    <td colspan="4" class="text-center">No data available</td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>

        <!-- Tickets Table -->
        <div class="row mb-2">
            <div class="col-12 mb-2">
              <p><b>Tickets:</b></p>
            </div>
            <div class="col-12">
              <table class="table table-bordered table-sm align-middle">
                <thead class="table-light">
                  <tr>
                    <th style="color: #EC8305;">Ticket ID</th>
                    <th style="color: #EC8305;">Ticket Subject</th>
                    <th style="color: #EC8305;">URL</th>
                    <th style="color: #EC8305;">Get</th>
                    <th style="color: #EC8305;">Remark</th>
                  </tr>
                </thead>
                <tbody id="ticketsTable">
                  <tr>
                    <td colspan="5" class="text-center">No data available</td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
/*
 Comment: هذا السكربت يجمع كل وظائف الصفحة:
  - التحكم في تبويبات النوع (student, parent, staff, general)
  - جلب بيانات الطالب عبر /get-student/{id}
  - جلب بيانات التذكرة عبر /search-ticket/{trackid}
  - جلب تذاكر الموظف عبر /staff-tickets/{staffId}
  - بحث بالتذكرة عبر /ticket-search/{ticketno}
  - تعبئة الحقول في الفورم
  - إظهار المودالات وتحديث الجداول داخلها
  - فتح الحقول القابلة للتحرير بعد اختيار التذكرة
  - إظهار/إخفاء زر Staff Tickets بناءً على الاختيار
  - إخفاء رسائل الفلاش تلقائياً
*/

/* ====== DOM references ====== */
const radios = document.querySelectorAll('input[name="customer_type"]');
const fields = {
    parent: document.getElementById("parent-field"),
    faculty: document.getElementById("faculty-field"),
    batch: document.getElementById("batch-field"),
    major: document.getElementById("major-field"),
    index: document.getElementById("index-field"),
    id: document.getElementById("id-field")
};
const slider = document.querySelector(".slider");

/* ====== UI Helpers ====== */
function moveSliderTo(label) {
    if (!label) return;
    const rect = label.getBoundingClientRect();
    const parentRect = label.parentElement.getBoundingClientRect();
    slider.style.width = rect.width + "px";
    slider.style.height = rect.height + "px";
    slider.style.transform = `translateX(${rect.left - parentRect.left}px)`;
}

/* Comment: دالة تحديث الحقول حسب نوع العميل + إظهار/إخفاء زر الموظف */
function updateVisibility(role) {
    // إخفاء كل الحقول أولاً
    Object.values(fields).forEach(f => { if (f) f.style.display = "none"; });

    // إظهار الحقول المناسبة حسب نوع العميل
    if (role === "student" || role === "parent") {
        if (fields.faculty) fields.faculty.style.display = "block";
        if (fields.batch) fields.batch.style.display = "block";
        if (fields.major) fields.major.style.display = "block";
        if (fields.index) fields.index.style.display = "flex";
    } else if (role === "staff") {
        if (fields.faculty) fields.faculty.style.display = "block";
        if (fields.id) fields.id.style.display = "block";
    } else if (role === "general") {
        if (fields.parent) fields.parent.style.display = "block";
    }

    // إظهار أو إخفاء زر Staff Tickets بناءً على الاختيار
    const staffBtn = document.getElementById('btnGetStaffInfo');
    if (staffBtn) {
        staffBtn.style.display = (role === "staff") ? "inline-block" : "none";
        
    }

    document.querySelectorAll(".radio-group label").forEach(lbl => lbl.classList.remove("active"));
    const activeLabel = document.querySelector(`label[for="caller-${role}"]`);
    if (activeLabel) activeLabel.classList.add("active");
    moveSliderTo(activeLabel);
}

/* Initialize tab slider and visibility */
window.addEventListener("load", () => {
    const checked = document.querySelector('input[name="customer_type"]:checked');
    if (checked) updateVisibility(checked.value);
    // position slider correctly after load
    setTimeout(() => {
        const activeLabel = document.querySelector('.radio-group label.active') || document.querySelector('.radio-group label');
        moveSliderTo(activeLabel);
    }, 50);
});
window.addEventListener("resize", () => {
    const checked = document.querySelector('input[name="customer_type"]:checked');
    if (checked) moveSliderTo(document.querySelector(`label[for="caller-${checked.value}"]`));
});
radios.forEach(r => r.addEventListener("change", e => updateVisibility(e.target.value)));

/* ====== Utility: fade messages ====== */
setTimeout(() => {
    const messages = document.querySelectorAll('#success-message, #error-message');
    messages.forEach(msg => {
        msg.style.transition = "opacity 0.6s ease, transform 0.6s ease";
        msg.style.opacity = "0";
        msg.style.transform = "translateY(-20px)";
        setTimeout(() => { if (msg && msg.parentNode) msg.remove(); }, 600);
    });
}, 3000);

/* ====== Fetch functions ====== */

/*
 getStudentRecord - يستخدم endpoint /get-student/{id}
 متوقع JSON مثل:
 {
   success: true,
   student: { stud_id, name, faculty, batch, major, semester, status },
   tickets: [ { trackid, subject, priority, owner_name, ... }, ... ],
   clearance: [ { semester, course_name, clearance_grade, remark }, ... ]
 }
*/
function getStudentRecord(studentId) {
    if (!studentId) { alert('Student ID empty'); return; }

    console.log("Fetching student:", studentId);
    fetch(`{{ url('/get-student') }}/${encodeURIComponent(studentId)}`)
        .then(response => {
            if (!response.ok) throw new Error('Network response not ok: ' + response.status);
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                alert(data.message || 'Error loading student data');
                return;
            }

            // Fill form fields
            document.getElementById('stud_id').value = data.student.stud_id || '';
            document.getElementById('name').value = data.student.name || '';
            document.getElementById('facultyInput').value = data.student.faculty || '';
            document.getElementById('batchInput').value = data.student.batch || '';
            document.getElementById('majorInput').value = data.student.major || '';

            // Fill modal display
            document.getElementById('stud_id_display').textContent = data.student.stud_id || 'N/A';
            document.getElementById('studentName').textContent = data.student.name || 'N/A';
            document.getElementById('studentMajor').textContent = data.student.major || 'N/A';
            document.getElementById('studentBatch').textContent = data.student.batch || 'N/A';
            document.getElementById('studentSemester').textContent = data.student.semester || 'N/A';
            document.getElementById('studentStatus').textContent = data.student.status || 'N/A';

            // Tickets table
            const ticketsTable = document.getElementById('ticketsTable');
            ticketsTable.innerHTML = "";
            if (data.tickets && data.tickets.length > 0) {
                data.tickets.forEach(ticket => {
                    const row = `
                        <tr>
                            <td>${ticket.trackid || ''}</td>
                            <td>${ticket.subject || ''}</td>
                            <td><a href="https://hdesk.fu.edu.sd/admin/admin_ticket.php?track=${ticket.trackid}" target="_blank">View</a></td>
                            <td><a href="javascript:void(0);" onclick="fillTicketForm('${ticket.trackid}')">Get</a></td>
                            <td>${ticket.priority || ''}</td>
                        </tr>`;
                    ticketsTable.insertAdjacentHTML('beforeend', row);
                });
            } else {
                ticketsTable.innerHTML = `<tr><td colspan="5" class="text-center">No tickets found</td></tr>`;
            }

            // Subjects / clearance
            const subjectsTable = document.getElementById('studentSubjectsTable');
            subjectsTable.innerHTML = "";
            if (data.clearance && data.clearance.length > 0) {
                data.clearance.forEach(row => {
                    const tr = `
                        <tr>
                            <td>${row.semester || ''}</td>
                            <td>${row.course_name || ''}</td>
                            <td>${row.clearance_grade || ''}</td>
                            <td>${row.remark || ''}</td>
                        </tr>`;
                    subjectsTable.insertAdjacentHTML('beforeend', tr);
                });
            } else {
                subjectsTable.innerHTML = `<tr><td colspan="4" class="text-center">No data available</td></tr>`;
            }

            // Open modal programmatically
            const modalEl = document.getElementById('StatusModal');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        })
        .catch(error => {
            console.error('Error fetching student:', error);
            alert('Error loading student data: ' + error.message);
        });
}

/*
 fillTicketForm - يستخدم endpoint /search-ticket/{trackid}
 متوقع JSON مثل:
 {
   success: true,
   ticket: { trackid, subject, priority, owner_name, foundStatus, ... }
 }
 بعد تعبئة الحقول نغلق المودال تلقائياً و نفتح حقول التحرير للملاحظات
*/
function fillTicketForm(trackid) {
    if (!trackid) return;
    fetch(`{{ url('/search-ticket') }}/${encodeURIComponent(trackid)}`)
        .then(response => {
            if (!response.ok) throw new Error('HTTP error ' + response.status);
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                alert("لم يتم العثور على بيانات التذكرة");
                return;
            }

            const ticket = data.ticket;
            document.getElementById('ticketNumber').value = ticket.trackid || '';
            document.getElementById('assignedTo').value = ticket.owner_name || '';
            document.getElementById('priority').value = ticket.priority || '';
            document.getElementById('ticketURL').value = ticket.subject || '';
            document.getElementById('foundStatus').value = ticket.foundStatus || '';

            // فتح الحقول القابلة للتحرير بعد اختيار التذكرة
            unlockEditableFields();

            // إغلاق مودال الطالب بعد الاختيار
            const modalEl = document.getElementById('StatusModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modalInstance.hide();
        })
        .catch(error => {
            console.error('Error fetching ticket:', error);
            alert('حصل خطأ أثناء تحميل بيانات التذكرة: ' + error.message);
        });
}

/*
 get_ticket_records - بحث بتذكرة (ticketno)
 يفترض وجود endpoint /ticket-search/{ticketno} الذي يعيد:
 { success: true, studentId: '...', ticket: {...} }
*/
function get_ticket_records(ticketno) {
    if (!ticketno) { alert('Ticket number empty'); return; }

    fetch(`{{ url('/ticket-search') }}/${encodeURIComponent(ticketno)}`)
        .then(r => {
            if (!r.ok) throw new Error('Network response not ok: ' + r.status);
            return r.json();
        })
        .then(data => {
            if (!data.success) {
                alert(data.message || 'No ticket found');
                return;
            }

            if (data.studentId) {
                // لو رجع السيرفر معرف الطالب، نعرض حالة الطالب
                getStudentRecord(data.studentId);
            } else if (data.ticket && data.ticket.trackid) {
                // أو نملأ حقول التذكرة فقط
                document.getElementById('ticketNumber').value = data.ticket.trackid || '';
                document.getElementById('ticketURL').value = data.ticket.subject || '';
                document.getElementById('priority').value = data.ticket.priority || '';
                // وفتح حقول التحرير لأن المستخدم قد يريد كتابة ملاحظات
                unlockEditableFields();
            }
        })
        .catch(err => {
            console.error('Error fetching ticket records:', err);
            alert('Error fetching ticket records: ' + err.message);
        });
}

/*
 getStaffTickets - جلب تذاكر الموظف
 يفترض وجود endpoint /staff-tickets/{staffId} الذي يعيد:
 { success:true, staff: { name }, tickets: [...] }
*/
function getStaffTickets(staffId) {
    if (!staffId) {
        staffId = document.getElementById('id').value.trim();
        if (!staffId) { alert('Enter Staff ID first'); return; }
    }

    fetch(`{{ url('/staff-tickets') }}/${encodeURIComponent(staffId)}`)
        .then(r => {
            if (!r.ok) throw new Error('Network response not ok: ' + r.status);
            return r.json();
        })
        .then(data => {
            if (!data.success) {
                alert(data.message || 'No staff data found');
                return;
            }

            document.getElementById('staffName').textContent = data.staff.name || 'N/A';
            const table = document.getElementById('staffTicketsTable');
            table.innerHTML = "";
            if (data.tickets && data.tickets.length > 0) {
                data.tickets.forEach(t => {
                    const row = `
                        <tr>
                            <td>${t.trackid || ''}</td>
                            <td>${t.subject || ''}</td>
                            <td><a href="https://hdesk.fu.edu.sd/admin/admin_ticket.php?track=${t.trackid}" target="_blank">View</a></td>
                            <td><a href="javascript:void(0);" onclick="fillTicketForm('${t.trackid}')">Get</a></td>
                            <td>${t.priority || ''}</td>
                        </tr>`;
                    table.insertAdjacentHTML('beforeend', row);
                });
            } else {
                table.innerHTML = '<tr><td colspan="5" class="text-center">No tickets found</td></tr>';
            }
        })
        .catch(err => {
            console.error('Error fetching staff tickets:', err);
            alert('Error fetching staff tickets: ' + err.message);
        });
}

/* ====== فتح الحقول القابلة للتحرير بعد اختيار التذكرة ====== */
function unlockEditableFields() {
    const editableIds = ['issue', 'solutionNote', 'category', 'finalStatus'];
    editableIds.forEach(id => {
        const el = document.getElementById(id);
        if (!el) return;
        // إزالة readonly أو disabled إن وجدت
        el.removeAttribute('readonly');
        el.removeAttribute('disabled');
        // لو كانت select فلا حاجة لخاصية أخرى
    });
}

/* ====== Event bindings ====== */
document.getElementById('btngetstdrecord').addEventListener('click', function() {
    const studentId = document.getElementById('indexInput').value.trim();
    const ticketno = document.getElementById('ticketno').value.trim();
    if ((!studentId || studentId === '') && ticketno && ticketno.length > 0) {
        get_ticket_records(ticketno);
    } else if (studentId && studentId !== '') {
        getStudentRecord(studentId);
    } else {
        alert("Please enter Std Id or TicketID");
    }
});

document.getElementById('btnGetStaffInfo').addEventListener('click', function() {
    const staffId = document.getElementById('id').value.trim();
    if (staffId) {
        getStaffTickets(staffId);
    } else {
        document.getElementById('staffName').textContent = 'Enter Staff ID and click Staff Tickets';
        const table = document.getElementById('staffTicketsTable');
        table.innerHTML = '<tr><td colspan="5" class="text-center">No data available</td></tr>';
    }
});

/* ====== checkStudentIdBeforeSubmit - validate before sending to server ====== */
function checkStudentIdBeforeSubmit() {
    const studentId = document.getElementById('stud_id').value.trim();
    const custType = document.querySelector('input[name="customer_type"]:checked').value;

    // إذا كان النوع student أو parent تأكد من وجود stud_id
    if ((custType === 'student' || custType === 'parent') && !studentId) {
        alert("⚠️ يرجى إدخال رقم الطالب أو البحث عنه قبل الإرسال!");
        return false;
    }

    // يمكنك إضافة فحوص إضافية هنا
    return true;
}

/* ====== Extra UI polish: ensure slider initial size when labels loaded ====== */
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        const activeLabel = document.querySelector('.radio-group label.active') || document.querySelector('.radio-group label');
        moveSliderTo(activeLabel);

        // Hide staff button by default if not staff
        const checked = document.querySelector('input[name="customer_type"]:checked');
        const staffBtn = document.getElementById('btnGetStaffInfo');
        if (staffBtn) {
            staffBtn.style.display = (checked && checked.value === 'staff') ? 'inline-block' : 'none';
        }
    }, 120);
});
 
document.addEventListener('hidden.bs.modal', function (event) {
    // حذف أي طبقة باقية من الخلفية
    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    document.body.classList.remove('modal-open'); 
    document.body.style.overflow = 'auto'; // في حال بقي scroll محجوب
});
 

</script>
@endpush
