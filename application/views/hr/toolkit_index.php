<style>
input {
  border: none;
}
textarea:focus, input:focus{
  outline: none;
}
.text-right {
  text-align: left; 
}
th{
  font-size:10px;
}
#content {
  padding: 30px;
}
.pagecontroller {
  margin: 5px;
}
.logo-9 i{
  font-size:80px;
  position:absolute;
  z-index:0;
  text-align:center;
  width:100%;
  left:0;
  top:-10px;
  color:#34495e;
  -webkit-animation:ring 2s ease infinite;
  animation:ring 2s ease infinite;
}
.logo-9 h1{
  font-family: 'Lora', serif;
  font-weight:600;
  text-transform:uppercase;
  font-size:40px;
  position:relative;
  z-index:1;
  color:#e74c3c;
  text-shadow: 3px 3px 0 #fff, -3px -3px 0 #fff, 3px -3px 0 #fff, -3px 3px 0 #fff;
}
.logo-9{
  position:relative;
} 
/*//side*/
.bar {
  float: left;
  width: 25px;
  height: 3px;
  border-radius: 4px;
  background-color: #4b9cdb;
}
.load-10 .bar {
  animation: loadingJ 2s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
}
@keyframes loadingJ {
  0%,
  100% {
    transform: translate(0, 0);
  }
  50% {
    transform: translate(80px, 0);
    background-color: #f5634a;
    width: 75px;
  }
}
.landscape-box {
  background:linear-gradient(#c2b8b9,#99b3e8);
  color:black;
  width: 300px;
  text-align:center;
  padding:10px;
  border-radius:15px 15px 15px 15px;
  transition: .4s transform;
  justify-content:center;
  margin:30px;
  display:flex;
}
.box:hover{
  transform: scale(1.1);
  box-shadow:2px 2px 35px black;
}
.box img{
  width:150px;
}
a{
  color:black;
}
.landscape-box h2{
  margin-right:20px;
}
.landscape-box:hover{
  transform : scale(1.1);
}
.circular_image {
  width: 60px;
  height: 80px;
  overflow: hidden;
  background-color: blue;
  display:inline-block;
  vertical-align:middle;
}
.nname{
  bottom:10px;
}
.circular_image img{
  width:50%;
}
.landscape-box:hover .div{
  display: block;
  color:black;
}
.landscape-box:hover .s_name{
  color:black;
}
.div {
  display: none;
}
#button{ 
  height: 100px;
  width: 200px;
  background-color: #80bfff;
  color: white;
  font: monospace;
  font-weight: bold;
  font-size: 20px;
  border-radius: 20px;
  border: 0px;
  transition: 1s ease-in-out;
}
#button:hover{
  background-color: white;
  color: black;
  border: 1px solid black;
}
#button a{
  color: white;
  font: monospace;
  font-weight: bold;
  font-size: 20px;
  text-decoration: none;
  transition: 0.5s ease-in-out;
}
#button:hover a{
  color:black;
}
#button.open {
  display:block;
}
pre {
  outline: 1px solid #ccc; 
  padding: 5px; 
  margin: 5px; 
  white-space: pre-wrap;       
  white-space: -moz-pre-wrap;  
  white-space: -pre-wrap;      
  white-space: -o-pre-wrap;    
  word-wrap: break-word;   
  background-color: white ! important;  
  word-break: keep-all; 
  color:black;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header" style="height:80px;">
    <div class="header-icon">
      <figure class="one">
        <img src="<?= base_url('assets/images/hrtoolkit.png'); ?>"  class="headshotphoto" style="height:50px;" />
      </figure>
    </div>
    <div class="header-title">
      <div class="logo-holder logo-9">
        <h1>Employee Hand Book</h1>
      </div>
      <small></small>
        <ol class="breadcrumb">
            <li><a href="#"> <i class="pe-7s-home"></i> <?= display('home') ?></a> </li>
            <li><a href="#"> <?= display('hrm') ?></a> </li>
            <li class="active" style="color:orange;"><?= ('Employee Hand Book') ?> </li>
            <div class="load-wrapp">
            <div class="load-10">
            <div class="bar"></div>
            </div></div>
        </ol>
    </div>
    </section>
    <!-- Main content -->

<section class="content" id="firstSection">
<div class="container" >
<div class="row">
<div class="col-sm-12" style="text-align:justify">
<pre>
<img src="<?= base_url($Web_settings[0]['logo']); ?>" width="10%"/>
<input type="hidden" value="<?= base_url($Web_settings[0]['logo']); ?>" id="logo"/>
<strong>Table of Contents</strong>
1.INTRODUCTION
1.1.Handbook Disclaimer
1.2.Welcome Message
1.3.Changes in Policy
2.GENERAL EMPLOYMENT
2.1.At-Will
2.2.Immigration Law Compliance
2.3.Equal Employment Opportunity
2.4.Employee Grievances
2.5.Internal Communication
2.6.Outside Employment
2.7.Ant-Retaliation and Whistleblower Policy
3.EMPLOYMENT STATE & RECORDKEEPING
3.1.Employment Classifications
3.2.Personnel Data Changes
3.3.Expense Reimbursement
3.4.Termination of Employment
4.WORKING CONDITIONS & HOURS
4.1.Company Hours
4.2.Emergency Closing
4.3.Parking
4.4.Workplace Safety
4.5.Security
4.6.Meal & Break Periods
4.7.Break Time for Nursing Mothers
5.EMPLOYEE BENEFITS
5.1.Holidays
5.2.Paid Time Off (PTO)
5.3.Military Leave
5.4.Jury Duty
5.5.Workers’ Compensation
6.EMPLOYEE CONDUCT
6.1.Standards of Conduct
6.2.Disciplinary Action
6.3.Confidentiality
6.4.Workplace Violence
6.5.Drug & Alcohol Use
6.6.Sexual & Other Unlawful Harassment
6.7.Telephone Usage
6.8.Personal Property
6.9.Use of Company Property
6.10 Smoking
6.11 Visitors in the Workplace
6.12 Computer, Email & Internet Usage
     <hr>
6.13 Company Supplies
7.TIMEKEEPING & PAYROLL
7.1.Attendance & Punctuality
7.2.Timekeeping
7.3.Paydays
7.4.Payroll Deductions
<strong>Introduction</strong>
<b>Handbook Disclaimer</b>
The contents of this handbook serve only as guidelines and supersede any prior handbook. Neither this handbook, nor any other policy or practice, creates an employment contract, or an implied or express promise of continued employment with the organization. Employment with <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> is “AT-WILL.”  This means employees of  <span class="c_name"><?= $this->session->userdata('company_name'); ?></span>  may terminate the employment relationship at any time,  for any reason, with or without cause or advance notice. As an at-will employee,it is not guaranteed, in any manner, that you will be employed with <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> for any set period of time.
This handbook may provide a summary of employee health benefits, however actual coverage will be determined by the express terms of the benefit plan documents. If there are any conflicts between the handbook or summaries provide and the plan documents, the plan documents will control.The organization reserves the right to amend, interpret, modify or terminate any of its employee benefits programs without prior notice to the extentallowed by law.
The organization also has the right, with or without notice, in an individual case or generally, to change any of the policies in this handbook,or any of its guidelines, policies, practices, working conditions or benefits at any time. No one is authorized to provide any employee with an employment contract or special arrangement concerning terms or conditions of employment unless the contract or arrangement is in writing and signed by the president and the employee.
Welcome Message
Dear Valued Employee,
Welcome to <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> is committed to providing superior quality and unparalleled customer service in all aspects of our business. We believe each employee contributes to the success and growth of our organization.
This employee handbook contains general information on our policies, practices, and benefits. Please read it carefully. If you have questions regarding the handbook, please discuss them with your supervisor or the owner.
Welcome aboard. We look forward to working with you!
Sincerely,
The Owner
  <hr>
<b>Changes in Policy</b>
Change at <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span>   is inevitable. Therefore, we expressly reserve the right to interpret, modify, suspend, cancel, or dispute, all or any part of our policies, procedures, and benefits at any time with or without prior notice. Changes will be effective on the dates determined by <span  class="c_name"><?=
$this->session->userdata('company_name'); ?></span>, and after those dates all superseded policies will be null and void. No individual supervisor or manager has the authority to alter the foregoing. Any employee who is unclear or any policy or procedure should consult a supervisor or the owner.
<strong>General Employment</strong>
<b>At- Will Employment</b>
Employment with <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> is “at-will”. This means employees are free to resign at any time, with or without cause, and <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> may terminate the employment relationship at any time,with or without cause or advance notice. As an at-will employee, it is not guaranteed, in any manner, that you will be employed with <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> for any set period of time.
The policies set forth in this employee handbook are the policies that are in effect at the time of publication. They may be amended, modified, or terminated at any time by <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span>, except for the policy on at-will employment, which may be modified only by a signed, written agreement between the President and the employee at issue. Nothing in this handbook may be construed as creating a promise of future benefits or a binding contract between <span class="c_name"><?= $this->session->userdata('company_name'); ?></span> and any of its employees.
<b>Immigration Law Compliance</b>
<span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> is committed to employing only United States citizens and aliens who are authorized to work in the United States.
In compliance with the Immigration Reform and Control Act of 1986, as amended, each new employee, as a condition of employment, must complete the Employment Eligibility Verification Form I-9 and present documentation establishing identity and employment eligibility. Former employees who are rehired must also complete the form if they have no completed and I-9 with <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> within the past three years, or if their previous I-9 is no longer retained or valid.
<span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> may participate in the federal government’s electronic verification system, known as “E-Verify.” Pursuant to E-Verify, <span class="c_name"><?= $this->session->userdata('company_name'); ?></span> provides the Social Security Administration, and if necessary, the Department of Homeland Security with information from each new employee’s form I-9 to confirm work authorization.
<b>Equal Employment Opportunity</b>
<span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> is an Equal Opportunity Employer. Employment opportunities at <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> are based upon one’s qualifications and capabilities to perform the essential functions of a particular job. All employment opportunities are provided without regard to race, religion, sex (including sexual orientation and transgender status), pregnancy, childbirth or related medical conditions, national origin, age, veteran status, disability, genetic information, or any other characteristic protected by law.
<hr>
This Equal Employment Opportunity policy governs all aspects of employment, including, but not limited to,recruitment, hiring, selection, job assignment, promotions, transfers, compensation, discipline, termination,layoff, access to benefits and training, and all other conditions and privileges of employment.
The organization will provide reasonable accommodations as necessary and where required by law so long as the accommodation does not pose an undue hardship on the business. The organization will also accommodate sincerely held religious beliefs of its employees to the extent the accommodation does not pose an undue hardship on the business. If you would like to request an accommodation, or have any questions about your rights and responsibilities, contact your owner. This policy is not intended to afford employees with any greater protections than those which exist under federal, state or local law.
<span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> strongly urges the reporting of all instances of discrimination and harassment, and prohibits retaliation against any individual who reports, discrimination, harassment, or participates in an investigation of such report. <span class="c_name"><?= $this->session->userdata('company_name'); ?></span> will take appropriate disciplinary action, up to and including immediate termination, against any employee who violates this policy.
<b>Employee Grievances</b>
It is the policy of <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> to maintain a harmonious workplace environment. <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> encourages its employees to express concerns about work-related issues, including workplace communication, interpersonal conflict, and other working conditions. Employees are encouraged to raise concerns with their supervisors. If not resolved at this level, an employee may submit, in writing, a signed grievance to the owner.
After receiving a written grievance, <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> may hold a meeting with the employee, the immediate supervisor, and any other individuals who may assist in the investigation or resolution of the issue. All discussions related to the grievance will be limited to those involved with, and who can assist with,resolving the issue.
Complaints involving alleged discriminatory practices shall be processed in accordance with <span class="c_name"><?= $this->session->userdata('company_name'); ?></span>’S sexual and other unlawful harassment policy.
<span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> assures that all employees filing a grievance or complaint can do so without fear of retaliation or reprisal.
<b>Internal Communication </b>
Effective and ongoing communication with <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> is essential. As such, the organization maintains systems through which important information can be shared among employees and management.
Bulletin boards are posted in designated areas of the workplace to display important information and announcements. In addition, <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> uses the intranet and email to facilitate communication and share access to documents. For information on appropriate email and internet usage, employees may refer to the computer, email, and internet usage policy, to avoid confusion, employees should not post or remove and material from the bulletin boards.
All employees are responsible for checking internal communications on a frequent regular basis. Employees should consult their supervisor with any questions or concerns on information disseminated.
<hr>
<strong>Outside Employment</strong>
Employees may hold outside jobs as long as the employee meets the performance standards of their position with <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span>.Unless an alternative work schedule has been approved by <span  class="c_name"><?=$this->session->userdata('company_name'); ?></span>, employees will be subject to the organization’s scheduling demands, regardless of any existing outside working assignments; this includes availability for overtime when necessary.
<span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> property, office space, equipment, materials, trade secrets, and any other confidential information may not be used for any purposed relating to outside employment.
<b>Anti-retaliation and Whistleblower policy</b>
This policy is designed to protect employees address <span  class="c_name"><?=
$this->session->userdata('company_name'); ?></span>’S commitment to integrity and ethical behavior. Accordance
with anti-retaliation and whistleblower protection regulations, <span  class="c_name"><?=
$this->session->userdata('company_name'); ?></span> will not tolerate any retaliation against an employee who:
* Makes a good faith complaint, or threatens to make a good faith complaint, regarding the suspected
organization or employee violations of the law, including discriminatory or other unfair employment practices;
* Makes a good faith complaint, or threatens to make a good faith complaint, regarding accounting, internal
account controls, or auditing matters that may lead to incorrect, or misinterpretations in financial
accounting;
* Makes a good faith report, or threatens to make a good faith report, of a violation that endangers the
health or safety of an employee, patients, client or customer, environment or general public;
* Objects to, or refuses to participate in, any activity, policy or practice, which the employee reasonably
believes is a violation of the law;
* Provides information to assist in an investigation regarding violations of the law; or
* Files, testifies, participates or assists in a proceeding, action or hearing in relation to alleged
violations of the law.
Retaliation is defined as any adverse employment action against an employee, including, but not limited to,refusal to hire, failure to promote, demotion, suspension, harassment, denial of training opportunities,termination, or discrimination in any manner in the terms and conditions of employment.Anyone found to have engaged in retaliation or in violation of law, policy or practice will be subject to discipline, up to and including termination of employment. Employees who knowingly make a false report of a violation will be subject to disciplinary action, up to and including termination.Employees who wish to report a violation should contact their supervisor or Arul SreeKumar directly. Employees should also review their state and local requirements for any additional reporting guidelines.
<span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> will promptly and thoroughly investigate and, if necessary, address any reported violation. Employees who have any questions or concerns regarding this policy and related reporting requirements should contact their supervisor, the owner or any state or local agency responsible for investigating alleged violations.
<hr>
<b>Employment Status & Recordkeeping</b>
<b>Employment Classifications</b>
For purposed of salary administration and eligibility for overtime payments and employee benefits, <span class="c_name"><?= $this->session->userdata('company_name'); ?></span> classifies employees as either exempt or non-exempt. Non-exempt employees are entitled to overtime pay in accordance with federal and state overtime provisions. Exempt employees are exempt from federal and state overtime laws and, but for a few narrow exceptions, are generally paid a fixed amount of pay for each workweek in which work is performed. If you can change positions during your employment with <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> or if your job responsibilities change, you will be informed by the owner of any change in your exempt status. In addition to your designation of either exempt or non-exempt, you also belong to one of the following employment categories:
<b>Full-Time:</b>
Full-time employees are regularly scheduled to work greater or equal to 40 hours per week. Generally, regular full-time employees are eligible for <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span>’S	benefits, subject to the terms, conditions, and limitations of each benefit program.
<b>Part-Time:</b>
Part-time employees are regularly scheduled to work less than 40 hours per week. Regular part-time employees may be eligible for some <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> benefit programs, subject to the terms, conditions, and limitations of each benefit program.
<b>Temporary:</b>
Temporary employees include those hired for a limited time to assist in specific function or in the completion of a specific project. Temporary employees generally are not entitled to <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> benefits but are eligible for statutory benefits to the extent required by the law. Employment beyond any initially stated period does not in any way imply a change in employment status or classification. Temporary employees retain temporary status unless and until they are notified, by <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> management, of a change.
<b>Personnel Data Changes</b>
It is the responsibility of each employee to promptly notify their supervisor or the Owner of any changes in personnel data. Such changes may affect your eligibility for benefits, the amount you pay for benefit premiums, and your receipt of important company information.
If any of the following have changed or will change in the coming future, contact your supervisor or the owner as soon as possible:
-> Legal name
-> Mailing address
-> Telephone number (s)
-> Change of beneficiary
-> Exemptions on your tax forms
-> Emergency contact (s)
-> Training certificates
-> Professional licenses
<hr>
<strong>Expense Reimbursement </strong>
<span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> reimburses employees for necessary expenditures and reasonable costs incurred in the course of doing their jobs. Expense incurred by any employee must be approved in advance by the owner.
Some expenses that may warrant reimbursement include but are not limited to the following: mileage costs, air or ground transportation costs, lodging, meals for the purpose of carrying out company business, and any other reimbursable expenses as required by the law. employees are expected to make a reasonable effort to limit business expenses to economical options.
To be reimbursed, employees must submit expense reports to the owner for approval. the report must be accompanied by receipts or other documentation substantiating the expenses. Questions regarding this policy should be directed to your supervisor.
<b>Termination of Employment</b>
Termination of employment is an inevitable part of personnel activity within any organization.
<b>Notice of Voluntary Separation</b>
Employees who intend to terminate employment with <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> shall provide <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> with at least two weeks written notice. Such notice is intended to all the organization time to adjust to the employee’s departure without placing undue burden on those employees who may be required to fill in before a replacement can be found.
<b>Return of Company Property</b>
Any employee who terminated employment with <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> shall return all files, records, keys, and any other materials that are the property of <span  class="c_name"><?= $this->session->userdata('company_name');?></span> prior to their last date of employment.
<b>Final Pay</b>
<span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> will provide employees with their final pay in accordance with applicable federal, state and local laws.
<b>Benefits Upon Termination </b>
All accrued and/or vested benefits that are due and payable at termination will be paid in accordance with applicable federal, state and local laws.
Certain benefits, such as healthcare coverage, may continue at the employee’s expense, if the employee elects to do so <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> will notify employees of the benefits that may be continued and of the terms, conditions, and limitations of such continuation.
If you have and questions or concerns regarding this policy, contact <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span>’S owner.
<hr>
<strong>Working Conditions & Hours</strong>
<b>Company Hours</b>
<span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> is open for business from
* Monday 7 AM to 5 PM
* Tuesday 7 AM to 5 PM
* Wednesday 7 AM to 5 PM
* Thursday 7 AM to 5 PM
* Friday 7 AM to 5 PM
* Saturday 9 AM to 2 PM
This excludes holidays recognized by <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span>. The standard workweek is 40 hours.
Supervisors will advise employees of their scheduled shift, including starting and ending times. Business needs may necessitate a variation in your starting and ending times as well as in the total hours you may be scheduled to work each day and each week.
<b>Emergency Closing</b>
At times, emergencies such as severe weather, fires, or power failures can disrupt company operations. In extreme cases, these circumstances may require the closing of a work facility. The decision to close or delay regular operations will be made by <span  class="c_name"><?= $this->session->userdata('company_name'); ?></span> management.
<br><br><br>
</pre>
<br><br><br>
</div>
</div>
</div>
<br><br><br>
</section>
</div>

<?php
$modaldata['bootstrap_modals'] = array('generatedownload');
$this->load->view('include/bootstrap_modal', $modaldata);
?>

<script>
$(document).ready(function() {
    downloadPagesAsPDF();
});

async function downloadPagesAsPDF() {
    $('#generatedownload').modal('show');
    const elements = [
        document.getElementById('firstSection'),
    ];
    await generatePDF(elements);
}

async function generatePDF(elements) {
    try {
        const canvases = await Promise.all(elements.map(element =>
            html2canvas(element, { 
                scale: 3, 
                useCORS: true 
            })
        ));

        const pdf = new jspdf.jsPDF({
            orientation: 'p',
            unit: 'pt', 
            format: [canvases[0].width, canvases[0].height]
        });

        canvases.forEach((canvas, index) => {
            const imgData = canvas.toDataURL('image/jpeg', 1.0); 
            if (index > 0) {
                pdf.addPage([canvas.width, canvas.height], 'p');
            }
            pdf.addImage(imgData, 'JPEG', 0, 0, canvas.width, canvas.height);
        });

        $('#generatedownload').modal('hide');
        pdf.save('Handbook.pdf');
        window.location.href = "<?= base_url('Chrm/manage_employee?id=' . $_GET['id'] . '&admin_id=' . $_GET['admin_id']); ?>";

    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('An error occurred while generating the PDF. Please try again.');
        $('#generatedownload').modal('hide');
    }
}

</script>