
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Multi Step Form | CodingNepal</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
      #summary p { margin: 4px 0; }
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
    <div class="container">
      <div class="progress-bar">
        <div class="step">
          <p>Student Details</p>
          <div class="bullet">
            <span>1</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Concern</p>
          <div class="bullet">
            <span>2</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Solution</p>
          <div class="bullet">
            <span>3</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Submit</p>
          <div class="bullet">
            <span>4</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
      </div>
      <div class="form-outer">
        <form action="#">

          <!----------------------------------------------- student details ---------------------------------------------->
          <div class="page slide-page">
            <!-- <div class="title">Basic Info:</div> -->

       
    

       <div class="flex">


        <div class="field">
          <div class="label">Full Name</div>
          <input type="text"id="studentName">
        </div>

        <div class="field">
          <div class="label">Student index</div>
          <input type="text" id="index">
        </div>

        
       </div>

       <div class="flex">


        <div class="field">
          <div class="label">faculty</div>
          <input type="text" id="faculty">
        </div>

        <div class="field">
          <div class="label">Batch</div>
          <input type="text"id="batch">
        </div>
       
        
       </div>


       <div class="flex">
        <div class="field">
          <div class="label">Major</div>
          <input type="text"id="major">
        </div>
       </div>
           
           <div class="flex">
            <div class="field">
              <button class="firstNext next" style="width: 100%;">Next</button>
            </div>
           </div>
           
          </div>
  <!----------------------------------------------- Concern details ---------------------------------------------->
          <div class="page">
          
            <div class="flex">
            
              
                <div class="field">
                  <div class="label" style="text-align: start;"> Issue </div>
                  <textarea name="note" rows="4" cols="80" id="issue"></textarea>
                </div>
                
                <div class="field">
                <div class="label">Category</div>
               
                <select name="your-select-name" id="category">
                     <option value="" selected></option>
                  <option value="1" >Data Follow and Verification</option>
                  <option value="42">General Inquiries (Non active students)</option>
                  <option value="3">Finance</option>
                  <option value="2">Certificates and statements</option>
                  <option value="14" >E-Learning</option>
                  <option value="28">Update Ministry Graduates List</option>
                  <option value="16">CESD / CTS (Staff only)</option>
                  <option value="43">Human Resources (Staff Only)</option>
                  <option value="24">Reports</option>
                  <option value="23">Higher management</option>
                  <option value="30">External Transfer &amp; Elevation </option>
                  <option value="31">New Admission - القبول الجديد</option>
                  <option value="32">Faculty of Geoinformatics</option>
                  <option value="33">Faculty of Fine Arts and Interior Design</option>
                  <option value="34">Faculty of Architecture</option>
                  <option value="35">Faculty of Telecommunication and Space Technology</option>
                  <option value="37">Faculty of Information Technology</option>
                  <option value="38">Faculty of Engineering</option>
                  <option value="39">Faculty of Computer Sciences</option>
                  <option value="40">Faculty of Business Administration</option>
                  <option value="41">Faculty of Postgraduate Studies</option>
                  <option value="44">BetterU Service</option>
                  <option value="45">Technology horizon journal (THJ)</option>
                </select>
                </div>
              </div>
            
          
      
             <div class="flex">
               <div class="field">
                <div class="label">Ticket Number</div>
                <input type="text"id="ticketNumber">
              </div>
      

              <div class="field">
                <div class="label">Ticket URL</div>
                <input type="text" id="ticketURL">
              </div>
              
             </div>
      
             <div class="flex">
              <div class="field">
                <div class="label">Found status</div>
                <input type="text" id="foundStatus">
              </div>
              <div class="field">
                <div class="label">Priorety</div>
                <input type="text"id="priority">
              </div>
    
           
             </div>
      <div class="flex">
        <div class="field">
          <div class="label">Assigned to</div>
          <input type="text"id="assignedTo">
        </div>
      </div>
      
             <div class="flex" style="margin-top: 0px;">
              <div class="field btns">
                <button class="prev-1 prev">Previous</button>
                <button class="next-1 next">Next</button>
              </div>
             </div>
           
          </div>



          <!----------------------------------------------- solution details ---------------------------------------------->

          <div class="page">
            <div class="flex" style="justify-content: start;justify-items: start;align-items: start;">
              <div class="field">
                <div class="label"> Final Status </div>
              <select id="finalStatus">
                   <option value="" selected></option>
                <option value="1">Resolved</option>
                <option value="2">Submited</option>
                <option value="3">Escalated</option>



              </select>
              </div>
              </div>
  
          
<div class="flex" style="justify-content: start;justify-items: start;align-items: start;margin-top: 0px;">
  <div class="label"style="margin-left:0px;">Note</div>
</div>
      
<div class="flex" style="margin-top: 0px; justify-content: start; align-items: flex-start;">

  <textarea id="solutionNote"name="note" rows="5" cols="100" style="display: block; width: 100%; max-width: 100%;"></textarea>
</div>

      
             <div class="flex" style="margin-top: -30px;">
              <div class="field btns">
                <button class="prev-2 prev">Previous</button>
                <button class="next-2 next">Next</button>
              </div>
             </div>
          </div>

<div class="page">
 
  <div id="summary"></div>
  
   <div class="flex" style="margin-top: 0px;">
  <div class="field btns">
    <button class="prev-3 prev">Previous</button>
    <button type="submit" class="submit">Submit</button>
  </div></div>
</div>
        </form>
      </div>
    </div>
    <script src="/js/script.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
  const summaryDiv = document.getElementById("summary");

  // Button that leads to summary page
  const toSummaryBtn = document.querySelector(".next-2");

  toSummaryBtn.addEventListener("click", () => {
    // Collect values
   
    const studentName = document.getElementById("studentName").value;
    const index = document.getElementById("index").value;
    const faculty = document.getElementById("faculty").value;
    const batch = document.getElementById("batch").value;
    const major = document.getElementById("major").value;

    const issue = document.getElementById("issue").value;
    const categorySelect = document.getElementById("category");
  const category = categorySelect.options[categorySelect.selectedIndex].text;
    const ticketNumber = document.getElementById("ticketNumber").value;
    const ticketURL = document.getElementById("ticketURL").value;
    const foundStatus = document.getElementById("foundStatus").value;
    const priority = document.getElementById("priority").value;
    const assignedTo = document.getElementById("assignedTo").value;

     const finalStatusSelect = document.getElementById("finalStatus");
  const finalStatus = finalStatusSelect.options[finalStatusSelect.selectedIndex].text;

    const solutionNote = document.getElementById("solutionNote").value;

    // Build summary HTML
    summaryDiv.innerHTML = `
      <h3>Call Summery</h3>
      <p><strong>Student Name:</strong> ${studentName}</p>
      <p><strong>Index:</strong> ${index}</p>
      <p><strong>Faculty:</strong> ${faculty}</p>
      <p><strong>Batch:</strong> ${batch}</p>
      <p><strong>Major:</strong> ${major}</p>
      <p><strong>Issue:</strong> ${issue}</p>
      <p><strong>Category:</strong> ${category}</p>
      <p><strong>Ticket Number:</strong> ${ticketNumber}</p>
      <p><strong>Ticket URL:</strong> ${ticketURL}</p>
      <p><strong>Found Status:</strong> ${foundStatus}</p>
      <p><strong>Priority:</strong> ${priority}</p>
      <p><strong>Assigned To:</strong> ${assignedTo}</p>
      <p><strong>Final Status:</strong> ${finalStatus}</p>
      <p><strong>Note:</strong> ${solutionNote}</p>
    `;
  });
});

</script>
  </body>
</html>
