<!-- Main Wrape Section End Here -->

<!-- ===================================== 

Bootstrap Main

========================================-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script src="{{ url('public/frontEnd/staff/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url('public/frontEnd/staff/js/jquery.min.js') }}"></script>

    <script src="{{ url('public/frontEnd/staff/js/jquery.beefup.min.js') }}"></script>

  

<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" />



  <!-- BOOTSTRAP SCRIPT CDN -->

    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  

  <!-- DATEPICKER SCRIPT CDN -->

  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />





  <script>

   

        $('.time_picker').timepicker();

      $('.date_picker').datepicker({

            dateFormat: 'mm/dd/yyyy',

            onSelect: function(dateText){

                var select_date = $('#select-date').val();

            }

        });



    function creatNewRota() {

      var formOne = document.getElementById('createRota');

      var formTwo = document.getElementById('copyRota');

      if (formOne.style.display == "none") {

          formOne.style = "none";

        formTwo.style = "none";

        formOne.style.display = "block";

        formTwo.style.display = "none";

    }

    }



    function copyNewRota() {

      var formOneRota = document.getElementById('createRota');

      var formTwoRota = document.getElementById('copyRota');

      if (formTwoRota.style.display == "none") {

        formOneRota.style = "none";

        formTwoRota.style = "none";

        formTwoRota.style.dispaly = "block";

        formOneRota.style.display = "none";

      }

    }

    function hide() {

            var modal_one = document.getElementById('show');

            var modal_two = document.getElementById('hide');

            if (modal_two.style.display === "none") {

                modal_two.style.display = "block";

                modal_one.style.display = "none";

            } else {

                modal_two.style.display = "none";

                modal_one.style.display = "block";

            }

        }

        function back_Modal() {

            var modal_one = document.getElementById('show');

            var modal_two = document.getElementById('hide');

            if (modal_two.style.display === "block") {

                modal_two.style.display = "none";

                modal_one.style.display = "block";

            } else {

                modal_two.style.display = "none";

                modal_one.style.display = "block";

            }

        }

        function multiEmployees() {

            var formstep = document.getElementById('multiForm');

            var canclestep = document.getElementById('multiEmployee');

            if (formstep.style.display === "none") {

                formstep.style.display = "block";

                canclestep.style.display = "none";

            } else {

                formstep.style.display = "none";

                canclestep.style.display = "block";

            }

        }

        

        function closeMultiEmployee() {

            var formstep = document.getElementById('multiForm');

            var canclestep = document.getElementById('multiEmployee');

            if (formstep.style.display === "block") {

                formstep.style.display = "none";

                canclestep.style.display = "block";

            }

        }

        function next(id) {

            let bg = document.getElementById('bg' + id.count)

            let currentForm = document.getElementById(id.form + id.count);

            let nextForm = document.getElementById(id.form + parseInt((id.count + 1)));

            setTimeout(() => {

                currentForm.style.display = 'none';

                nextForm.style.display = 'block';

                bg.style = 'none';

            }, 200);

        }



        function back(id) {

            let bg = document.getElementById('bg' + parseInt(id.count - 1))

            let currentForm = document.getElementById(id.form + id.count);

            let prevForm = document.getElementById(id.form + parseInt((id.count - 1)));

            setTimeout(() => {

                currentForm.style.display = 'none';

                prevForm.style.display = 'block';

                bg.style.color = '#999';

                bg.style.backgroundColor = '#fff';

            }, 200);

        }

  </script>

</body>

<script>

    // Open single

        $('.example-opensingle').beefup({

            openSingle: true,

            stayOpen: 'last'

        });

        </script>

    <script>

         function openNav(event) {
            event.stopPropagation();
            document.getElementById("mySidepanel").classList.add('remove_add');
        }

        function closeNav() {
            document.getElementById("mySidepanel").classList.remove('remove_add');
        }
        
        window.onclick = function(event) {
            closeNav();
        }

    </script>

