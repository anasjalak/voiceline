<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Organized Form</title>
  <link rel="stylesheet" href="css/form.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* إضافة ستايل للتبويبات */
    .radio-group {
      position: relative;
      display: flex;
      background: #f0f0f0;
      border-radius: 30px;
      padding: 5px;
      width: 100%;
      max-width: 500px;
    }

    .radio-group label {
      flex: 1;
      text-align: center;
      padding: 10px 15px;
      cursor: pointer;
      border-radius: 30px;
      z-index: 2;
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .radio-group label.active {
      color: #fff;
    }

    .radio-group .slider {
      position: absolute;
      top: 5px;
      left: 0;
      border-radius: 30px;
      background: #EC8305;
      transition: all 0.3s ease;
      z-index: 1;
    }

    .tabicon {
      width: 24px;
      height: 24px;
      margin-bottom: 5px;
    }

    .flex {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .flex .field {
      flex: 1;
    }
  </style>
</head>
<body>

   <picture>
    <source srcset="assets/logowithname.svg" type="image/svg+xml">
    <img src="assets/logowithname.svg" class="logo" alt="logo" draggable="false">
  </picture>

  <!-- Top-left image -->
  <img src="assets/bottomleft.svg" class="bottom-left" alt="bottomleft" draggable="false">

  <!-- Bottom-right image -->
  <img src="assets/topright.svg" class="top-right" alt="topright" draggable="false">
  
  <form action="">
    <!-- Radios -->
    <div class="field caller-tabs" 
         style="display: flex; flex-direction: column; align-items: center; text-align: center; gap: 10px; margin-bottom: 80px;">

      <div class="radio-group">
        <div class="slider"></div>

        <input type="radio" name="caller" id="caller-student" value="student" hidden checked>
        <label for="caller-student">
          <span>Student</span>
          <img src="assets/student.png" alt="student" class="tabicon">
        </label>

        <input type="radio" name="caller" id="caller-parent" value="parent" hidden>
        <label for="caller-parent">
          <span>Parent</span>
          <img src="assets/parent.png" alt="parent" class="tabicon">
        </label>

        <input type="radio" name="caller" id="caller-staff" value="staff" hidden>
        <label for="caller-staff">
          <span>Staff</span>
          <img src="assets/staff.png" alt="staff" class="tabicon">
        </label>

        <input type="radio" name="caller" id="caller-general" value="general" hidden>
        <label for="caller-general">
          <span>General</span>
          <img src="assets/general.png" alt="general" class="tabicon">
        </label>
      </div>
    </div>

    <!-- Always visible -->
    <div class="field" id="index-field" style="display: flex; flex-direction: row; gap: 20px;">
      <div style="flex: 1 1 25%;">
        <div class="label">Index</div>
        <input type="text" id="indexInput" style="width: 100%;">
            <div style="flex: 1 1 25%;">
        <div class="label">Get Ticket #</div>
        <input type="text" id="ticketno" style="width: 100%;"> 
      </div>
      </div>
      <div style="flex: 1 1 25%;">
          <button type="button" data-bs-target="#StatusModal" data-bs-toggle="modal" id="btngetstdrecord" 
          style="padding: 8px; border: none; background: #EC8305; color: #fff; border-radius: 6px; cursor: pointer; margin-top: 25px; " >
          View Status
        </button>
        
      
      
      </div>
            <div style="flex: 1 1 35%;">
        <button type="button" data-bs-target="#StatusModal" data-bs-toggle=" " id="AcademicRecord"  onclick="submitStudentForm()" 
          style="padding: 8px; border: none; background: #EC8305; color: #fff; border-radius: 6px; cursor: pointer; margin-top: 25px;">
          Get Academic Rec.
        </button>

      </div>
    </div>
    
    <div class="flex">
      <div class="field" id="name-field">
        <div class="label">Name</div>
        <input type="text" id="name">
      </div>
      <div class="field" id="id-field">
        <div class="label">Staff ID</div>
        <input type="text" id="id">
      </div>
      <div class="field" id="parent-field">
        <div class="label">Phone</div>
        <input type="text" id="phone">
      </div>
    </div>
    
    <!-- Conditional fields -->
    <div class="flex">
      <div class="field" id="faculty-field">
        <div class="label">Faculty</div>
        <input type="text" id="facultyInput">
      </div>

      <div class="field" id="batch-field">
        <div class="label">Batch</div>
        <input type="text" id="batchInput">
      </div>

      <div class="field" id="major-field">
        <div class="label">Major</div>
        <input type="text" id="majorInput">
      </div>
    </div>
   
    <!-- Rest of your form -->
    <div class="field">
      <div class="label">Issue</div>
      <textarea id="issue" rows="4"></textarea>
    </div>
    <div class="field">
      <div class="label">Category</div>
      <select id="category">
        <option value="" selected></option>
        <option value="1">Data Follow and Verification</option>
        <option value="42">General Inquiries</option>
        <!-- Other options -->
      </select>
    </div>

    <div class="flex">
      <div class="field">
        <div class="label">Ticket Number</div>
        <input type="text" id="ticketNumber">
      </div>

      <div class="field">
        <div class="label">Ticket URL</div>
        <input type="text" id="ticketURL">
      </div>

      <div class="field">
        <div class="label">Found Status</div>
        <input type="text" id="foundStatus">
      </div>
    </div>
    
    <div class="flex">
      <div class="field">
        <div class="label">Priority</div>
        <input type="text" id="priority">
      </div>

      <div class="field">
        <div class="label">Assigned To</div>
        <input type="text" id="assignedTo">
      </div>
    </div>
    
    <div class="field">
      <div class="label">Final Status</div>
      <select id="finalStatus">
        <option value="" selected></option>
        <option value="1">Resolved</option>
        <option value="2">Submitted</option>
        <option value="3">Escalated</option>
      </select>
    </div>

    <div class="field">
      <div class="label">Solution Note</div>
      <textarea id="solutionNote" rows="5"></textarea>
    </div>

    <div class="btn" style="width: 100%;">
      <button type="submit">Submit Ticket</button>
    </div>
  </form>

  <!-- Modal -->
<div class="modal fade" id="StatusModal" tabindex="-1" aria-labelledby="StatusModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="StatusModalLabel" style="color: #EC8305;">Student Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" style="padding: 20px;">
        <p><b>Name:</b> <span id="studentName">         {{ session('name') }}    </span></p>
        <p><b>Major:</b> <span id="studentMajor"> {{ session('name') }}</span></p>
        <p><b>Batch:</b> <span id="studentBatch"> {{ session('batch') }}</span></p>
        <p><b>Semester:</b> <span id="studentSemester"> {{ session('semester') }}</span></p>
        <p><b>Status:</b> <span id="studentStatus"> {{ session('status') }}</span></p>
        
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
           
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Toggle Logic in JS -->
  <script>

  const radios = document.querySelectorAll('input[name="caller"]');
  const fields = {
    parent: document.getElementById("parent-field"),
    faculty: document.getElementById("faculty-field"),
    batch: document.getElementById("batch-field"),
    major: document.getElementById("major-field"),
    index: document.getElementById("index-field"),
    id: document.getElementById("id-field")
  };

  const labels = document.querySelectorAll(".radio-group label");
  const slider = document.querySelector(".slider");

  // Position slider behind the selected label
  function moveSliderTo(label) {
    const rect = label.getBoundingClientRect();
    const parentRect = label.parentElement.getBoundingClientRect();

    slider.style.width = rect.width + "px";
    slider.style.height = rect.height + "px";
    slider.style.transform = `translateX(${rect.left - parentRect.left}px)`;
  }

  // Show/hide fields based on selected role
  function updateVisibility(role) {
    // Hide all fields first
    Object.values(fields).forEach(f => f.style.display = "none");

    if (role === "student") {
      fields.faculty.style.display = "block";
      fields.batch.style.display = "block";
      fields.major.style.display = "block";
      fields.index.style.display = "flex";
    } 
    else if (role === "parent") {
      fields.parent.style.display = "block";
      fields.faculty.style.display = "block";
      fields.batch.style.display = "block";
      fields.major.style.display = "block";
      fields.index.style.display = "flex";
    } 
    else if (role === "staff") {
      fields.faculty.style.display = "block";
      fields.id.style.display = "block";
    } 
    else if (role === "general") {
      fields.parent.style.display = "block";
    }

    // Update active label + move slider
    document.querySelectorAll(".radio-group label").forEach(lbl => lbl.classList.remove("active"));
    const activeLabel = document.querySelector(`label[for="caller-${role}"]`);
    activeLabel.classList.add("active");
    moveSliderTo(activeLabel);
  }

  // Event listeners
  radios.forEach(r => r.addEventListener("change", e => updateVisibility(e.target.value)));

  // Initial position
  window.addEventListener("load", () => {
    const checked = document.querySelector('input[name="caller"]:checked');
    if (checked) {
      updateVisibility(checked.value);
    }
  });

  // Recalculate on resize
  window.addEventListener("resize", () => {
    const checked = document.querySelector('input[name="caller"]:checked');
    if (checked) {
      updateVisibility(checked.value);
    }
  });

  // Get student record function
  document.getElementById('btngetstdrecord').addEventListener('click', function() {
    const studentId = document.getElementById('indexInput').value;
    const ticketno= document.getElementById('ticketno').value;
    
    console.log(studentId);
     console.log(ticketno);
    if ((!studentId || studentId.trim() === "") && ticketno && ticketno.length > 0) {
      // Case 1: studentId is null/empty AND ticketId exists
      console.log('ticketno');
    get_ticket_records(ticketno);
    } else if (studentId && studentId.trim() !== "") {
      // Case 2: studentId has value
        console.log('studentId');
         getStudentRecord(studentId) 
    } else {
      // Case 3: neither provided
      alert("Please enter Std Id or TicketID");
    }
  }

  
 
    
  
    
  );

 
 function getStudentRecord(studentId) {
    // 🔹 إظهار Loader وإخفاء المحتوى
   //  document.getElementById('loader').style.display = 'block';
   //  document.getElementById('studentContent').style.display = 'none';

    fetch(`/get-student/${studentId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
           
            console.log("Jason Data:", data);
            
            // ✅ تعبئة النموذج
            document.getElementById('name').value = data.student.name || '';
            document.getElementById('facultyInput').value = data.student.faculty || '';
            document.getElementById('batchInput').value = data.student.batch || '';
            document.getElementById('facultyInput').value = data.student.faculty || '';
            document.getElementById('majorInput').value = data.student.major || '';
           
             document.getElementById('studentName').textContent = data.student.name || 'N/A';
            document.getElementById('studentMajor').textContent = data.student.major || 'N/A';
            document.getElementById('studentBatch').textContent = data.student.batch || 'N/A';
            document.getElementById('studentSemester').textContent = data.student.semester || 'N/A';
            document.getElementById('studentStatus').textContent = data.student.status || 'N/A';
        
        
          })
        .catch(error => {
            console.error('Error:', error);
          //  document.getElementById('loader').style.display = 'none';
          //  document.getElementById('studentContent').style.display = 'block';
            document.getElementById('studentName').textContent = "Error loading student";
        });
}
 function get_ticket_records(ticketno){
  
    fetch(`/search-ticket/${ticketno}`)
    
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
           
            console.log("Jason Data:", data.ticketNumber);
            
            // ✅ تعبئة النموذج
            //  document.getElementById('indexInput').value = data.student.stud_id || '';
            document.getElementById('name').value = data.student.stud_name || '';
            document.getElementById('facultyInput').value = data.student.faculty || '';
            document.getElementById('batchInput').value = data.student.batch || '';
            document.getElementById('facultyInput').value = data.student.faculty_code || '';
            document.getElementById('majorInput').value = data.student.major_code || '';
             document.getElementById('studentName').textContent = data.student.stud_name || 'N/A';
            document.getElementById('studentMajor').textContent = data.student.major_code || 'N/A';
            document.getElementById('studentBatch').textContent = data.student.batch || 'N/A';
            document.getElementById('studentSemester').textContent = data.student.curr_sem || 'N/A';
            document.getElementById('studentStatus').textContent = data.student.status_code || 'N/A';
            document.getElementById('ticketNumber').value=data.ticket.ticket_number || 'N/A';
      document.getElementById('ticketURL').value = data.ticket.ticket_url || 'N/A';
       document.getElementById('foundStatus').value = data.ticket.Ticket_status || 'N/A';
        document.getElementById('priority').value = data.ticket.priority || 'N/A';
         document.getElementById('assignedTo').value = data.ticket.opened_type || 'N/A';
       /*    ticketNumber
           ticketURL
           foundStatus
           priorit
           assignedTo
*/
           
        
          })
        .catch(error => {
            console.error('Error:', error);
          //  document.getElementById('loader').style.display = 'none';
          //  document.getElementById('studentContent').style.display = 'block';
            document.getElementById('studentName').textContent = "Error loading student";
        });

 }

  </script>



<form id="studentForm" action="{{ route('studentview') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="name" id="hiddenName">
    <input type="hidden" name="faculty" id="hiddenFaculty">
    <input type="hidden" name="batch" id="hiddenBatch">
    <input type="hidden" name="major" id="hiddenMajor">
</form>
<script> function submitStudentForm() {
    // Copy values from visible fields to hidden form inputs
    document.getElementById('hiddenName').value = document.getElementById('name').value;
    document.getElementById('hiddenFaculty').value = document.getElementById('facultyInput').value;
    document.getElementById('hiddenBatch').value = document.getElementById('batchInput').value;
    document.getElementById('hiddenMajor').value = document.getElementById('majorInput').value;

    // Submit the hidden form
    document.getElementById('studentForm').submit();
} 


</script>


</body>
</html>