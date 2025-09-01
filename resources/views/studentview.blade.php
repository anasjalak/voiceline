<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        .student-card {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: none;
            margin: 20px auto;
            max-width: 900px;
        }
        .card-header {
            background-color: #fff;
            border-bottom: 2px solid #EC8305;
            padding: 15px 20px;
        }
        .card-title {
            color: #EC8305;
            font-weight: bold;
            margin: 0;
        }
        .card-body {
            padding: 20px;
        }
        .info-item {
            margin-bottom: 10px;
            font-size: 16px;
        }
        .info-item b {
            color: #495057;
        }
        .table-title {
            color: #495057;
            margin-top: 25px;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 17px;
        }
        .table thead th {
            background-color: #f8f9fa;
            color: #EC8305 !important;
            font-weight: 600;
        }
        .close-btn {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 5px 15px;
            color: #6c757d;
            transition: all 0.3s;
        }
        .close-btn:hover {
            background-color: #EC8305;
            color: white;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 500;
        }
        .status-active {
            background-color: #d4edda;
            color: #155724;
        }
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
        @media (max-width: 768px) {
            .student-card {
                margin: 10px;
            }
        }
    </style>
</head>
<body>

<div class="card student-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title"><i class="bi bi-person-badge me-2"></i>Std Status</h5>
        <button class="close-btn" onclick="window.history.back()">
            <i class="bi bi-x-lg me-1"></i>Close
        </button>
    </div>
    <div class="card-body">
        <div class="info-item"><b>Name:</b> <span id="studentName"> {{ session('student_name') }}</span></div>
        <div class="info-item"><b>Major:</b> <span id="studentMajor">{{ session('major') }}</span></div>
        <div class="info-item"><b>Batch:</b> <span id="studentBatch">{{ session('batch')  }}</span></div>
        <div class="info-item"><b>Sem:</b> <span id="studentSemester">{{ session('semester')  }}</span></div>
        <div class="info-item"><b>Status:</b> <span id="studentStatus" class="status-badge status-active">{{ session('status')  }}</span></div>
        
        <!-- جدول المواد -->
        <div class="table-title">(F/Z/I) Courses:</div>
        <div class="table-responsive">
            <table class="table table-bordered table-sm align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="color: #EC8305;">Sem</th>
                        <th style="color: #EC8305;">Crs Name</th>
                        <th style="color: #EC8305;">Grades</th>
                        <th style="color: #EC8305;">Notes</th>
                    </tr>
                </thead>
                <tbody id="studentSubjectsTable">
                    <tr>
                        <td>الأول</td>
                        <td>برمجة 1</td>
                        <td>F</td>
                        <td>محولة</td>
                    </tr>
                    <tr>
                        <td>الثاني</td>
                        <td>هياكل البيانات</td>
                        <td>I</td>
                        <td>غير مكتملة</td>
                    </tr>
                    <tr>
                        <td>الثالث</td>
                        <td>قواعد البيانات</td>
                        <td>Z</td>
                        <td>محذوفة</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- جدول التذاكر -->
        <div class="table-title">التذاكر الحديثة:</div>
        <div class="table-responsive">
                    <!-- جدول التذاكر -->
        <div class="table-title">التذاكر الحديثة:</div>
        <div class="table-responsive">
                      <table class="table table-bordered table-sm align-middle">
              <thead class="table-light">
                <tr>
                  <th style="color: #EC8305;">ticket_number</th>
                  <th style="color: #EC8305;">Ticket_status</th>
                  <th style="color: #EC8305;">ticket_url</th>
                  <th style="color: #EC8305;">opened_type</th>
                </tr>
              </thead>
              <tbody>
        @if(session()->has('tickets'))
        @foreach(session('tickets') as $ticket)
            <tr>
                <td>{{ $ticket->ticket_number ?? '-' }}</td>
                <td>{{ $ticket->ticket_category ?? '-' }}</td>
                <td>{{ $ticket->opened_type ?? '-' }}</td>
                <td>{{ $ticket->ticket_url ?? '--' }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4">No courses found</td>
        </tr>
    @endif
    </tbody>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // فرضاً هنا بتحصل على ID من الـ URL (مثال: /student-view.html?stud_id=1)
        const urlParams = new URLSearchParams(window.location.search);
        const studentId = urlParams.get("stud_id") || 1; // افتراضي 1
alert(${studentId});
        fetch(`/get-student/${studentId}`)
            .then(response => {
                if (!response.ok) throw new Error("Student not found");
                return response.json();
            })
            .then(data => {
                // بيانات الطالب
                document.getElementById("studentName").textContent = data.student.name;
                document.getElementById("studentMajor").textContent = data.student.major;
                document.getElementById("studentBatch").textContent = data.student.batch;
                document.getElementById("studentSemester").textContent = data.student.semester;

                const statusEl = document.getElementById("studentStatus");
                statusEl.textContent = data.student.status;
                statusEl.className = "status-badge " + (data.student.status === "نشط" ? "status-active" : "status-inactive");

                // جدول المواد
                const subjectsTable = document.getElementById("studentSubjectsTable");
                subjectsTable.innerHTML = "";
                if (data.subjects.length > 0) {
                    data.subjects.forEach(sub => {
                        const row = `<tr>
                            <td>${sub.semester}</td>
                            <td>${sub.course}</td>
                            <td>${sub.grade}</td>
                            <td>${sub.remark}</td>
                        </tr>`;
                        subjectsTable.innerHTML += row;
                    });
                } else {
                    subjectsTable.innerHTML = `<tr><td colspan="4" class="text-center">لا توجد مواد</td></tr>`;
                }

                // جدول التذاكر
                const ticketsTable = document.getElementById("studentTicketsTable");
                ticketsTable.innerHTML = "";
                if (data.tickets.length > 0) {
                    data.tickets.forEach(t => {
                        const row = `<tr>
                            <td>#${t.id}</td>
                            <td>${t.category}</td>
                            <td>${t.status}</td>
                            <td>${t.priority}</td>
                        </tr>`;
                        ticketsTable.innerHTML += row;
                    });
                } else {
                    ticketsTable.innerHTML = `<tr><td colspan="4" class="text-center">لا توجد تذاكر</td></tr>`;
                }
            })
            .catch(err => {
                alert("خطأ: " + err.message);
            });
    });
</script>



</body>
</html>