<script>

        var count = 0;

        var addRecordHtml =

            `<div class="employees-no">

            <div>

                <h5>New records <span>()</span></h5>

            </div>

            </div>

            <form class="row employees-data" onsubmit="return validateform()">

            <div class="form-group col-md-2">

            <label for="firstName">First name</label>

          <input type="text" class="form-control" id="firstName"

          aria-describedby="emailHelp" placeholder="First name">

          <p id="nameError"></p>

          </div>

          <div class="form-group col-md-2">

          <label for="lastName">Last name</label>

          <input type="text" class="form-control" id="lastName"

          placeholder="Last name">

          <p id="lastNamError"></p>

          </div>

          <div class="form-group col-md-2">

                <label for="emailAdd">Email</label>

                <input type="email" placeholder="Email" class="form-control"

                    id="emailAdd" value="">

                    <p id="emailError"></p>

            </div>

            <div class="form-group col-md-2">

                <label id="firstDate" class="form-check-label">Employment start

                date</label>

                <input type="date" class="form-control" id="firstDate">

                <p id="startDate"></p>

                </div>

                <div class="form-group col-md-2">

                <label id="employType" class="form-check-label">Employee

                type</label>

                <input type="type" class="form-control" placeholder="Select type"

                id="employType">

                <p id="employTypeError"></p>

                </div>

                <div

                class="form-group col-md-2 d-flex align-items-center justify-content-center">

                <button type="submit" id="saveBtn" class="save-btn">Save</button>

                <!--<button type="button" class="delete-btn"></button> -->

                <!-- Button trigger modal -->

                <button type="button" id="deltBtn" class="delete-btn" data-toggle="modal" data-target="#exampleModal">

                <i class="fa fa-trash-o" aria-hidden="true"></i>

                </button>



                <!-- Modal -->

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog" role="document">

                            <div class="modal-content">

                            <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                            </button>

                            </div>

                            <div class="modal-body">

                            ...

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                <button type="button" class="btn btn-primary">Save changes</button>

                                </div>

                                </div>

                        </div>

                        </div>

                        </div>

        </form>`

        var addNewEmpolyeeForm = `

        <form class="row employees-data" onsubmit="return validateform()">

        <div class="form-group col-md-2">

                <input type="text" class="form-control" id="firstName"

                aria-describedby="emailHelp" placeholder="First name">

                <p id="nameError"></p>

            </div>

            <div class="form-group col-md-2">

                <input type="text" class="form-control" id="lastName"

                placeholder="Last name">

                <p id="lastNamError"></p>

                </div>

            <div class="form-group col-md-2">

            <input type="email" placeholder="Email" class="form-control"

            id="emailAdd" value="">

            <p id="emailError"></p>

            </div>

            <div class="form-group col-md-2">

                <input type="date" class="form-control" id="firstDate">

                <p id="startDate"></p>

            </div>

            <div class="form-group col-md-2">

                <input type="type" class="form-control" placeholder="Select type"

                id="employType">

                <p id="employTypeError"></p>

                </div>

                <div

                class="form-group col-md-2 d-flex align-items-center justify-content-center">

                <button type="submit" id="saveBtn" class="save-btn">Save</button>

                <button type="button" id="deltBtn" class="delete-btn"><i

                class="fa fa-trash-o" aria-hidden="true"></i></button>

                </div>

                </form>`

                function addNewEmploye() {

            var newRecords = document.getElementById('showDiv')

            if (count === 0) {

                newRecords.innerHTML += addRecordHtml;

                count++;

            } else {

                newRecords.innerHTML += addNewEmpolyeeForm;

            }

        }

    </script>

    <script>

        function next(id) {

            let bg = document.getElementById('bg' + id.count)

            let currentForm = document.getElementById(id.form + id.count);

            let nextForm = document.getElementById(id.form + parseInt((id.count + 1)));

            setTimeout(() => {

                currentForm.style.display = 'none';

                nextForm.style.display = 'block';

                bg.style = 'none';

            }, 200);

        }

        

        function back(id) {

            let bg = document.getElementById('bg' + parseInt(id.count - 1))

            let currentForm = document.getElementById(id.form + id.count);

            let prevForm = document.getElementById(id.form + parseInt((id.count - 1)));

            setTimeout(() => {

                currentForm.style.display = 'none';

                prevForm.style.display = 'block';

                bg.style.color = '#999';

                bg.style.backgroundColor = '#fff';

            }, 200);

        }

        

        </script>

    <script>

        let firstName = document.getElementById('firstName');

        let lastName = document.getElementById('lastName');

        let emailAdd = document.getElementById('emailAdd');

        let firstDate = document.getElementById('firstDate');

        let employType = document.getElementById('employType');

        let next1 = document.getElementById('next1');

        let saveBtn = 1;



        function validateform() {

            if (firstName.value == "") {

                document.getElementById('nameError').innerHTML = "Name is empty!";

                saveBtn = 0;

            } else if (firstName.value.length < 2) {

                document.getElementById('nameError').innerHTML = "Name is must be two char!";

                saveBtn = 0;

            } else {

                document.getElementById('nameError').innerHTML = "";

                saveBtn = 1;

            }

            

            if (lastName.value == "") {

                document.getElementById('lastNamError').innerHTML = "Last name is empty!"

                saveBtn = 0;

            } else if (lastName.value.length < 2) {

                document.getElementById('lastNamError').innerHTML = "Last name must be two char!"

                saveBtn = 0;

            } else {

                document.getElementById('lastNamError').innerHTML = ""

                saveBtn = 1;

            }



            if (emailAdd.value == "") {

                document.getElementById('emailError').innerHTML = "email is required!";

            } else {

                document.getElementById('emailError').innerHTML = ""

            }

            

            if (firstDate.value == "") {

                document.getElementById('startDate').innerHTML = "Date is required!";

            } else {

                document.getElementById('startDate').innerHTML = ""

            }

            

            if (employType.value == "") {

                console.log("right");

            } else {

                document.getElementById('employTypeError').innerHTML = ""

            }

            

            if (saveBtn) {

                return true;

                // saveBtn.setAttribute('disabled');

            } else {

                return false;

            }

        }

    </script>

<script>



    mobiscroll.setOptions({

        theme: 'ios',

        themeVariant: 'light'

    });

    

    var now = new Date(),

    week = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 6);

    

    mobiscroll.datepicker('#demo-mobile-picker-input', {

        controls: ['calendar'],

    select: 'range',

    showRangeLabels: true

});



var instance = mobiscroll.datepicker('#demo-mobile-picker-button', {

    controls: ['calendar'],

    select: 'range',

    showRangeLabels: true,

    showOnClick: false,

    showOnFocus: false,

});



instance.setVal([now, week]);



mobiscroll.datepicker('#demo-mobile-picker-mobiscroll', {

    controls: ['calendar'],

    select: 'range',

    showRangeLabels: true

});



var inlineInst = mobiscroll.datepicker('#demo-mobile-picker-inline', {

    controls: ['calendar'],

    select: 'range',

    showRangeLabels: true,

    display: 'inline',

});



inlineInst.setVal([now, week]);



document

    .getElementById('show-mobile-date-picker')

    .addEventListener('click', function () {

        instance.open();

        return false;

    });

    

    mobiscroll.datepicker('#demo-mobile-picker-input', {

        controls: ['calendar'],       // More info about controls: https://docs.mobiscroll.com/5-21-1/javascript/range#opt-controls

        select: 'range',              // More info about select: https://docs.mobiscroll.com/5-21-1/javascript/range#methods-select

        showRangeLabels: true

    });

    </script>

      <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"

        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"

        crossorigin="anonymous"></script> -->

        <script>

             function formhide() {

                var contentOne = document.getElementById('hide');

                var contentTwo = document.getElementById('showFormContent');

                var btn = document.getElementById('modalBtn');

                if(contentTwo.style.display == "none") {

                    contentTwo.style.display = "block";

                    contentOne.style.display = "none";

                    btn.style.display = "none";

                }  

             }



             function hideform() {

                var contentOne = document.getElementById('hide');

                var contentTwo = document.getElementById('showFormContent');

                var btn = document.getElementById('modalBtn');

                if(contentTwo.style.display == "block") {

                    contentTwo.style.display = "none";

                    contentOne.style.display = "block";

                    btn.style.display = "block";

                }

             }



             function showForm() {

                var show_form = document.getElementById('formShow');

                var hideContent = document.getElementById('hide_content');

                var modalBtn = document.getElementById('hideModalBtn'); 

                if(show_form.style.display == "none") {

                    show_form.style.display = "block";

                    hideContent.style.display = "none";

                    modalBtn.style.display = "none";

                }

             } 



             function showContent() {

                var show_Form = document.getElementById('formShow');

                var hideContent = document.getElementById('hide_content');

                var modalBtn = document.getElementById('hideModalBtn'); 

                if(hideContent.style.display == "none") {

                    hideContent.style.display = "block";

                    show_Form.style.display = "none";

                    modalBtn.style.display = "block";

                } 

             }



             function showFormFive() {

                var showForm = document.getElementById('show_form_five');

                var hideButton = document.getElementById('hide_button');

                if(showForm.style.display === "none") {

                    showForm.style.display = "block";

                    hideButton.style.display = "none";

                }

             }



             function hideFormFive() {

                var showForm = document.getElementById('show_form_five');

                var hideButton = document.getElementById('hide_button');

                if(hideButton.style.display == "none") {

                    hideButton.style.display = "block";

                    showForm.style.display = "none";

                }

             }

        </script>

</html>